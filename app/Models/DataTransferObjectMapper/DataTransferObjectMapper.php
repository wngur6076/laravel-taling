<?php

namespace App\Models\DataTransferObjectMapper;

interface DataTransferObjectMapper
{
    public function map($object, $request);
}
