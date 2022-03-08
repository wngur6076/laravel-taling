<?php

namespace App\Http\Controllers;

use App\Facades\DataTransferObject;
use App\Facades\Notify;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Services\ProductService;
use App\Requests\Product\IndexRequest as IndexDto;
use App\Requests\Product\StoreRequest as StoreDto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->middleware('auth')->only('create', 'store');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $dto = DataTransferObject::map(IndexDto::class, $request->all());
        $products = $this->service->index($dto);

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
        $productSerialNumber = $this->service->store(
            DataTransferObject::map(StoreDto::class, $request->all())
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

        $productSerialNumber = $this->service->update(
            DataTransferObject::map(StoreDto::class, $request->all()),
            $product
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
