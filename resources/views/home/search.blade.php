@extends('layouts.app')

@section('title', 'Search-Result')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/search.css')}}">

@section('js')
    <script src="{{ asset('js/like.js')}}"></script>
    <script src="{{ asset('js/follow.js')}}"></script>

@section('content')


    <div class="wrapper-tag">
        <div class="search-word">
            <h1 class="h1">Search word :  <strong>{{ $request->search }}</strong></h1>
        </div>

        {{-- All Tab --}}
        <div class="row justify-content-center align-items-center tag-category">

            <div class="col-auto">
                <a href="#tab-all" class="text-decoration-none text-dark" data-category="all">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-globe"></i> All
                        {{-- <img src="{{ asset('images/home/オリジナル（透過背景） black.png')}}" class="tab-icon" data-default="{{ asset('images/home/オリジナル（透過背景） black.png') }}" data-active="{{ asset('images/home/オリジナル（透過背景） blue.png') }}" alt=""> All --}}
                    </h1>
                </a>
            </div>

            <div class="col-auto ms-5">
                <a href="#tab-spot" class="text-decoration-none text-dark" data-category="spot">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-location-dot"></i> Spots
                    </h1>
                </a>
            </div>

            <div class="col-auto ms-5">
                <a href="#tab-quest" class="text-decoration-none text-dark" data-category="quest">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-plane fa-rotate-by" style="--fa-rotate-angle: -30deg;"></i> Quests
                    </h1>
                </a>
            </div>

            <div class="col-auto ms-5">
                <a href="#tab-location" class="text-decoration-none text-dark" data-category="location">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-map"></i> Locations
                    </h1>
                </a>
            </div>

            <div class="col-auto ms-5">
                <a href="#tab-event" class="text-decoration-none text-dark" data-category="event">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-calendar"></i> Events
                    </h1>
                </a>
            </div>        
        </div>

        {{-- Underline of All Tab --}}
        <div class="d-flex justify-content-center mt-2">
            <div class="for-line"></div>
        </div>

        {{-- Dropdown menu to change content below the underline --}}
        <div class="row">
            <div class="col-9">
                <input type="hidden" type="text" id="searchInput" name="search" value="{{ $request->search }}">
            </div>
            <div class="col-1 dropdown mt-3 d-flex">
                <select id="dropdown-sort" class="form-select">
                    <option value="latest">Latest</option>
                    <option value="oldest">Oldest</option>
                    <option value="likes">Number of Likes</option>
                    <option value="comments">Number of Comments</option>
                    <option value="views">Number of Views</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Tab content --}}
    <div class="wrapper">
        <div class="container wrapper-body tab-content active" id="tab-all">
            <div class="row" id="post-list-all">
                @include('home.search-result-body-list', ['posts' => $all_posts])
            </div>
        </div>

        <div class="container wrapper-body tab-content" id="tab-spot">
            <div class="row" id="post-list-spot">
                @forelse ($spots as $post)
                    <div class="col-4 mb-5">
                        @include('home.search-result-body')
                    </div>
                @empty
                    <div class="empty d-flex justify-content-center not-found">
                        {{ $request->search }} is not found...
                    </div>
                @endforelse
            </div>
        </div>

        <div class="container wrapper-body tab-content" id="tab-quest">
            <div class="row" id="post-list-quest">
                @forelse ($quests as $post)
                    <div class="col-4 mb-5">
                        @include('home.search-result-body')
                    </div>
                @empty
                    <div class="empty d-flex justify-content-center not-found">
                        {{ $request->search }} is not found...
                    </div>
                @endforelse
            </div>
        </div>

        <div class="container wrapper-body tab-content" id="tab-location">
            <div class="row" id="post-list-location">
                @forelse ($business_locations as $post)
                    <div class="col-4 mb-5">
                        @include('home.search-result-body')
                    </div>
                @empty
                    <div class="empty d-flex justify-content-center not-found">
                        {{ $request->search }} is not found...
                    </div>
                @endforelse
            </div>
        </div>

        <div class="container wrapper-body tab-content" id="tab-event">
            <div class="row" id="post-list-event">
                @forelse ($business_events as $post)
                    <div class="col-4 mb-5">
                        @include('home.search-result-body')
                    </div>
                @empty
                    <div class="empty d-flex justify-content-center not-found">
                        {{ $request->search }} is not found...
                    </div>
                @endforelse
            </div>
        </div>
    </div>



    

@section('js')
    <script src="{{ asset('js/home/search.js')}}"></script>

@endsection