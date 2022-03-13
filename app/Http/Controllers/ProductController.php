<?php

namespace App\Http\Controllers;

use App\Events\ProductAdded;
use App\Facades\DataTransferObject;
use App\Facades\Notify;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
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
        $this->middleware('auth')->only('create', 'store');
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

        return view('products.index', [
            'categories' => $this->service->getAllCategory(),
            'products' => $products,
            'request' => $dto,
        ]);
    }

    public function create()
    {
        $this->authorize('create', $this->service->getProductModel());

        return view('products.create', [
            'categories' => $this->service->getAllCategory(),
            'markets' => $this->service->getAllMarket(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', $this->service->getProductModel());
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

        Notify::success('상품이 추가되었습니다.', 'Success');

        return redirect()->route('products.show', $productSerialNumber);
    }

    public function show($serialNumber)
    {
        $product = $this->service->findBySerialNumber($serialNumber);

        return view('products.show', compact('product'));
    }

    public function edit($serialNumber)
    {
        $product = $this->service->findBySerialNumber($serialNumber);
        $this->authorize('update', $product);

        return view('products.edit', [
            'product' => $product,
            'categories' => $this->service->getAllCategory(),
            'markets' => $this->service->getAllMarket(),
        ]);
    }

    public function update(UpdateRequest $request, $serialNumber)
    {
        $product = $this->service->findBySerialNumber($serialNumber);
        $this->authorize('update', $product);

        $dto = DataTransferObject::map(StoreDto::class, $request->all());
        $productSerialNumber = $this->service->update(
            $dto,
            $product
        );

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

        Notify::success('상품을 수정하였습니다.', 'Success');

        return redirect()->route('products.show', $productSerialNumber);
    }

    public function destroy($serialNumber)
    {
        $product = $this->service->findBySerialNumber($serialNumber);
        $this->authorize('delete', $product);

        $productSerialNumber = $this->service->destroy($product);

        Notify::success('상품을 삭제하였습니다.', 'Success');

        return redirect()->route('products.index');
    }
}
