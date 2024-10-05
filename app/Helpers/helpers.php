<?php
$files = glob(__DIR__ . '/*.php');
if (!($files === false)) {
    foreach ($files as $file) {
        require_once $file;
    }
    unset($file);
    unset($files);
}

if (!function_exists('cleanQuotes')) {
    function cleanQuotes($value)
    {
        // Replace special curved quotes with normal quotes.
        $chr_map = array(
            // Windows codepage 1252
            "\xC2\x82" => "'", // U+0082⇒U+201A single low-9 quotation mark
            "\xC2\x84" => '"', // U+0084⇒U+201E double low-9 quotation mark
            "\xC2\x8B" => "'", // U+008B⇒U+2039 single left-pointing angle quotation mark
            "\xC2\x91" => "'", // U+0091⇒U+2018 left single quotation mark
            "\xC2\x92" => "'", // U+0092⇒U+2019 right single quotation mark
            "\xC2\x93" => '"', // U+0093⇒U+201C left double quotation mark
            "\xC2\x94" => '"', // U+0094⇒U+201D right double quotation mark
            "\xC2\x9B" => "'", // U+009B⇒U+203A single right-pointing angle quotation mark
            // Regular Unicode     // U+0022 quotation mark (")
            // U+0027 apostrophe     (')
            "\xC2\xAB" => '"', // U+00AB left-pointing double angle quotation mark
            "\xC2\xBB" => '"', // U+00BB right-pointing double angle quotation mark
            "\xE2\x80\x98" => "'", // U+2018 left single quotation mark
            "\xE2\x80\x99" => "'", // U+2019 right single quotation mark
            "\xE2\x80\x9A" => "'", // U+201A single low-9 quotation mark
            "\xE2\x80\x9B" => "'", // U+201B single high-reversed-9 quotation mark
            "\xE2\x80\x9C" => '"', // U+201C left double quotation mark
            "\xE2\x80\x9D" => '"', // U+201D right double quotation mark
            "\xE2\x80\x9E" => '"', // U+201E double low-9 quotation mark
            "\xE2\x80\x9F" => '"', // U+201F double high-reversed-9 quotation mark
            "\xE2\x80\xB9" => "'", // U+2039 single left-pointing angle quotation mark
            "\xE2\x80\xBA" => "'", // U+203A single right-pointing angle quotation mark
        );
        $chr = array_keys($chr_map); // but: for efficiency you should
        $rpl = array_values($chr_map); // pre-calculate these two arrays
        $value = str_replace($chr, $rpl, html_entity_decode($value, ENT_QUOTES, "UTF-8"));
        return $value;
    }
}

if (!function_exists('clean')) {
    function clean($value)
    {
        $value = cleanQuotes($value);

        $text = preg_replace(array(
            // Remove invisible content
            '@<head[^>]*?>.*?</head>@siu',
            '@<script[^>]*?.*?</script>@siu',
            '@<object[^>]*?.*?</object>@siu',
            '@<embed[^>]*?.*?</embed>@siu',
            '@<applet[^>]*?.*?</applet>@siu',
            '@<noframes[^>]*?.*?</noframes>@siu',
            '@<noscript[^>]*?.*?</noscript>@siu',
            '@<noembed[^>]*?.*?</noembed>@siu',
        ), array('', '', '', '', '', '', '', ''), $value);
        $value = strip_tags($text);

        $value = trim($value);
        $value = ($value == "") ? null : $value;

        return $value;
    }
}

if (!function_exists('returnMsg')) {
    function returnMsg($msg_code = '200')
    {
        switch ($msg_code) {
            case '201':
                return "Resource created successfully!";
            case '404':
                return "Resource not found!";
            case '500':
                return "Something went wrong!";
            default:
                return "Resource updated successfully!";
        }
    }
}

if (!function_exists('cleanArray')) {
    function cleanArray($data, $allowed_keys = [], $skip = [])
    {
        if (count($allowed_keys) > 0) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $allowed_keys)) {
                    unset($data[$key]);
                }
            }
        }

        foreach ($data as $key => $value) {
            if (!in_array($key, $skip)) {
                if (is_array($data[$key])) {
                    $data[$key] = cleanArray($data[$key]);
                } else {
                    $data[$key] = clean($value);
                }
            }
        }

        return $data;
    }
}

if (!function_exists('cleanRequest')) {
    function cleanRequest($rules, $keys, $html_key = [], $skip = [])
    {
        $data = [];
        foreach ($rules as $k => $v) {
            if (!is_array($v)) {
                $v = explode("|", $v);
            }

            // Skip Files
            if (in_array("file", $v) || in_array($k, $skip)) {
                // Skip Null
                if (!is_null($keys->$k)) {
                    $data[$k] = $keys->$k;
                }

                continue;
            }

            if (is_array($keys->$k)) {
                $data[$k] = cleanArray($keys->$k);
            } else {
                if (!in_array($k, $html_key)) {
                    $data[$k] = clean($keys->$k);
                } else {
                    $data[$k] = $keys->$k;
                }
            }
        }
        return $data;
    }
}

if (!function_exists('actionButtons')) {
    function actionButtons($data)
    {
        $html = [];
        foreach ($data as $k => $v) {
            // Edit Button
            if ($k == "edit") {
                $html[] = "<a href='{$v}' class='text-primary m-1' title='Edit'><i class='fa-action fa fa-edit'></i></a>";
            }

            // Edit Button Ajax
            elseif ($k == "editAjax") {
                $html[] = "<a href='javascript:' class='text-primary m-1' title='Edit' onclick='{$v["function"]}({$v["id"]})'>
                <i class='fa-action fa ".($v['icon'] ?? 'fa-edit')."'></i></a>";
            }

            // Enable/Disable Button
            elseif ($k == "status") {
                $new_status = ($v["status"] == 0) ? 1 : 0;
                $temp = "<a href='javascript: confirmStatusModal({$v["id"]}, {$new_status}, \"{$v["datatable_id"]}\")'";
                if ($v["status"] == 0) {
                    $temp .= "class=' m-1' title='Enable'><i class='fa-action fas fa-toggle-off'></i>";
                } else {
                    $temp .= "class='text-success m-1' title='Disable'><i class='fa-action fas fa-toggle-on'></i>";
                }
                $temp .= "</a>";

                $html[] = $temp;
            }

            // Delete Button
            elseif ($k == "delete") {
                $html[] = "<a href='#' onclick='return confirmStatusModal(\"{$v["id"]}\", 2, \"{$v["datatable_id"]}\")'
                                class='text-danger m-1' title='Delete'><i class='fa-action fa fa-trash'></i></a>";
            }

            // Delete Button
            elseif ($k == "search_keys") {
                $html[] = "<a href='javascript:void(0);' onclick='searchKeys({$v["id"]});' class='text-secondary m-1' title='search Keys'><i class='fa-action fa fa-search'></i></a>";
            }

            // Reorder
            elseif ($k == "reorder") {
                $html[] = "<i class='fas fa-arrows-alt reorder'></i>";
            }

            // Link
            elseif ($k == "link") {
                $html[] = "<a href='{$v["url"]}' class='text-primary m-1'><i class='{$v["icon"]}'></i></a>";
            }

            elseif ($k == "link-text-another-tab") {
                $html[] = "<a href='{$v["url"]}' class='text-primary m-1' target='_blank'><i class='{$v["icon"]}'></i></a>";;
            }

            // Language Box
            elseif ($k == "languageModal") {
                $html[] = "<a href='javascript:' class='text-primary m-1' title='Edit' onclick='{$v["function"]}({$v["id"]})'>
                <i class='fa-action fa fa-edit'></i></a>";
            }

            // Edit Button Ajax
            elseif ($k == "custom") {
                $html[] = "<a href='javascript:' class='text-primary m-1' title='{$v["title"]}' onclick='{$v["function"]}({$v["id"]})'>
                <i class='fa-action fa {$v["icon"]}'></i></a>";
            }
        }
        return implode("", $html);
    }
}

if (!function_exists('status')) {
    function status($is_active)
    {
        return $is_active ? 'Active' : 'Inactive';
    }
}
