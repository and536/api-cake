<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'ApiPedidos',
    ['path' => '/'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);

        $routes->resources('Pedidos');

        $routes->connect(
            '/pedidos/:id/sendemail',
            [
                'controller' => 'Pedidos',
                'action' => 'envioEmail',
                '_method' => 'GET'
            ],[
                'pass' => ['id']
            ]
        );

        $routes->connect(
            '/pedidos/:id/report',
            [
                'controller' => 'Pedidos',
                'action' => 'relatorio',
                '_method' => 'GET'
            ],[
                'pass' => ['id']
            ]
        );
    }
);