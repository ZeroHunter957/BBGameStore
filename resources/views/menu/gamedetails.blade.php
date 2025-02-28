@extends('layouts.user')
@section('title', 'list page')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<style>
    /* Chỉnh sửa giao diện trang bài viết */
    .page-heading {
        background-color: #f8f9fa;
        padding: 40px 0;
        text-align: center;
    }

    .page-heading h3 {
        font-size: 36px;
        color: #333;
        font-weight: 700;
    }

    /* Chỉnh sửa giao diện phần chi tiết sản phẩm/bài viết */
    .single-product .container {
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .single-product .left-image img {
        max-width: 100%;
        border-radius: 8px;
    }

    .single-product .align-self-center h1 {
        font-size: 30px;
        color: #333;
        font-weight: 600;
    }

    .single-product .align-self-center p {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
        margin-top: 15px;
    }

    /* Đổi màu cho các bình luận */
    .comment {
        background-color: #f1f1f1;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .comment h5 {
        font-size: 18px;
        font-weight: 600;
        color: #007bff;
        margin-bottom: 10px;
    }

    .comment p {
        font-size: 16px;
        color: #444;
        line-height: 1.6;
    }

    /* Form bình luận */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group input,
    .form-group textarea {
        border-radius: 8px;
        padding: 10px;
        font-size: 16px;
        width: 100%;
        border: 1px solid #ccc;
    }

    .form-group textarea {
        resize: vertical;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        color: white;
        font-size: 16px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .alert-danger {
        color: #dc3545;
        background-color: #f8d7da;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .sep {
        border-top: 2px solid #ccc;
        margin-top: 30px;
        margin-bottom: 30px;
    }
</style>

<style>
    .comment {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .comment-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .comment-header .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 15px;
        object-fit: cover;
    }

    .comment-info h5 {
        font-size: 18px;
        font-weight: bold;
        color: #007bff;
    }

    .comment-info small {
        color: #888;
        font-size: 12px;
    }

    /* Comment Content */
    .comment p {
        font-size: 16px;
        color: #444;
        line-height: 1.6;
        margin-bottom: 10px;
    }

    /* Comment Action Buttons (Like, Reply) */
    .comment-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .comment-actions button {
        font-size: 14px;
        color: #007bff;
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .comment-actions button:hover {
        text-decoration: underline;
    }

    .comment-actions span {
        font-size: 14px;
        color: #555;
    }

    /* Reply Section */
    .comment.ml-4 {
        margin-left: 40px;
    }

    #reply-form- {
            {
            $comment->id
        }
    }

        {
        margin-top: 15px;
    }

    #reply-form- {
            {
            $comment->id
        }
    }

    textarea {
        border-radius: 8px;
        padding: 10px;
        font-size: 14px;
        width: 100%;
        border: 1px solid #ccc;
    }

    #reply-form- {
            {
            $comment->id
        }
    }

    .btn-primary {
        margin-top: 10px;
    }

    /* Adjust the spacing between comments */
    .comment+.comment {
        margin-top: 10px;
    }
</style>

<style>
    /* Avatar style */
    .user-info {
        display: flex;
        align-items: center;
    }

    .user-info img.avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    /* Optional: Style the user name and time */
    .user-info h5 {
        font-size: 16px;
        margin: 0;
    }

    .comment {
        margin-bottom: 20px;
    }

    .comment p {
        margin-top: 10px;
    }

    .comment .btn-link {
        text-decoration: none;
        font-size: 14px;
    }

    /* Reply form styling */
    textarea.form-control {
        width: 100%;
        max-width: 400px;
    }

    /* Adjusting reply button style */
    .comment .btn-primary {
        margin-top: 10px;
    }
</style>
<style>
    .star-rating {
        display: flex;
        direction: row-reverse;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
        padding: 0 5px;
    }

    .star-rating input[type="radio"]:checked~label,
    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #FFD700;
    }
</style>


<style>
    .custom-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        padding: 10px;
    }

    .custom-pagination .prev,
    .custom-pagination .next,
    .custom-pagination .page,
    .custom-pagination .current {
        padding: 10px 15px;
        margin: 0 5px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .custom-pagination .prev:hover,
    .custom-pagination .next:hover,
    .custom-pagination .page:hover {
        background-color: #007bff;
        color: #fff;
    }

    .custom-pagination .disabled {
        color: #ccc;
        cursor: not-allowed;
    }

    .custom-pagination .current {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
    }

    .custom-pagination .page {
        text-decoration: none;
    }

    .custom-pagination .prev,
    .custom-pagination .next {
        font-weight: bold;
    }
</style>
@section('content')
<div class="page-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>{{ $game->title }}</h3>
                <span class="breadcrumb"><a href="/menu">Home</a> > <a href="/gameshop">Shop</a> >
                    {{ $game->title }}</span>
            </div>
        </div>
    </div>
</div>

<div class="single-product section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-image">
                    <img src="{{ $game->image }}" alt="{{ $game->title }}">
                </div>
            </div>
            <div class="col-lg-6 align-self-center">
                <h4>{{ $game->title }}</h4>
                <span class="price">${{ $game->price }}</span>
                <form id="qty" action="{{route('cart.add')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$game->id}}">
                    <input type="hidden" name="developer" value="{{ $game->developer }}">
                    <input type="hidden" name="quantity" id="qty" value="1">
                    <button type="submit"><i class="fa fa-shopping-bag"></i> ADD TO CART</button>
                </form>
                <ul>
                    <li><span>Genre:</span>{{ $game->category->name }}</li>

                    <li><span>Developer:</span> {{ $game->developer }}</li>
                    <li><span>Release date:</span> {{ $game->release_date }}</li>
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
                                <p>{!! html_entity_decode($game->description) !!}</p>

                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <h3>Feedbacks</h3>
                                <form method="GET" action="{{ route('menu.gamedetails', $game->id) }}" class="mb-3">
                                    <label for="sort">Sort by:</label>
                                    <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                                        <option value="star_desc" {{ request('sort') == 'star_desc' ? 'selected' : '' }}>Highest Rating (Star) to Lowest</option>
                                        <option value="star_asc" {{ request('sort') == 'star_asc' ? 'selected' : '' }}>Lowest Rating (Star) to Highest</option>
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                                    </select>
                                </form>


                                <!-- Display average rating and total feedbacks -->
                                <div class="rating-summary">
                                    <strong>Average Rating: </strong> {{ number_format($averageRating, 1) }}/5 ({{ $totalFeedbacks }} feedbacks)
                                </div>

                                @if ($errors->has('feedback'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('feedback') }}
                                </div>
                                @endif

                                <!-- Loop through feedbacks -->
                                @foreach ($feedbacks as $feedback)
                                <div class="comment">
                                    <div class="user-info">
                                        <img src="https://static-00.iconduck.com/assets.00/avatar-default-symbolic-icon-479x512-n8sg74wg.png" alt="Avatar" class="avatar">
                                        <h5>{{ $feedback->user->name }}</h5>
                                    </div>
                                    <p>{!! $feedback->content !!}</p>
                                    <small>{{ $feedback->created_at->format('Y-m-d H:i') }}</small>

                                    <!-- Rating stars -->
                                    <div class="star-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star{{ $feedback->star >= $i ? '' : '-o' }}" style="color: #f39c12;"></i>
                                            @endfor
                                    </div>

                                    <!-- Feedback like button -->
                                    <form action="{{ route('feedback.likeFeedback', $feedback->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-link">
                                            @if ($feedback->likeFeedbacks->where('user_id', session('accountLogin'))->count() > 0)
                                            Unlike
                                            @else
                                            Like
                                            @endif
                                        </button>
                                    </form>
                                    <span>{{ $feedback->likeFeedbacks_count }} Likes</span>

                                    <button class="btn btn-link" onclick="showReplyForm({{ $feedback->id }})">Reply</button>

                                    @if (session('accountLogin') == $feedback->user_id)
                                    <form action="{{ route('feedback.deleteFeedback', $feedback->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endif

                                    <!-- Reply Form -->
                                    <div id="reply-form-{{ $feedback->id }}" style="display:none;">
                                        <form action="{{ route('feedback.replyFeedback', $feedback->id) }}" method="POST" onsubmit="handleReplySubmit(event, {{ $feedback->id }})">
                                            @csrf
                                            <textarea id="reply-textarea-{{ $feedback->id }}" name="content" class="form-control" placeholder="Your Reply" rows="3" required></textarea>
                                            <div id="reply-preview-{{ $feedback->id }}" class="comment-preview"></div>
                                            <button type="submit" class="btn btn-primary mt-2">Post Reply</button>
                                            <button type="button" class="btn btn-danger mt-2" onclick="closeReplyForm({{ $feedback->id }})">Close</button>
                                        </form>
                                    </div>

                                    <!-- Replies -->
                                    @foreach ($feedback->replyFeedbacks as $reply)
                                    <div class="comment ml-4">
                                        <div class="user-info">
                                            <img src="https://static-00.iconduck.com/assets.00/avatar-default-symbolic-icon-479x512-n8sg74wg.png" alt="Avatar" class="avatar">
                                            <h5>{{ $reply->user->name }}</h5>
                                        </div>
                                        <p>{!! $reply->content !!}</p>
                                        <div class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa fa-star {{ $i <= $feedback->star ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                        </div>
                                        <small>{{ $reply->created_at->format('Y-m-d H:i') }}</small>

                                        <form action="{{ route('feedback.likeReplyFeedback', $reply->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-link">
                                                @if ($reply->likeFeedbacks->where('user_id', session('accountLogin'))->count() > 0)
                                                Unlike
                                                @else
                                                Like
                                                @endif
                                            </button>
                                        </form>
                                        <span>{{ $reply->likeFeedbacks->count() }} Likes</span>

                                        @if (session('accountLogin') == $reply->user_id)
                                        <form action="{{ route('feedback.deleteReplyFeedback', $reply->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach

                                <div class="custom-pagination">
                                    @if ($feedbacks->onFirstPage())
                                    <span class="disabled prev">Prev</span>
                                    @else
                                    <a href="{{ $feedbacks->previousPageUrl() }}" class="prev">Prev</a>
                                    @endif

                                    @foreach ($feedbacks->getUrlRange(1, $feedbacks->lastPage()) as $page => $url)
                                    @if ($page == $feedbacks->currentPage())
                                    <span class="current">{{ $page }}</span>
                                    @else
                                    <a href="{{ $url }}" class="page">{{ $page }}</a>
                                    @endif
                                    @endforeach

                                    @if ($feedbacks->hasMorePages())
                                    <a href="{{ $feedbacks->nextPageUrl() }}" class="next">Next</a>
                                    @else
                                    <span class="disabled next">Next</span>
                                    @endif
                                </div>


                                @if (Auth::check())
                                <form action="{{ route('feedback.storeFeedback', $game->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="content">Your Feedback</label>
                                        <textarea name="content" class="form-control" placeholder="Your Feedback" rows="5" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="star-rating">Rating:</label>
                                        <div class="star-rating">
                                            <input type="radio" id="star5" name="star" value="5" required><label for="star5" class="fa fa-star"></label>
                                            <input type="radio" id="star4" name="star" value="4"><label for="star4" class="fa fa-star"></label>
                                            <input type="radio" id="star3" name="star" value="3"><label for="star3" class="fa fa-star"></label>
                                            <input type="radio" id="star2" name="star" value="2"><label for="star2" class="fa fa-star"></label>
                                            <input type="radio" id="star1" name="star" value="1"><label for="star1" class="fa fa-star"></label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Post Feedback</button>
                                </form>
                                @else
                                <a href="{{ route('account.login') }}" class="btn btn-primary">Login to Feedback</a>
                                @endif
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
                    <h6>{{ $game->category->name }}</h6>
                    <h2>Related Games</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="main-button">
                    <a href="/gameshop">View All</a>
                </div>
            </div>

            @foreach ($relatedGames as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                <div class="item">
                    <h4>{{ $item->title }}</h4>
                    <div class="thumb">
                        <a href="{{ route('menu.gamedetails', $item->id) }}">
                            <img src="{{ $item->image }}" alt="{{ $item->title }}">
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            @if ($relatedGames->isEmpty())
            <div class="col-lg-12">
                <p>No related games found.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

<script>
    function showReplyForm(commentId) {
        document.getElementById(`reply-form-${commentId}`).style.display = 'block';
    }

    function closeReplyForm(commentId) {
        document.getElementById(`reply-form-${commentId}`).style.display = 'none';
    }
</script>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        const bannedWords = @json($bannedWords).map(word => word.toLowerCase()); // Convert all banned words to lowercase
        const commentContent = document.querySelector('textarea[name="content"]').value.toLowerCase(); // Convert content to lowercase

        let foundBannedWords = [];
        let highlightedContent = commentContent;

        bannedWords.forEach(function(word) {
            if (commentContent.includes(word)) {
                foundBannedWords.push(word);
                const regex = new RegExp(`(${word})`, 'gi');
                highlightedContent = highlightedContent.replace(regex, '<span class="highlight">$1</span>');
            }
        });

        if (foundBannedWords.length > 0) {
            document.querySelector('.comment-preview').innerHTML = highlightedContent;
            event.preventDefault();
        }
    });

    function checkBannedWordsForReply(event, commentId) {
        const bannedWords = @json($bannedWords).map(word => word.toLowerCase()); // Convert all banned words to lowercase
        const replyContent = document.getElementById(`reply-textarea-${commentId}`).value.toLowerCase(); // Convert reply content to lowercase

        let foundBannedWords = [];
        let highlightedContent = replyContent;

        bannedWords.forEach(function(word) {
            if (replyContent.includes(word)) {
                foundBannedWords.push(word);
                const regex = new RegExp(`(${word})`, 'gi');
                highlightedContent = highlightedContent.replace(regex, '<span class="highlight">Your reply contains a banned word: $1</span>');
            }
        });

        if (foundBannedWords.length > 0) {
            document.querySelector('.comment-preview').innerHTML = highlightedContent;
            event.preventDefault();
        }
    }

    function handleReplySubmit(event, commentId) {
        checkBannedWordsForReply(event, commentId);
    }
</script>

<script>
    function showReplyForm(commentId) {
        const replyForm = document.getElementById(`reply-form-${commentId}`);

        if (replyForm.style.display === "none" || replyForm.style.display === "") {
            replyForm.style.display = "block";
        }
    }

    function closeReplyForm(commentId) {
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        replyForm.style.display = "none";
    }
</script>
@endsection