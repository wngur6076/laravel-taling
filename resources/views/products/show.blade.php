@extends('app')

@section('title', '상품 상세내용')

@section('content')
    <section class="container section-prod-detail t-my-3">
        <div class="t-mb-2">
            @can('update', $product)
            <a class="btn btn-primary t-mr-auto" href="{{ route('products.edit', $product->serial_number) }}">
                <i class="fas fa-pen"></i>
                수정
            </a>
            @endcan
            @can('delete', $product)
            <form class="t-inline-block t-mb-0" action="{{ route('products.destroy', $product->serial_number) }}" method="POST"
                  onsubmit="return confirm('정말 삭제하시겠습니까')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger t-mr-auto">
                    <i class="fas fa-trash-alt"></i>
                    삭제
                </button>
            </form>
            @endcan
        </div>
        <div class="t-grid lg:t-grid-cols-[3fr_4fr] t-gap-3 t-items-start">

            <div class=" lg:!t-sticky lg:t-top-[76px]">
                <div class="card">
                    <div class="card-header">
                        상품상세정보
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="t-p-2">
                            <a href="#product-img"><img class="t-w-full t-max-w-100 t-rounded"
                                src="{{ $product->thumbnailUrl() }}" alt="">
                            </a>
                        </li>
                        <li class="list-group-item">
                            <span class="t-w-16 t-inline-block common-label">상품번호</span>
                            <span class="badge bg-danger">{{ $product->serial_number }}</span>
                        </li>
                        <li class="list-group-item">
                            <span class="t-w-16 t-inline-block common-label">마켓</span>
                            <span class="badge t-bg-teal-700">{{ $product->market->name }}</span>
                        </li>
                        <li class="list-group-item">
                            <span class="t-w-16 t-inline-block common-label">카테고리</span>
                            <span class="badge bg-dark">{{ $product->category->name }}</span>
                        </li>
                        <li class="list-group-item">
                            <span class="t-w-16 t-inline-block common-label">상품명</span>
                            <span>{{ $product->display_name }}</span>
                        </li>
                        <li class="list-group-item">
                            <span class="t-w-16 t-inline-block common-label">가격</span>
                            <span>{{ $product->sale_price_in_wons }}원</span>
                            <span class="t-text-gray-400 t-line-through">{{ $product->price_in_wons }}원</span>
                        </li>
                        <li class="list-group-item">
                            <span class="t-w-16 t-inline-block common-label">색상</span>
                            {!! $product->colors !!}
                        </li>
                        <li class="list-group-item">
                            <span class="t-w-16 t-inline-block common-label">좋아요</span>
                            @auth
                                @if ($product->isFavorited())
                                <form method="POST" class="t-inline-block t-mb-0 one-text-button-form" action="{{ route('product-favorites.destroy', $product->serial_number) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="t-text-[#ff0000]">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>
                                @else
                                <form method="POST" class="t-inline-block t-mb-0 one-text-button-form" action="{{ route('product-favorites.store', $product->serial_number) }}">
                                    @csrf
                                    <button type="submit" class="t-text-[#ff0000]">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </form>
                                @endif
                            @else
                            <a class="t-text-[#ff0000]" href="{{ route('login') }}">
                                <i class="far fa-heart"></i>
                            </a>
                            @endauth
                        </li>
                    </ul>
                </div>

            </div>


            <div class="card lg:!t-sticky lg:t-top-[76px] h-100">
                <div class="card-header">
                    옵션
                </div>

                <div class="card-body">
                    <div class="table-responsive h-100">
                        <table class="table table-hover">
                            <colgroup>
                                <col class="sm:t-w-20">
                                <col class="sm:t-w-30">
                                <col class="sm:t-w-30">
                                <col class="sm:t-w-30">
                                <col class="sm:t-w-30">
                            </colgroup>
                            <thead>
                            <tr>
                                <th>사이즈</th>
                                <th>색상</th>
                                <th>수량</th>
                                <th>가격</th>
                                <th>품절</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product->productReals as $productReal)
                            <tr>
                                <td>
                                    {{ $productReal->option_1_display_name }}
                                </td>
                                <td>
                                    {{ $productReal->option_2_display_name }}
                                    <span class="t-inline-block t-rounded-full t-w-[10px] t-h-[10px]"
                                          style="background-color:#{{ $productReal->rgb_color }}"></span>
                                </td>
                                <td>
                                    {{ $productReal->stock_quantity }}개
                                </td>
                                <td>
                                    +{{ $productReal->add_price_in_wons }}원
                                </td>
                                <td>
                                    @if ($productReal->is_sold_out)
                                    <span class="badge bg-secondary">품절</span>
                                    @else
                                    <span class="badge bg-primary">판매중</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="t-mt-3">
            <a href="#">
                <img style="scroll-margin-top:72px;" id="product-img" class="t-w-full t-block rounded"
                     src="{{ $product->thumbnailUrl() }}" alt="">
            </a>
        </div>
    </section>
@endsection
