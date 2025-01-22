<?php

namespace App\Routing;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Route;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\AttributeDirectoryLoader;
use Symfony\Component\HttpFoundation\Request;
use App\Routing\AttributeLoader;
use App\Api\Example\Id\GetExample;

class SymfonyApiRouter
{
    private RouteCollection $routes;
    private RequestContext $context;
    public function __construct()
    {
        $this->routes = $this->defineRoutes();
        $this->context = new RequestContext();
    }
    /**
     * Defines the routes for the API.
     * @return RouteCollection The collection of routes for the API.
     */
    private function defineRoutes(): RouteCollection
    {
        $apiDir = dirname(__DIR__, 2) . '/src/api';
        $locator = new FileLocator($apiDir);
        $loader = new AttributeDirectoryLoader($locator, new AttributeLoader());
        return $loader->load($apiDir);
    }
    
    public function matchApiRequest(Request $requestGlobal): array|false
    {
        $this->context->fromRequest($requestGlobal);
        $matcher = new UrlMatcher($this->routes, $this->context);
        try {
            $parameters = $matcher->match($this->context->getPathInfo());
        } catch (ResourceNotFoundException | MethodNotAllowedException $e) {
            return false;
        }
        unset($parameters['_route']);
        return $parameters;
    }
    public function handleApiRequest(array $routeParameters, Request $requestGlobal): mixed
    {
        $controller = new $routeParameters['class']();
        $methodName = $routeParameters['method'];
        unset($routeParameters['class']);
        unset($routeParameters['method']);
        return $controller->$methodName($requestGlobal, ...$routeParameters);
    }
}

