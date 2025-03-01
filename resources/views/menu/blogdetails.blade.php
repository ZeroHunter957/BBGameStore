@extends('layouts.user')
@section('title', 'list page')

@section('content')
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

<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3>{{ $blog->title }}</h3>
        <h6>Created at {{ $blog->created_at }}</h6>
        <h6>Created by {{ $blog->user->name }}</h6>
      </div>
    </div>
  </div>
</div>

<!-- Hiển thị thông tin bài viết -->
<div class="single-product section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="left-image">
          <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
        </div>
      </div>
      <div class="col-lg-6 align-self-center">
        <h1>{{ $blog->title }}</h1>
        <p>{!! $blog->content !!}</p>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="sep"></div>
    </div>
  </div>
</div>

<div class="container">
  <h3>Comments</h3>

  @if ($errors->has('comment'))
  <div class="alert alert-danger">
    {{ $errors->first('comment') }}
  </div>
  @endif

  @foreach ($comments as $comment)
  <div class="comment">
    <div class="user-info">
      <img src="https://static-00.iconduck.com/assets.00/avatar-default-symbolic-icon-479x512-n8sg74wg.png" alt="Avatar" class="avatar">
      <h5>{{ $comment->user->name }}</h5>
    </div>
    <p>{!! $comment->content !!}</p>
    <small>{{ $comment->created_at->format('Y-m-d H:i') }}</small>

    <!-- Like Button for Comment -->
    <form action="{{ route('comment.like', $comment->id) }}" method="POST" style="display:inline;">
      @csrf
      <button type="submit" class="btn btn-link">
        @if ($comment->likes->where('user_id', Auth::id())->count() > 0)
        Unlike
        @else
        Like
        @endif
      </button>
    </form>
    <span>{{ $comment->likes->count() }} Likes</span>

    <!-- Reply Button -->
    <button class="btn btn-link" onclick="showReplyForm({{ $comment->id }})">Reply</button>

    @if (Auth::id() == $comment->user_id)
    <form action="{{ route('comment.delete', $comment->id) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>
    @endif

    <!-- Reply Form -->
    <div id="reply-form-{{ $comment->id }}" style="display:none;">
      <form action="{{ route('comment.reply', $comment->id) }}" method="POST" onsubmit="handleReplySubmit(event, {{ $comment->id }})">
        @csrf
        <textarea id="reply-textarea-{{ $comment->id }}" name="content" class="form-control" placeholder="Your Reply" rows="3" required></textarea>
        <div id="reply-preview-{{ $comment->id }}" class="comment-preview"></div>
        <button type="submit" class="btn btn-primary mt-2">Post Reply</button>
        <button type="button" class="btn btn-danger mt-2" onclick="closeReplyForm({{ $comment->id }})">Close</button>
      </form>
    </div>

    <!-- Replies -->
    @foreach ($comment->replies as $reply)
    <div class="comment ml-4">
      <div class="user-info">
        <img src="https://static-00.iconduck.com/assets.00/avatar-default-symbolic-icon-479x512-n8sg74wg.png" alt="Avatar" class="avatar">
        <h5>{{ $reply->user->name }}</h5>
      </div>
      <p>{!! $reply->content !!}</p>
      <small>{{ $reply->created_at->format('Y-m-d H:i') }}</small>

      <!-- Like Button for Reply -->
      <form action="{{ route('comment.likeReply', $reply->id) }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-link">
          @if ($reply->likes->where('user_id', Auth::id())->count() > 0)
          Unlike
          @else
          Like
          @endif
        </button>
      </form>
      <span>{{ $reply->likes->count() }} Likes</span>

      <!-- Delete Reply Button -->
      @if (Auth::id() == $reply->user_id)
      <form action="{{ route('comment.deleteReply', $reply->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
      </form>
      @endif
    </div>
    @endforeach
  </div>
  @endforeach

  <!-- Comment Form -->
  @if (Auth::check())
  
  <form action="{{ route('comments.store', $blog->id) }}" method="POST">
    @csrf
    <div class="form-group">
      <textarea name="content" class="form-control" placeholder="Your Comment" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Post Comment</button>
  </form>
  @else
  <a href="{{ route('account.login') }}" class="btn btn-primary">Login to Comment</a>
  @endif
</div>

<script>
  function showReplyForm(commentId) {
    document.getElementById(`reply-form-${commentId}`).style.display = 'block';
  }

  function closeReplyForm(commentId) {
    document.getElementById(`reply-form-${commentId}`).style.display = 'none';
  }
</script>




<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets/js/counter.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
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