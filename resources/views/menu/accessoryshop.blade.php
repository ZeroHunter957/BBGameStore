@extends('layouts.user')
@section('title', 'list page')

@section('content')
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Accessory Shop</h3>
                    <span class="breadcrumb"><a href="/">Home</a> > Accessories</span>
                </div>
            </div>
        </div>
    </div>

    <div class="section trending">
        <!-- Price Sorting Buttons -->
        <ul class="trending-filter sorting-options">
            <li><a href="#" data-sort="default" class="is_active">Sort By Order</a></li>
            <li><a href="#" data-sort="price:asc">Price: Low to High</a></li>
            <li><a href="#" data-sort="price:desc">Price: High to Low</a></li>
        </ul>

        <div class="container">
            <!-- Category Filter Buttons -->
            <ul class="trending-filter">
                <li>
                    <a class="is_active" href="#" data-filter="all">Show All</a>
                </li>
                @foreach ($accessorycates as $item)
                    <li>
                        <a href="#" data-filter=".{{ Str::slug($item->name) }}">{{ $item->name }}</a>
                    </li>
                @endforeach
            </ul>

            <div id="accessory-container">
                <div class="row">
                    @foreach ($accessories as $item)
                        <div class="col-lg-3 col-md-6 mix {{ Str::slug($item->category->name) }}"
                            data-price="{{ $item->price }}">
                            <div class="item">
                                <div class="thumb">
                                    <a href="{{ route('menu.accessorydetails', $item->id) }}">
                                        <img src="{{ $item->image }}" alt="image">
                                    </a>
                                    <span class="price">${{ $item->price }}</span>
                                </div>
                                <div class="down-content">
                                    <span class="category">{{ $item->category->name }}</span>
                                    <h4>{{ $item->name }}</h4>
                                    <a href="{{ route('menu.accessorydetails', $item->id) }}">
                                        <i class="fa fa-shopping-bag"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- MixItUp Filtering Script --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var mixer = mixitup("#accessory-container .row", {
                    selectors: {
                        target: ".mix"
                    },
                    animation: {
                        duration: 300
                    }
                });

                // Handle category filtering
                document.querySelectorAll(".trending-filter:not(.sorting-options) a").forEach(button => {
                    button.addEventListener("click", function(event) {
                        event.preventDefault();

                        // Remove 'is_active' from category buttons only
                        document.querySelector(".trending-filter:not(.sorting-options) .is_active")
                            ?.classList.remove("is_active");
                        this.classList.add("is_active");

                        let filterValue = this.getAttribute("data-filter");
                        mixer.filter(filterValue === "all" ? "all" : filterValue);
                    });
                });

                // Handle sorting buttons separately
                document.querySelectorAll(".sorting-options a").forEach(button => {
                    button.addEventListener("click", function(event) {
                        event.preventDefault();

                        // Remove 'is_active' from sorting buttons only
                        document.querySelector(".sorting-options .is_active")?.classList.remove(
                            "is_active");
                        this.classList.add("is_active");

                        let sortValue = this.getAttribute("data-sort");
                        if (sortValue === "price:asc") {
                            mixer.sort("price:asc");
                        } else if (sortValue === "price:desc") {
                            mixer.sort("price:desc");
                        } else {
                            mixer.sort("default");
                        }
                    });
                });
            });
        </script>
    </div>
@endsection
