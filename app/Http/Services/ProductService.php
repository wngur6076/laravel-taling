<?php

namespace App\Http\Services;

use App\Facades\ProductNumber;
use App\Models\Category;
use App\Models\Market;
use App\Models\Product;
use App\Requests\Product\IndexRequest;
use App\Requests\Product\StoreRequest;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function index(IndexRequest $request)
    {
        if ($this->hasCategory($request->getCategory())) {
            $query = Category::where('name', $request->getCategory())
                ->firstOrFail()
                ->products();
        } else {
            $query = new Product;
        }

        if ($request->getKeyword()) {
            $query = $query->where('display_name', 'like', '%'.$request->getKeyword().'%');
        }

        return $query->with(['market', 'category'])->latest()->paginate(8);
    }

    public function store(StoreRequest $request)
    {
        return Product::create([
            'serial_number' => ProductNumber::generate(),
            'name' => $request->getName(),
            'display_name' => $request->getDisplayName(),
            'description' => $request->getDescription(),
            'price' => $request->getPrice(),
            'sale_price' => $request->getSalePrice(),
            'thumb_img_path' => $request->getThumbImg()->store(Product::thumbImgPath(), 'public'),
            'user_id' => Auth::user()->id,
            'category_id' => $request->getCategoryId(),
            'market_id' => $request->getMarketId(),
        ])->serial_number;
    }

    public function update(StoreRequest $request, $product)
    {
        return tap($product)->update([
            'name' => $request->getName(),
            'display_name' => $request->getDisplayName(),
            'description' => $request->getDescription(),
            'price' => $request->getPrice(),
            'sale_price' => $request->getSalePrice(),
            'thumb_img_path' => optional($request->getThumbImg())->store(Product::thumbImgPath(), 'public') ?? $product->thumb_img_path,
            'category_id' => $request->getCategoryId(),
            'market_id' => $request->getMarketId(),
        ])->serial_number;
    }

    public function destroy($product)
    {
        $product = tap($product)->delete();

        return $product->serial_number;
    }

    public function getAllCategory()
    {
        return Category::all();
    }

    public function getAllMarket()
    {
        return Market::all();
    }

    public function findBySerialNumber($serialNumber)
    {
        return Product::findBySerialNumber($serialNumber);
    }

    public function hasCategory($category)
    {
        return $category && $category !== IndexRequest::CATEGORY_ALL;
    }

    public function getProductModel()
    {
        return Product::class;
    }

    public function findMark($marketId)
    {
        return Market::findOrFail($marketId);
    }

    public function findCategory($categoryId)
    {
        return Category::findOrFail($categoryId);
    }

    public function getMarkName($marketId)
    {
        return $this->findMark($marketId)->name;
    }

    public function getCategoryName($categoryId)
    {
        return $this->findCategory($categoryId)->name;
    }

    public function getProductsBySerialNumberList($productSerialNumbers)
    {
        return Product::with(['market', 'category'])
            ->whereIn('serial_number', $productSerialNumbers)
            ->latest()
            ->paginate(8);
    }
}
