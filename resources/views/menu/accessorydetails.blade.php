@extends('layouts.user')
@section('title', 'list page')

@section('content')
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>{{ $accessory->name ?? 'Unknown Accessory' }}</h3>
                    <span class="breadcrumb"><a href="/">Home</a> > <a href="/accessoryshop">Accessories</a> >
                        {{ $accessory->name ?? 'Unknown' }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-image">
                        <img src="{{ asset($accessory->image ?? 'default-image.jpg') }}"
                            alt="{{ $accessory->name ?? 'No Image' }}">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <h4>{{ $accessory->name ?? 'Unknown' }}</h4>
                    <span class="price">${{ number_format($accessory->price ?? 0, 2) }}</span>

                    {{-- Add to Cart --}}
                    <form action="{{ route('cart.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $accessory->id ?? '' }}">
                        <input type="hidden" name="quantity" id="quantity" value="1">
                        <button type="submit"><i class="fa fa-shopping-bag"></i> ADD TO CART</button>
                    </form>

                    {{-- Wishlist Button --}}
                    <form action="{{ route('wishlist.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $accessory->id }}">
                        <button type="submit"><i class="fa fa-heart"></i> ADD TO WISHLIST</button>
                    </form>

                    <ul>
                        <li><span>Type:</span> {{ $accessory->category->name ?? 'Unknown' }}</li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="sep"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="more-info">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-content">
                        <div class="row">
                            <div class="nav-wrapper">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab"
                                            aria-controls="description" aria-selected="true">Description</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                            data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews"
                                            aria-selected="false">Reviews</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel"
                                    aria-labelledby="description-tab">
                                    <p>{!! nl2br(e($accessory->description ?? 'No description available.')) !!}</p>
                                </div>
                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                    <p>No reviews yet.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section categories related-games">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>{{ $accessory->category->name ?? 'Category' }}</h6>
                        <h2>Related Accessories</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="/accessoryshop">View All</a>
                    </div>
                </div>

                @if (!empty($relatedAccessories) && count($relatedAccessories) > 0)
                    @foreach ($relatedAccessories as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                            <div class="item">
                                <h4>{{ $item->name }}</h4>
                                <div class="thumb">
                                    <a href="{{ route('menu.accessorydetails', $item->id) }}">
                                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <p>No related accessories found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
