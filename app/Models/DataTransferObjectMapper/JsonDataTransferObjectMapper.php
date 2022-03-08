<?php

namespace App\Models\DataTransferObjectMapper;

use JsonMapper;
use JsonMapper_Exception;
use ReflectionClass;
use ReflectionException;
use RuntimeException;
use Symfony\Component\HttpFoundation\ParameterBag;


class JsonDataTransferObjectMapper implements DataTransferObjectMapper
{

    public function map($object, $request)
    {
        try {
            $mapper = new JsonMapper();
            $mapper->bIgnoreVisibility = true;

            return $mapper->map(
                new ParameterBag($request),
                (new ReflectionClass($object))->newInstanceWithoutConstructor()
            );
        } catch (JsonMapper_Exception|ReflectionException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
