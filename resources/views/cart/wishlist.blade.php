@extends('layouts.user')
@section('title', 'Wishlist')
@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
/* wishlist.css */
.add-remove{
    display: flex;
}
.wishlist-container {
    max-width: 800px;
    margin: 40px auto;
    font-family: Arial, sans-serif;
}

.wishlist {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.wishlist-item {
    display: flex;
    background-color: #2d2d2d;
    padding: 15px;
    border-radius: 10px;
    align-items: center;
    gap: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.wishlist-item img {
    border-radius: 10px;
    width: 100px;
    height: 150px;
}

.wishlist-info {
    flex: 1;
    height: 150px;
}

.wishlist-info h2 {
    font-size: 18px;
    font-weight: bold;
    color: #fff;

}

.wishlist-info .tag {
    background-color: #444;
    color: #ccc;
    font-size: 12px;
    padding: 3px 6px;
    border-radius: 4px;
    margin-bottom: 10px;
}

.wishlist-info p {
    color: #f5c518;
    font-size: 14px;
    margin-top: 5px;
}

.wishlist-actions {
    display: flex;
    flex-direction: column;
    justify-content: space-between; 
    text-align: right;
    height: 150px;
}

.wishlist-actions p {
    font-size: 18px;
    font-weight: bold;
    color: #ddd;
}

.wishlist-actions button {
    display: block;
    width: 120px;
    margin-top: 10px;
    padding: 8px;
    border-radius: 6px;
    cursor: pointer;
    border: none;
}

.add-to-cart {
    background-color: #007bff;
    color: white;
}

.add-to-cart:hover {
    background-color: #0056b3;
}

.remove-btn {
    color: rgb(181, 171, 171);
}

.remove-btn:hover {
    color: white;
}
/* Empty Wishlist */
.empty-wishlist {
    text-align: center;
    padding: 50px 20px;
}

.empty-wishlist img {
    width: 50px;
    height: 50px;
    margin-bottom: 10px;
}

.empty-wishlist h2 {
    font-size: 24px;
    font-weight: bold;
    color: black;
}

.empty-wishlist a {
    display: inline-block;
    margin-top: 30px;
    padding: 8px 16px;
    background-color: #007bff;
    color: white;
    border-radius: 6px;
    text-decoration: none;
}

.empty-wishlist a:hover {
    background-color: #0056b3;
}
</style>
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
            <div class="col-lg-12">
                    <h3>My Wishlist</h3>
                    <span class="breadcrumb"><a href="#">Home</a> > Wishlist</span>
                </div>
            </div>
        </div>
    </div>
    @if(($wishlist->Count())>0)
    <div class="wishlist-container">
        <div class="wishlist">
            @foreach ($wishlist as $item)
            <div class="wishlist-item">
                <img src="{{ $item->image }}" alt="Game Cover">
                
                <div class="wishlist-info">
                    <span class="tag">{{ $item->category->name }}</span>
                    <h2>{{ $item->title }}</h2>
                </div>
    
                <div class="wishlist-actions">
                    <p>{{ number_format($item->price, 0, ',', '.') }}$</p>
                    <div class="add-remove">
                        <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                        <form id="qty" action="{{ route('cart.add') }}" method="post" style="padding: 0%; margin: 0%;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="developer" value="{{ $item->developer }}">
                            <input type="hidden" name="quantity" id="qty" value="1">
                            <button type="submit" class="add-to-cart">Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="empty-wishlist">
        <h2>You haven't added anything to your wishlist yet.</h2>
        <a href="{{ route('menu.gameshop') }}">Shop for Games & Apps</a>
    </div>
    @endif

@endsection
