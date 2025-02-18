@extends('layouts.user')

@section('title', 'Search Results')

@section('content')
    <div class="main-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="caption header-text">
                        <h6>Search Results</h6>
                        <p>Results for "{{ $query }}"</p>
                        <div class="search-input">
                            <form id="searchForm" action="{{ route('menu.search') }}" method="GET">
                                <input type="text" placeholder="Type Something" id="searchText" name="searchKeyword"
                                    value="{{ $query }}" autocomplete="off">
                                <button type="submit">Search Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section trending">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>Games</h6>
                        <h2>Search Results</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($games->isEmpty() && $accessories->isEmpty())
                    <div class="col-12 text-center">
                        <p>No results found.</p>
                    </div>
                @else
                    @foreach ($games as $game)
                        <div class="col-lg-3 col-md-6">
                            <div class="item">
                                <div class="thumb">
                                    <a href="{{ route('menu.gamedetails', $game->id) }}">
                                        <img src="{{ asset($game->image) }}" alt="{{ $game->title }}">
                                    </a>
                                    <span class="price">${{ $game->price }}</span>
                                </div>
                                <div class="down-content">
                                    <h4>{{ $game->title }}</h4>
                                    <a href="{{ route('menu.gamedetails', $game->id) }}"><i
                                            class="fa fa-shopping-bag"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="section trending">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>Accessories</h6>
                        <h2>Search Results</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($accessories as $accessory)
                    <div class="col-lg-3 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <a href="{{ route('menu.accessorydetails', $accessory->id) }}">
                                    <img src="{{ asset($accessory->image) }}" alt="{{ $accessory->name }}">
                                </a>
                                <span class="price">${{ $accessory->price }}</span>
                            </div>
                            <div class="down-content">
                                <h4>{{ $accessory->name }}</h4>
                                <a href="{{ route('menu.accessorydetails', $accessory->id) }}"><i
                                        class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
