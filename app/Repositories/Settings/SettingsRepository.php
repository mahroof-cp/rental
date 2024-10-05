<?php

namespace App\Repositories\Settings;

use App\Models\Setting;

class SettingsRepository implements SettingsRepositoryInterface
{

    public function getAll()
    {
        $settings = Setting::get();
        return $settings;
    }

    public function settingsIn($keys)
    {
        return Setting::whereIn('key', $keys)->get();
    }

    public function getByKey($key)
    {
        return Setting::where('key', $key)->first();
    }

    public function getByKeys($keys)
    {
        return Setting::whereIn('key', $keys)->get();
    }

    public function autoLoad()
    {
        return Setting::where('autoload', 1)->get();
    }

    public function update(array $input)
    {
        foreach ($input as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if (!empty($setting)) {
                $setting->value = $value;
                $setting->save();
                cache()->forget('settings'); //To reflect the settings immediately
            }
        }
        return $this->settingsIn(array_keys($input));
    }

    public function resetValue($setting)
    {
        if (is_string($setting)) {
            $setting = Setting::where('key', $setting)->first();
        }
        if (!empty($setting)) {
            $setting->value = '';
            $setting->save();
            cache()->forget('settings'); //To reflect the settings immediately
        }
    }

    public function setValueAsArray($setting, $data)
    {
        if (is_string($setting)) {
            $setting = Setting::where('key', $setting)->first();
        }
        if (!empty($setting)) {
            $setting->valueArray = $data;
            $setting->save();
            cache()->forget('settings'); //To reflect the settings immediately
        }
    }

    public function getKeyValue()
    {
        return Setting::select('key', 'value')->get()->mapWithKeys(function ($item) {
            return [$item['key'] => $item['value']];
        });
    }
}