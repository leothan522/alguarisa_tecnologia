<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Alguarisa',
    'title_prefix' => '',
    'title_postfix' => ' - '.env('APP_NAME', 'Alguarisa'),

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => true,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>ALGUARISA</b>',
    /*'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',*/
    'logo_img' => 'img/logo_small_50x50.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    /*'logo_img_xl' => 'img/logo_xl_210x33.png',*/
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Alguarisa',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            /*'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',*/
            'path' => 'img/preloader_171x171.png',
            'alt' => '...',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-navy',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => 'bg-navy color-palette',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4 bg-navy color-palette',
    'classes_sidebar_nav' => 'navbar-navy',
    'classes_topnav' => 'navbar-navy navbar-dark',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => true,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-th-large',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => false,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'Buscar',
            'topnav_right' => true,
            'url'          => '#', // The url used to submit the data ('#' by default).
            'method'       => 'post',          // 'get' or 'post' ('get' by default).
            'input_name'   => 'searchVal',     // Name for the underlying input ('adminlteSearch' by default).
            'id'           => 'navbarSearch'   // ID attribute for the underlying input (optional).
        ],
        [
            'type' => 'darkmode-widget',
            'topnav_right' => true,     // Or "topnav => true" to place on the left.
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:

        [
            'text'      => 'Gestionar Oficios',
            'icon'      => 'fas fa-fw fa-book',
            'can'       => ['bienes'],
            'submenu' => [
                [
                    'text' => 'Oficios',
                    'icon' => 'fas fa-fw fa-file-invoice',
                    'route'  => 'oficios.index',
                    'can'  => 'oficios',
                ],
                [
                    'text' => 'Bienes',
                    'icon' => 'fas fa-fw fa-boxes',
                    'route'  => 'bienes.index',
                    'can'  => 'bienes',
                ],
                [
                    'text'    => 'Tablas',
                    'icon' => 'fas fa-fw fa-table',
                    'url'     => '#',
                    'classes' => 'd-none sidebar_tablas_bienes',
                    'submenu' => [
                        [
                            'text' => 'Tipos',
                            'url'  => '#',
                            'data'  => [
                                'toggle' => 'modal',
                                'target' => '#modal-tabla-tipos',
                            ],
                            'id' => 'sidebar_tabla_tipos'
                        ],
                        [
                            'text' => 'Marcas',
                            'url'  => '#',
                            'data'  => [
                                'toggle' => 'modal',
                                'target' => '#modal-tabla-marcas',
                            ],
                            'id' => 'sidebar_tabla_marcas'
                        ],
                        [
                            'text' => 'Modelos',
                            'url'  => '#',
                            'data'  => [
                                'toggle' => 'modal',
                                'target' => '#modal-tabla-modelos',
                            ],
                            'id' => 'sidebar_tabla_modelos'
                        ],
                        [
                            'text' => 'Colores',
                            'url'  => '#',
                            'data'  => [
                                'toggle' => 'modal',
                                'target' => '#modal-tabla-colores',
                            ],
                            'id' => 'sidebar_tabla_colores'
                        ],
                        [
                            'text' => 'Condiciones',
                            'url'  => '#',
                            'data'  => [
                                'toggle' => 'modal',
                                'target' => '#modal-tabla-condiciones',
                            ],
                            'id' => 'sidebar_tabla_condiciones'
                        ],
                        [
                            'text' => 'Ubicaciones',
                            'url'  => '#',
                            'data'  => [
                                'toggle' => 'modal',
                                'target' => '#modal-tabla-ubicaciones',
                            ],
                            'id' => 'sidebar_tabla_ubicaciones'
                        ],
                    ],
                ],
            ],
        ],
        [
            'text'      => 'Configuración',
            'icon'      => 'fas fa-fw fa-cogs',
            'can'       => ['usuarios', 'empresas', 'territorio', 'parametros', 'pruebas'],
            'submenu' => [
                [
                    'text' => 'Usuarios',
                    'icon' => 'fas fa-fw fa-users-cog',
                    'route'  => 'usuarios.index',
                    'can'  => 'usuarios',
                ],
                [
                    'text' => 'Empresas',
                    'icon' => 'fas fa-fw fa-store-alt',
                    'route'  => 'empresas.index',
                    'can'  => 'empresas',
                ],
                [
                    'text' => 'Territorio',
                    'icon' => 'fas fa-fw fa-globe-americas',
                    'route'  => 'territorio.index',
                    'can'  => 'territorio',
                ],
                [
                    'text' => 'Parametros',
                    'icon' => 'fas fa-fw fa-list',
                    'route' => 'parametros.index',
                    'can' => 'parametros',
                ],
                [
                    'text' => 'Pruebas',
                    'icon' => 'fas fa-fw fa-tools',
                    'route' => 'pruebas.index',
                    'can' => 'pruebas',
                ]
            ],
        ],
        [
            'text'      => 'View Android',
            'icon'      => 'fas fa-fw fa-mobile-alt',
            'can'       => ['fcm'],
            'submenu' => [
                [
                    'text' => 'Cloud Messaging (FCM)',
                    'icon' => 'fas fa-fw fa-bell',
                    'route' => 'fcm.index',
                    'can' => 'fcm',
                ],
                [
                    'text' => 'Chat Directo',
                    'icon' => 'fas fa-fw fa-comments',
                    'route'  => 'chat.directo',
                    'can'  => 'pruebas',
                    'target' => '_blank',
                ],
                [
                    'text' => 'API Android',
                    'icon' => 'fas fa-fw fa-mobile-alt',
                    'url' => env('APP_URL_ANDROID', '/android'),
                    'can'  => 'pruebas',
                    'target' => '_blank',
                ],
            ],
        ],
    ],

    /*'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
        [
            'text'        => 'pages',
            'url'         => 'admin/pages',
            'icon'        => 'far fa-fw fa-file',
            'label'       => 4,
            'label_color' => 'success',
        ],
        ['header' => 'account_settings'],
        [
            'text' => 'profile',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-lock',
        ],
        [
            'text'    => 'multilevel',
            'icon'    => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text'    => 'level_one',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'level_two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'level_two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
            ],
        ],
        ['header' => 'labels'],
        [
            'text'       => 'important',
            'icon_color' => 'red',
            'url'        => '#',
        ],
        [
            'text'       => 'warning',
            'icon_color' => 'yellow',
            'url'        => '#',
        ],
        [
            'text'       => 'information',
            'icon_color' => 'cyan',
            'url'        => '#',
        ],
    ],*/

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    /*'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',*/
                    'location' => 'vendor/select2/js/select2.full.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/i18n/es.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    /*'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',*/
                    'location' => 'vendor/select2/css/select2.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                    /*'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',*/
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    //'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                    'location' => 'vendor/sweetalert2/sweetalert2.all.min.js'
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'Lightbox' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/ekko-lightbox/ekko-lightbox.css'
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/ekko-lightbox/ekko-lightbox.js',
                ],
            ],
        ],
        'IcheckBootstrap' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/icheck-bootstrap/icheck-bootstrap.css'
                ]
            ],
        ],
        'Summernote' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/summernote/summernote-bs4.min.css'
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/summernote/summernote-bs4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/summernote/lang/summernote-es-ES.min.js',
                ],
            ],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];
