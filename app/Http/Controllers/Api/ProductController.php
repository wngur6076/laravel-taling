<?php

namespace App\Http\Controllers\Api;

use App\Facades\DataTransferObject;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Services\ProductService;
use App\Requests\Product\IndexRequest as IndexDto;
use App\Requests\Product\StoreRequest as StoreDto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->middleware('auth:api')->only('store', 'update', 'destroy');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $dto = DataTransferObject::map(IndexDto::class, $request->all());
        $products = $this->service->index($dto);

        return ProductResource::collection($products);
    }

    public function store(StoreRequest $request)
    {
        $productSerialNumber = $this->service->store(
            DataTransferObject::map(StoreDto::class, $request->all())
        );

        return response()->json($productSerialNumber, 201);
    }

    public function update(UpdateRequest $request, $serialNumber)
    {
        $product = $this->service->findBySerialNumber($serialNumber);
        $this->authorize('update', $product);

        $productSerialNumber = $this->service->update(
            DataTransferObject::map(StoreDto::class, $request->all()),
            $product
        );

        return response()->json($productSerialNumber, 200);
    }

    public function destroy($serialNumber)
    {
        $product = $this->service->findBySerialNumber($serialNumber);
        $this->authorize('delete', $product);

        $productSerialNumber = $this->service->destroy($product);

        return response()->noContent();
    }
}
