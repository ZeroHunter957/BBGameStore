@extends('layouts.user')
@push('styles')
    <style>
        .empty-cart-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 60vh;
            /* Căn giữa theo chiều dọc */
            text-align: center;
        }

        .empty-cart-container h2 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .empty-cart-container h5 {
            font-size: 18px;
            color: #666;
            margin-bottom: 20px;
        }

        .empty-cart-container .btn-warning {
            background-color: #FF9800;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .empty-cart-container .btn-warning:hover {
            background-color: #e68900;
            transform: scale(1.05);
        }
    </style>
@endpush
@section('content')
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Cart </h3>
                    <span class="breadcrumb"><a href="/menu">Home</a> > Cart</span>
                </div>
            </div>
        </div>
    </div>

    @if ($cartItems->Count() > 0)
        <section class="cart-section section-b-space">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <table class="table cart-table">
                            <thead>
                                <tr class="table-head">
                                    <th scope="col">image</th>
                                    <th scope="col">product name</th>
                                    <th scope="col">price</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">total</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>
                                            <a href="../product/details.html">
                                                <img src="{{ $item->model->image }}" class="blur-up lazyloaded"
                                                    alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="../product/details.html">{{ $item->model->title?$item->model->title:$item->model->name }}</a>
                                            <div class="mobile-cart-content row">
                                                <div class="col">
                                                    <div class="qty-box">
                                                        <div class="input-group">
                                                            <input type="text" name="quantity"
                                                                class="form-control input-number" value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <h2>{{ $item->price }}</h2>
                                                </div>
                                                <div class="col">
                                                    <h2 class="td-color">
                                                        <a href="javascript:void(0)">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h2>{{ $item->price }}$</h2>
                                        </td>
                                        <td>
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <input type="number" name="quantity" data-rowid="{{ $item->rowId }}"
                                                        onchange="updateQuantity(this)" class="form-control input-number"
                                                        value="{{ $item->qty }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h2 class="td-color">{{ $item->subtotal() }}$</h2>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="removeItem('{{ $item->rowId }}')">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 mt-md-5 mt-4">
                        <div class="row">
                            <div class="col-sm-7 col-5 order-1">
                                <div class="left-side-button text-end d-flex d-block justify-content-end">
                                    <a href="javascript:void(0)"
                                        class="text-decoration-underline theme-color d-block text-capitalize"
                                        onclick="clearCart()">clear
                                        all items</a>
                                </div>
                            </div>
                            <div class="col-sm-5 col-7">
                                <div class="left-side-button float-start">
                                    <a href="../shop.html" class="btn btn-solid-default btn fw-bold mb-0 ms-0">
                                        <i class="fas fa-arrow-left"></i> Continue Shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-checkout-section">
                        <div class="row g-4">
                            <div class="col-lg-4 col-sm-6">
                                <div class="promo-section">
                                    <form class="row g-3">
                                        <div class="col-7">
                                            <input type="text" class="form-control" id="number"
                                                placeholder="Coupon Code">
                                        </div>
                                        <div class="col-5">
                                            <button class="btn btn-solid-default rounded btn">Apply Coupon</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 ">
                                <div class="checkout-button">
                                    <a href="checkout" class="btn btn-solid-default btn fw-bold">
                                        Check Out <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="cart-box">
                                    <div class="cart-box-details">
                                        <div class="total-details">
                                            <div class="top-details">
                                                <h3>Cart Totals</h3>
                                                <h6>Sub Total <span>{{ Cart::instance('cart')->subtotal() }}</span></h6>
                                                <h6>Tax <span>{{ Cart::instance('cart')->tax() }}</span></h6>

                                                <h6>Total <span>{{ Cart::instance('cart')->total() }}</span></h6>
                                            </div>
                                            <div class="bottom-details">
                                                <a href="checkout">Process Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="row">
            <div class="col-md-12 empty-cart-container">
                <h2>Your cart is empty !</h2>
                <h5 class="mt-3">Add Items to it now.</h5>
                <a href="{{ route('menu.gameshop') }}" class="btn btn-warning mt-4">Shop now</a>
            </div>
        </div>
    @endif
    <form action="{{ route('cart.update') }}" id="UpdateCartQty" method="post">
        @csrf
        @method('put')
        <input type="hidden" id="rowId" name="rowId">
        <input type="hidden" id="quantity" name="quantity">
    </form>
    <form action="{{ route('cart.remove') }}" id="removeItem" method="post">
        @csrf
        @method('delete')
        <input type="hidden" id="rowId_D" name="rowId">
    </form>
    <form action="{{ route('cart.clear') }}" id="clearCart" method="post">
        @csrf
        @method('delete')
    </form>
@endsection
@push('scripts')
    <script>
        function updateQuantity(qty) {
            $('#rowId').val($(qty).data('rowid'));
            $('#quantity').val($(qty).val());
            $('#UpdateCartQty').submit();
        }

        function removeItem(rowId) {
            $('#rowId_D').val(rowId);
            $('#removeItem').submit();
        }

        function clearCart() {
            $('#clearCart').submit();
        }
    </script>
@endpush
