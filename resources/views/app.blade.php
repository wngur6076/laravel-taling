<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>멋블리 - @yield('title')</title>
    <link href="{{ asset('css/app_1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app_2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="{{ asset('js/iziToast.js') }}"></script>
</head>

<body class="t-flex t-flex-col t-min-h-screen t-pt-[56px]">
    <header class="">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
            <div class="container">
                <a class="navbar-brand" href="/"><i class="fab fa-pied-piper-hat"></i> 멋블리</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li
                            class="{{ (Str::startsWith(Route::currentRouteName(), 'products.') and!Str::startsWith(Route::currentRouteName(), 'products.create'))? 't-text-[#0A58CA]': '' }}">
                            <a href="{{ route('products.index') }}" class="t-h-full t-flex t-items-center px-2">
                                <i class="fas fa-tshirt"></i>
                                <span class="t-hidden sm:t-block">&nbsp;</span>
                                <span class="t-hidden sm:t-block t-pt-1">상품 리스트</span>
                            </a>
                        </li>
                        <li
                            class="{{ Str::startsWith(Route::currentRouteName(), 'products.create') ? 't-text-[#0A58CA]' : '' }}">
                            <a href="{{ route('products.create') }}" class="t-h-full t-flex t-items-center px-2">
                                <i class="fas fa-pen"></i>
                                <span class="t-hidden sm:t-block">&nbsp;</span>
                                <span class="t-hidden sm:t-block t-pt-1">상품 추가</span>
                            </a>
                        </li>
                        @guest
                            <li class="{{ Route::currentRouteName() == 'register' ? 't-text-[#0A58CA]' : '' }}">
                                <a href="{{ route('register') }}" class="t-h-full t-flex t-items-center px-2">
                                    <i class="fas fa-user-plus"></i>
                                    <span class="t-hidden sm:t-block">&nbsp;</span>
                                    <span class="t-hidden sm:t-block t-pt-1">회원가입</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'login' ? 't-text-[#0A58CA]' : '' }}">
                                <a href="{{ route('login') }}" class="t-h-full t-flex t-items-center px-2">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span class="t-hidden sm:t-block">&nbsp;</span>
                                    <span class="t-hidden sm:t-block t-pt-1">로그인</span>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="#" class="t-h-full t-flex t-items-center px-2">
                                    <i class="far fa-user"></i>
                                    <span class="t-hidden sm:t-block">&nbsp;</span>
                                    <span class="t-hidden sm:t-block t-pt-1">
                                    {{ Auth::user()->name }}'s 마이페이지
                                </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" class="t-h-full t-flex t-items-center px-2"
                                   onclick="document.logout_form.submit(); return false;">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span class="t-hidden sm:t-block">&nbsp;</span>
                                    <span class="t-hidden sm:t-block t-pt-1">로그아웃</span>
                                </a>
                                <form method="POST" name="logout_form" action="{{ route('logout') }}" class="t-hidden">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                    <form class="d-flex mb-0" action="{{ route('products.index') }}">
                        @if (Route::is('products.index') && $request->getCategory())
                        <input type="hidden" name="category" value="{{ $request->getCategory() }}">
                        @endif
                        <input class="form-control me-2" id="product-search" autocomplete="off" type="search" name="keyword" placeholder="검색어를 입력해주세요."
                            aria-label="Search" required>
                        <button class="btn btn-outline-success t-whitespace-nowrap" type="submit">검색</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- 상단바의 높이만큼 -->
    <div class="t-h-10"></div>

    @include('vendor.lara-izitoast.toast')

    <main class="t-flex-grow t-flex t-flex-col">
        @yield('content')
    </main>

    <section class="t-flex-1 t-flex t-justify-center t-items-center">
        <h1 class="t-text-[20px] t-font-bold">당신이 원하는 모든 의류</h1>
    </section>
</body>

</html>

<script>
    const route = "{{ url('autocomplete-search') }}";

    $('#product-search').typeahead({
        dynamic: true,
        delay: 300,
        source: function (keyword, process) {
            return $.get(route, { keyword: keyword }, function (products) {
                // console.log(products.data)
                const data = [
                    ...products.data.map(product => product['name']),
                    ...products.data.map(product => product['display_name']),
                    ...products.data.map(product => product['description']),

                    ...products.data.map(product => product['market']['name']),
                    ...products.data.map(product => product['category']['name']),
                ];

                return process(Array.from(new Set(data)));
            });
        }
    });
</script>
