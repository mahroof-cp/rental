<?php
if (!function_exists('sideMenu')) {
    function sideMenu()
    {
        $sideMenuList = [
            [
                'id' => '1',
                'name' => __('Dashboard'),
                'icon' => '<i class="menu-icon tf-icons bx bx-home-circle"></i>',
                'active' => routeMatch(['admin_dashboard']),
                'url' => route('admin_dashboard'),
            ],
            [
                'id' => '2',
                'name' => __('Enquiries'),
                'icon' => '<i class="menu-icon tf-icons bx bx-message-rounded-edit"></i>',
                'permission' => ['enquiry_read'],
                'active' => routeMatch(['admin_enquiry_list', 'admin_enquiry_view']),
                'url' => route('admin_enquiry_list'),
            ],
            [
                'id' => '3',
                'name' => __('Setup'),
                'icon' => '<i class="menu-icon tf-icons bx bx-cog"></i>',
                'child' => [
                    [
                        'id' => '001',
                        'name' => __('Roles'),
                        'icon' => '',
                        'permission' => ['role_read'],
                        'active' => routeMatch(['admin_role_index', 'admin_role_create_update']),
                        'url' => route('admin_role_index'),
                    ],
                    [
                        'id' => '002',
                        'name' => __('Users'),
                        'icon' => '',
                        'permission' => ['user_read'],
                        'active' => routeMatch(['admin_user_index', 'admin_user_create_update']),
                        'url' => route('admin_user_index'),
                    ],
                    [
                        'id' => '003',
                        'name' => __('Banners'),
                        'icon' => '',
                        'permission' => ['banner_read'],
                        'active' => routeMatch(['admin_banner_list', 'admin_banner_add', 'admin_banner_edit', 'admin_banner_view']),
                        'url' => route('admin_banner_list'),
                    ],
                    [
                        'id' => '004',
                        'name' => __('Cms Contents'),
                        'icon' => '',
                        'permission' => ['cms_category_read'],
                        'active' => routeMatch(['admin_cms_list', 'admin_cms_add', 'admin_cms_edit', 'admin_cms_view']),
                        'url' => route('admin_cms_list'),
                    ],
                    [
                        'id' => '005',
                        'name' => __('Settings'),
                        'icon' => '',
                        'permission' => ['settings_read'],
                        'active' => routeMatch(['admin_settings_view']),
                        'url' => route('admin_settings_view'),
                    ],
                ]
            ],
//            [
//                'id' => '4',
//                'name' => __('Services'),
//                'icon' => '<i class="menu-icon tf-icons bx bx-message-rounded-edit"></i>',
//                'permission' => ['services_read'],
//                'active' => routeMatch(['admin_services_add', 'admin_services_list', 'admin_services_edit', 'admin_services_update']),
//                'url' => route('admin_services_list'),
//            ],
            [
                'id' => '5',
                'name' => __('Banks'),
                'icon' => '<i class="menu-icon tf-icons bx bxs-landmark"></i>',
                'permission' => ['bank_read'],
                'active' => routeMatch(['admin_bank_index', 'admin_bank_create_update']),
                'url' => route('admin_bank_index'),
            ],
        ];
        $user = auth()->guard('admin')->user();
        $sideMenu = renderList($sideMenuList, $user);
        return $sideMenu['view'];
    }

    function renderList($sideMenuList, $user)
    {
        $sideMenuView = '';
        $sideMenuActive = false;

        foreach ($sideMenuList as $sideMenu) {
            $menuPermissions = isset($sideMenu['permission']) ? $sideMenu['permission'] : [];
            $menuUrl = isset($sideMenu['url']) ? $sideMenu['url'] : '#';
            $menuIcon = isset($sideMenu['icon']) ? $sideMenu['icon'] : '';
            $menuName = isset($sideMenu['name']) ? $sideMenu['name'] : '';
            $menuActive = isset($sideMenu['active']) ? $sideMenu['active'] : false;

            $sideMenuActive = $sideMenuActive || $menuActive;

            $userCan = true;

            if (!empty($menuPermissions)) {
                $userCan = false;
                foreach ($menuPermissions as $permission) {
                    if(auth()->user()->role->hasPermission($permission)) {
                        $userCan = true;
                        break;
                    }
                }
            }

            if ($userCan) {
                if (isset($sideMenu['child'])) {
                    $subMenu = renderList($sideMenu['child'], $user);
                    if (!empty($subMenu['view'])) {
                        $sideMenuView .= '<li class="menu-item ' . ($subMenu['active'] ? 'active open' : '') . '">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                            ' . $menuIcon . ' <div>' . $menuName . '</div>
                            </a>

                            <ul class="menu-sub">' . $subMenu['view'] . '</ul>
                        </li>';
                    }
                } else {
                    $sideMenuView .= '<li class="menu-item">
                        <a href="' . $menuUrl . '" class="menu-link ' . ($menuActive ? 'active' : '') . '">
                        ' . $menuIcon . ' <div>' . $menuName . '</div>
                        </a>
                    </li>';
                }
            }
        }
        return ['view' => $sideMenuView, 'active' => $sideMenuActive];
    }
}
