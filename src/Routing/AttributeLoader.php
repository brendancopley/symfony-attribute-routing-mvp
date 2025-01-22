<?php

namespace App\Routing;

use Symfony\Component\Routing\Loader\AttributeClassLoader;
use Symfony\Component\Routing\Route;
use ReflectionClass;
use ReflectionMethod;

class AttributeLoader extends AttributeClassLoader
{
    protected function configureRoute(Route $route, ReflectionClass $class, ReflectionMethod $method, object $attr): void
    {
        $route->setDefault('class', $class->getName());
        $route->setDefault('method', $method->getName());
    }
}
