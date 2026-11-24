<?php

namespace LaveroAdmin\Admin\Helpers;

use LaveroAdmin\Admin\Admin;
use LaveroAdmin\Admin\Auth\Database\Menu;
use LaveroAdmin\Admin\Extension;

class Helpers extends Extension
{
    /**
     * Bootstrap this package.
     *
     * @return void
     */
    public static function boot()
    {
        static::registerRoutes();

        Admin::extend('helpers', __CLASS__);
    }

    /**
     * Register routes for LaveroAdmin.
     *
     * @return void
     */
    public static function registerRoutes()
    {
        parent::routes(function ($router) {
            /* @var \Illuminate\Routing\Router $router */
            $router->get('helpers/terminal/database', 'LaveroAdmin\Admin\Helpers\Controllers\TerminalController@database');
            $router->post('helpers/terminal/database', 'LaveroAdmin\Admin\Helpers\Controllers\TerminalController@runDatabase');
            $router->get('helpers/terminal/artisan', 'LaveroAdmin\Admin\Helpers\Controllers\TerminalController@artisan');
            $router->post('helpers/terminal/artisan', 'LaveroAdmin\Admin\Helpers\Controllers\TerminalController@runArtisan');
            $router->get('helpers/scaffold', 'LaveroAdmin\Admin\Helpers\Controllers\ScaffoldController@index');
            $router->post('helpers/scaffold', 'LaveroAdmin\Admin\Helpers\Controllers\ScaffoldController@store');
            $router->get('helpers/routes', 'LaveroAdmin\Admin\Helpers\Controllers\RouteController@index');
        });
    }

    public static function import()
    {
        $lastOrder = Menu::max('order');

        $root = [
            'parent_id' => 0,
            'order'     => $lastOrder++,
            'title'     => 'Helpers',
            'icon'      => 'icon-cogs',
            'uri'       => '',
        ];

        $root = Menu::create($root);

        $menus = [
            [
                'title'     => 'Scaffold',
                'icon'      => 'icon-keyboard',
                'uri'       => 'helpers/scaffold',
            ],
            [
                'title'     => 'Database terminal',
                'icon'      => 'icon-database',
                'uri'       => 'helpers/terminal/database',
            ],
            [
                'title'     => 'Laravel artisan',
                'icon'      => 'icon-terminal',
                'uri'       => 'helpers/terminal/artisan',
            ],
            [
                'title'     => 'Routes',
                'icon'      => 'icon-list-alt',
                'uri'       => 'helpers/routes',
            ],
        ];

        foreach ($menus as $menu) {
            $menu['parent_id'] = $root->id;
            $menu['order'] = $lastOrder++;

            Menu::create($menu);
        }

        parent::createPermission('Admin helpers', 'ext.helpers', 'helpers/*');
    }
}
