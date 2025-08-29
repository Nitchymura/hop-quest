<div class="bg-green">
@extends('layouts.app')

@section('title', 'Spots')

@section('content')

@include('home.posts.post-header')

<div class="mt-4 mb-5 row justify-content-center">
    <div class="col-8 mb-5 ">
        <div class="col-2 ms-auto dropdown">
            <form method="GET" action="{{ route('posts.spots') }}">
                <select name="sort" onchange="this.form.submit()" class="form-control">
                    <option value="" disabled selected>Sort</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest </option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                    <option value="likes" {{ request('sort') == 'likes' ? 'selected' : '' }}>Number of Likes</option>
                    <option value="comments" {{ request('sort') == 'comments' ? 'selected' : '' }}>Number of Comments</option>
                    <option value="views" {{ request('sort') == 'views' ? 'selected' : '' }}>Number of Views</option>
                </select>
            </form>
        </div> 
        <div class="row mb-3">
        @forelse($spots as $post)
            <div class="col-lg-4 col-md-6 col-sm">
                @include('home.posts.post-body')
            </div>
        @empty
            <h4 class="h4 text-center text-secondary">No posts yet</h4>
        @endforelse
        </div>
        <div class="d-flex justify-content-end mb-5">
            {{ $spots->links() }}
        </div>
    </div>   
</div>
@endsection
