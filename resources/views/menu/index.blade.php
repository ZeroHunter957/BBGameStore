@extends('layouts.user')
@section('title', 'list page')
@section('content')
    <div class="main-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="caption header-text">
                        <h6>Welcome to BBGameStore</h6>
                        <p>Find games and gaming accessories for everybody
                        </p>
                        <div class="search-input">
                            <form id="searchForm" action="{{ route('menu.search') }}" method="GET">
                                <input type="text" placeholder="Type product name" id="searchText" name="searchKeyword"
                                    autocomplete="off">
                                <button type="submit">Search Now</button>
                            </form>
                            <ul id="searchResults"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="right-image">
                        @if ($todaysPick)
                            <a href="{{ route('menu.gamedetails', $todaysPick->id) }}">
                                <img src="{{ asset($todaysPick->image) }}" alt="{{ $todaysPick->title }}">
                            </a>
                            <span class="price">${{ $todaysPick->price }}</span>
                            <span class="">Today's Pick</span>
                        @else
                            <p>No game selected for Today's Pick.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <a href="#">
                        <div class="item">
                            <div class="image">
                                <img src="assets/images/featured-01.png" alt="" style="max-width: 44px;">
                            </div>
                            <h4>Free Storage</h4>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#">
                        <div class="item">
                            <div class="image">
                                <img src="assets/images/featured-02.png" alt="" style="max-width: 44px;">
                            </div>
                            <h4>User More</h4>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#">
                        <div class="item">
                            <div class="image">
                                <img src="assets/images/featured-03.png" alt="" style="max-width: 44px;">
                            </div>
                            <h4>Reply Ready</h4>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#">
                        <div class="item">
                            <div class="image">
                                <img src="assets/images/featured-04.png" alt="" style="max-width: 44px;">
                            </div>
                            <h4>Easy Layout</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="section trending">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>Games</h6>
                        <h2>Trending Games</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="gameshop">View All</a>
                    </div>
                </div>
                @foreach ($games as $item)
                    <div class="col-lg-3 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <a href="{{ route('menu.gamedetails', $item->id) }}">
                                    <img src="{{ $item->image }}" alt="">
                                </a>
                                <span class="price">${{ $item->price }}</span>
                            </div>
                            <div class="down-content">
                                <span class="category">{{ $item->category->name }}</span>
                                <h4>{{ $item->title }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="section most-played">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>TOP GAMES</h6>
                        <h2>Classics</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="gameshop">View All</a>
                    </div>
                </div>
                @foreach ($games->take(6) as $item)
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="item">
                            <div class="thumb">
                                <a href="{{ route('menu.gamedetails', $item->id) }}"><img src="{{ $item->image }}"
                                        alt=""></a>
                            </div>
                            <div class="down-content">
                                <span class="category">{{ $item->category->name }}</span>
                                <h4>{{ $item->title }}</h4>
                                <a href="{{ route('menu.gamedetails', $item->id) }}">Explore</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="section categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-heading">
                        <h6>Categories</h6>
                        <h2>Top Categories</h2>
                    </div>
                </div>

                @foreach ($games->groupBy('category.name') as $categoryName => $gamesInCategory)
                    @php
                        $game = $gamesInCategory->first(); // Get one game from this category
                    @endphp

                    <div class="col-lg col-sm-6 col-xs-12">
                        <div class="item">
                            <a href="{{ route('menu.gameshop') }}">
                                <h4>{{ $categoryName }}</h4>
                                <div class="thumb">
                                    <a href="{{ route('menu.gamedetails', $game->id) }}">
                                        <img src="{{ $game->image }}" alt="{{ $categoryName }}">
                                    </a>
                                </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="section trending">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>Accessories</h6>
                        <h2>Top Accessories</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="accessoryshop">View All</a>
                    </div>
                </div>
                @foreach ($accessories as $item)
                    <div class="col-lg-3 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <a href="{{ route('menu.accessorydetails', $item->id) }}"><img src="{{ $item->image }}"
                                        alt=""></a>
                                <span class="price">${{ $item->price }}</span>
                            </div>
                            <div class="down-content">
                                <span class="category">{{ $item->category->name }}</span>
                                <h4>{{ $item->name }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="section cta">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="shop">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <h6>Our Shop</h6>
                                    <h2>Go Pre-Order Buy & Get Best <em>Prices</em> For You!</h2>
                                </div>
                                <p>Lorem ipsum dolor consectetur adipiscing, sed do eiusmod tempor incididunt.</p>
                                <div class="main-button">
                                    <a href="gameshop">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-2 align-self-end">
                    <div class="subscribe">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <h6>NEWSLETTER</h6>
                                    <h2>Get Up To $100 Off Just Buy <em>Subscribe</em> Newsletter!</h2>
                                </div>
                                <div class="search-input">
                                    <form id="subscribe" action="#">
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Your email...">
                                        <button type="submit">Subscribe Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Search script --}}
    <script>
        document.getElementById('searchText').addEventListener('input', function() {
            let query = this.value;
            if (query.length < 2) return; // Only search if at least 2 characters

            fetch(`{{ route('menu.search') }}?searchKeyword=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    let resultsList = document.getElementById('searchResults');
                    resultsList.innerHTML = '';

                    data.games.forEach(game => {
                        let li = document.createElement('li');
                        li.innerHTML = `<a href="/game/${game.id}">${game.title}</a>`;
                        resultsList.appendChild(li);
                    });

                    data.accessories.forEach(acc => {
                        let li = document.createElement('li');
                        li.innerHTML = `<a href="/accessory/${acc.id}">${acc.name}</a>`;
                        resultsList.appendChild(li);
                    });
                });
        });
    </script>
@endsection
