@extends('layouts.user')
@section('title', 'list page')

@section('content')
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Modern Warfare® II</h3>
                    <span class="breadcrumb"><a href="/menu">Home</a> > <a href="/accessoryshop">Shop</a> >
                        {{ $accessory->title }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-image">
                        <img src="{{ $accessory->image }}" alt="{{ $accessory->name }}">
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <h4>{{ $accessory->name }}</h4>
                    <span class="price">${{ $accessory->price }}</span>
                    <form id="qty" action="#">
                        <input type="qty" class="form-control" id="1" aria-describedby="quantity"
                            placeholder="1">
                        <button type="submit"><i class="fa fa-shopping-bag"></i> ADD TO CART</button>
                    </form>
                    <ul>
                        <li><span>Type:</span>{{ $accessory->category->name }}</li>
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
                            <div class="nav-wrapper ">
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
                                    <p>{!! html_entity_decode($accessory->description) !!}</p>

                                </div>
                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                    <p>Coloring book air plant shabby chic, crucifix normcore raclette cred swag artisan
                                        activated charcoal. PBR&B fanny pack pok pok gentrify truffaut kitsch helvetica jean
                                        shorts edison bulb poutine next level humblebrag la croix adaptogen. <br><br>Hashtag
                                        poke literally locavore, beard marfa kogi bruh artisan succulents seitan tonx
                                        waistcoat chambray taxidermy. Same cred meggings 3 wolf moon lomo irony cray hell of
                                        bitters asymmetrical gluten-free art party raw denim chillwave tousled try-hard
                                        succulents street art.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section categories related-accessorys">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>Action</h6>
                        <h2>Related accessories</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="shop.html">View All</a>
                    </div>
                </div>
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>Action</h4>
                        <div class="thumb">
                            <a href="product-details.html"><img src="assets/images/categories-01.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>Action</h4>
                        <div class="thumb">
                            <a href="product-details.html"><img src="assets/images/categories-05.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>Action</h4>
                        <div class="thumb">
                            <a href="product-details.html"><img src="assets/images/categories-03.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>Action</h4>
                        <div class="thumb">
                            <a href="product-details.html"><img src="assets/images/categories-04.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-sm-6 col-xs-12">
                    <div class="item">
                        <h4>Action</h4>
                        <div class="thumb">
                            <a href="product-details.html"><img src="assets/images/categories-05.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
