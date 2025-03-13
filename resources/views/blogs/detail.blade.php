@extends('layouts.admin')
@section('title', 'Blog Detail Page')

@section('content')
<div class="container-fluid mt-3">
    <p>{!! $blog->content !!}</p>
</div>
@endsection