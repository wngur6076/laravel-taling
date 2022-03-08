@extends('app')

@section('title', '상품 리스트')

@section('content')
    <section class="section-prod-list section-1">
        <div class="container">
            <div class="t-flex t-items-start">
                <h1 class="t-font-bold">
                    <i class="fas fa-tshirt"></i>

                    <span class="t-hidden sm:t-inline">상품 리스트</span>
                    <span class="sm:t-hidden">상품</span>
                </h1>

                <div class="t-flex-grow"></div>

                <form action="{{ route('products.index') }}">
                    <select name="category" class="form-select w-auto"
                            onchange="$(this).closest('form').submit()">
                        <option value="-1" disabled>==카테고리==</option>
                        <option value="all">전체</option>
                        @foreach($categories as $category)
                            @if ($request->getCategory() == $category->name)
                            <option value="{{ $category->name }}" selected>
                                {{ $category->name }}
                            </option>
                            @else
                            <option value="{{ $category->name }}">
                                {{ $category->name }}
                            </option>
                            @endif
                        @endforeach
                    </select>

                    @if ($request->getKeyword())
                    <input type="hidden" name="keyword" value="{{ $request->getKeyword() }}">
                    @endif
                </form>

            </div>

            @if ($request->getKeyword() || $request->getCategory())
            <hr>

            <div>
                @if ($request->getKeyword())
                <a href="{{ route('products.index', ['category' => $request->getCategory()]) }}" class="badge bg-danger hover:t-text-black">검색어
                    `{{ $request->getKeyword() }}` <i class="fas fa-times"></i></a>
                @endif

                @if ($request->getCategory())
                <a href="{{ route('products.index', ['keyword' => $request->getKeyword()]) }}" class="badge bg-danger hover:t-text-black">카테고리
                    `{{ $request->getCategory() }}` <i class="fas fa-times"></i></a>
                @endif
            </div>

            @endif
            <hr>

            <ul class="t-grid t-grid-cols-1 sm:t-grid-cols-2 md:t-grid-cols-3 lg:sm:t-grid-cols-4 t-gap-[20px] t-mt-3">
                @foreach($products as $product)
                <li class="t-flex t-flex-col t-group">
                    <a href="{{ route('products.show', $product->serial_number) }}"
                       class="t-relative t-overflow-hidden t-rounded">
                        <img class="t-block t-w-full t-transition-all group-hover:t-scale-110 t-object-cover"
                             src="{{  $product->thumbnailUrl() }}" alt="" style="aspect-ratio: 1 / 1;">
                        <div class="t-absolute t-inset-0 t-bg-[#00000000] group-hover:t-bg-[#00000055] t-transition-all"></div>
                        <div class="t-absolute t-inset-0 t-opacity-0 group-hover:t-opacity-100 t-flex t-items-center t-justify-center t-transition-all">
                            <span class="t-text-white t-border-2 t-border-white t-border-solid t-p-2 t-rounded t-whitespace-nowrap">VIEW MORE</span>
                        </div>
                    </a>
                    <a class="t-text-center t-mt-2"
                       href="{{ route('products.show', $product->serial_number) }}">
                        <span class="badge t-bg-teal-700">{{ $product->market->name }} {{ $product->market->review_point }}</span>
                    </a>
                    <a class="t-text-center t-mt-2 t-no-underline t-text-black t-italic group-hover:t-underline"
                       href="{{ route('products.show', $product->serial_number) }}">
                        {{ $product->display_name }}
                    </a>
                    <a class="t-text-center t-mt-2 t-no-underline group-hover:t-text-blue-500"
                       href="{{ route('products.show', $product->serial_number) }}">
                        <span>{{ $product->sale_price_in_wons }}원</span>
                        <span class="t-line-through t-text-gray-400">{{ $product->price_in_wons }}원</span>
                    </a>
                    <a class="t-text-center t-mt-2 t-no-underline t-text-gray-400 group-hover:t-text-blue-500"
                       href="{{ route('products.show', $product->serial_number) }}">
                        <span>{!! $product->colors !!}</span>
                    </a>

                    @if ($product->isFavorited())
                    <a class="t-text-center t-mt-3 t-no-underline t-text-[#ff0000] group-hover:t-text-blue-500"
                       href="{{ route('products.show', $product->serial_number) }}">
                        <i class="fas fa-heart"></i>
                    </a>
                    @endif
                </li>
                @endforeach
            </ul>

        </div>

        <div class="t-flex t-justify-center t-my-[30px]">
            {{ $products->appends(['category' => $request->getCategory(), 'keyword' => $request->getKeyword()])->links() }}
        </div>

    </section>
@endsection
