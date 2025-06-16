<?php

/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {

    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {

        $builder->connect('/', ['controller' => 'Home', 'action' => 'index']);
        $builder->connect('/customReport', ['controller' => 'Home', 'action' => 'customReport']);

        $publicPath = WWW_ROOT;
        $menu = json_decode(file_get_contents($publicPath . "reports.json"), true);

        if (is_array($menu)) {
            foreach ($menu as $section_name => $section) {
                foreach ($section as $group_name => $group) {
                    foreach ($group as $sname => $surl) {
                        if (is_string($surl)) {
                            $surl = rtrim($surl, '/');
                            $builder->connect($surl, ['controller' => 'Home', 'action' => 'report'])->setMethods(['GET', 'POST']);
                            $builder->connect($surl . '/export', ['controller' => 'Home', 'action' => 'export'])->setMethods(['GET', 'POST']);
                            $builder->connect($surl . '/exportPDF', ['controller' => 'Home', 'action' => 'exportPDF'])->setMethods(['GET', 'POST']);
                            $builder->connect($surl . '/exportExcel', ['controller' => 'Home', 'action' => 'exportExcel'])->setMethods(['GET', 'POST']);
                        } else {
                            foreach ($surl as $tname => $turl) {
                                $turl = rtrim($turl, '/');
                                $builder->connect($turl, ['controller' => 'Home', 'action' => 'report'])->setMethods(['GET', 'POST']);
                                $builder->connect($turl . '/export', ['controller' => 'Home', 'action' => 'export'])->setMethods(['GET', 'POST']);
                                $builder->connect($turl . '/exportPDF', ['controller' => 'Home', 'action' => 'exportPDF'])->setMethods(['GET', 'POST']);
                                $builder->connect($turl . '/exportExcel', ['controller' => 'Home', 'action' => 'exportExcel'])->setMethods(['GET', 'POST']);
                            }
                        }
                    }
                }
            }
        }

        $builder->fallbacks();
    });
};
