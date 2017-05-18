<?php

namespace Visualplus\LaravelApiShell\Tests;

use Illuminate\Routing\Router;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use Visualplus\LaravelApiShell\RoutingResolver;

class RoutingResolverTest extends TestCase
{
    /** @test */
    public function test_resolve()
    {
        $router = m::mock(Router::class);
        $dummy = m::mock(Router::class);
        $route = m::mock(Router::class);

        $route->shouldReceive('getAction')
            ->andReturn(['uses' => '']);
        $route->uri = 'a/b/c';
        $route->methods = ['GET'];

        $routes = [
            $route
        ];

        $dummy->shouldReceive('getRoutes')
            ->andReturn($routes);

        $router->shouldReceive('getRoutes')
            ->andReturn($dummy);

        $routingResolver = new RoutingResolver($router);

        $this->assertEquals($routingResolver->getPaths(), [
            'a' => [
                'b' => [
                    'c' => [
                        'methods' => [
                            'GET'
                        ]
                    ]
                ]
            ]
        ]);
    }
}