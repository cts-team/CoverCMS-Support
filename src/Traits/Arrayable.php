<?php

declare(strict_types=1);


namespace CoverCMS\Support\Traits;


use CoverCMS\Support\Str;
use ReflectionClass;
use ReflectionException;

/**
 * Trait Arrayable
 * @package CoverCMS\Support\Traits
 */
trait Arrayable
{
    /**
     * @return array
     * @throws ReflectionException
     */
    public function toArray(): array
    {
        $result = [];

        foreach ((new ReflectionClass($this))->getProperties() as $item) {
            $k = $item->getName();
            $method = 'get' . Str::studly($k);

            $result[Str::snake($k)] = method_exists($this, $method) ? $this->{$method}() : $this->{$k};
        }

        return $result;
    }
}