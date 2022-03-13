<?php

namespace App\Http\Controllers\Api;

use App\Events\ProductAdded;
use App\Facades\DataTransferObject;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Services\ProductService;
use App\Requests\Product\IndexRequest as IndexDto;
use App\Requests\Product\StoreRequest as StoreDto;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $service;
    private $dispatcher;

    public function __construct(ProductService $service, Dispatcher $dispatcher)
    {
        $this->middleware('auth:api')->only('store', 'update', 'destroy');
        $this->service = $service;
        $this->dispatcher = $dispatcher;
    }

    public function index(Request $request, \App\Http\Services\Elasticsearch\ProductService $productService)
    {
        $dto = DataTransferObject::map(IndexDto::class, $request->all());

//        $products = $this->service->index($dto);

        $products = $this->service->getProductsBySerialNumberList(
            $productService->getSerialNumberOfSearchedProduct($dto)
        );

        return ProductResource::collection($products);
    }

    public function store(StoreRequest $request)
    {
        $dto = DataTransferObject::map(StoreDto::class, $request->all());
        $productSerialNumber = $this->service->store($dto);

        $this->dispatcher->dispatch(
            new ProductAdded(
                $productSerialNumber,
                $dto->getName(),
                $dto->getDisplayName(),
                $dto->getDescription(),
                $this->service->getMarkName($dto->getMarketId()),
                $this->service->getCategoryName($dto->getCategoryId()),
                $dto->getPrice(),
                $dto->getSalePrice(),
            )
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
