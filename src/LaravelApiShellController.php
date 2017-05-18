<?php

namespace Visualplus\LaravelApiShell;


use Illuminate\Routing\Controller;

class LaravelApiShellController extends Controller
{
    /**
     * @var RoutingResolver
     */
    private $resolver;

    /**
     * LaravelApiShellController constructor.
     * @param RoutingResolver $resolver
     */
    public function __construct(RoutingResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * @return array
     */
    public function getPathList()
    {
        $paths = $this->resolver->getPaths();

        return $paths;
    }
}