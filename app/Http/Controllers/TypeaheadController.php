<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class TypeaheadController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function autocompleteSearch(Request $request, \App\Http\Services\Elasticsearch\ProductService $productService)
    {
        $query = $productService->getQueryByKeyword($request->get('keyword'));
        $filterResult = $this->service->getProductsBySerialNumberList(
            array_merge(...$productService->executeSql($query))
        );

        return response()->json($filterResult);
    }
}
