@if ($user->role_id == 1)
    <div class="bg-navy text-white">
    @else
        <div class="bg-blue text-dark">
@endif

@extends('layouts.app')

@section('title', 'Profile')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/profiles/profile.css') }}"> --}}
@endsection

@section('content')

    <!-- Header image -->
    <div class="row">
        <div class="mb-3 pt-3">
            @if ($user->header)
                <img src="{{ $user->header }}" alt="" class="header-image">
            @else
                <img src="{{ asset('images/logo/header_logo.jpg') }}" alt="header_logo" class="header-image">
            @endif
        </div>
    </div>
    {{-- User information --}}
    {{-- @if ($user->role_id == 1)
        <div class="row justify-content-center mt-2 mb-0">
            <div class="col-2 sidebar ps-5 poppins-bold">
                @include('businessusers.profiles.partial.sidebar')
            </div>
            <div class="col-8 ms-5 ps-5">
            @else
                <div class="row justify-content-center mt-2 mb-0">
                    <div class="col-8">
    @endif --}}
    <div class="row justify-content-center mt-2 mb-0">
        <div class="col-12 col-xl-10 px-3 px-md-4">
            <div class="profile-header position-relative mt-2">
                <div class="row align-items-start g-3">
                    <!-- Avatar image -->
                    <div class="col-12 col-md-auto profile-image mb-3 text-center text-md-start">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="" class="rounded-circle avatar-xxl">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary profile-xxl d-block text-center"></i>
                        @endif
                    </div>
                    {{-- <div class="col-2"></div> --}}
                    <!-- Username -->
                    <div class="col">
                        <div class="row align-items-center g-2">
                            <div class="col-12 col-md-auto">
                                <div class="col p-0">
                                    <div class="d-flex align-items-center gap-2 user-name-badge">
                                        <h3 class="username h5 m my-auto mb-0">{{ $user->name }}</h3>

                                        @if ($user->official_certification == 3)
                                            <img src="{{ asset('images/logo/official_personal.png') }}"
                                                class="official-personal-inline" alt="official-personal">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if ($user->id == Auth::user()->id)
                                <div class="col-12 col-md-auto ms-md-auto">
                                    @if (Auth::user()->official_certification !== 2)
                                        <a href="{{ route('profile.edit', Auth::user()->id) }}"
                                            class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                                    @else
                                        <a href="" class="btn btn-sm btn-navy mb-2 w-100">REVIEWING</a>
                                    @endif
                                </div>
                            @else
                                @if (Auth::user()->user_id == 1)
                                    <div class="col-12 col-md-auto ms-md-auto">
                                        @if ($user->isFollowed())
                                            <form action="{{ route('delete.follow', $user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-following fw-bold mb-2 w-100">Following</button>
                                            </form>
                                        @else
                                            <form action="{{ route('store.follow', $user->id) }}" method="post">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-sm btn-follow fw-bold mb-2 w-100">Follow</button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            @endif
                        </div>
                        @include('businessusers.profiles.modals.delete')

                        {{-- url --}}
                        <div class="profile-meta mt-2">
                            <div class="row mb-3 profile-url">
                                <div class="col">
                                    @if ($user->role_id == 2 && $user->website_url)
                                        <a href="{{ strpos($user->website_url, 'http') === 0 ? $user->website_url : 'https://' . $user->website_url }}"
                                            class="text-decoration-none {{ $user->role_id == 1 ? 'text-white' : 'text-dark' }}">
                                            {{ $user->website_url }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3 profile-social">
                                @include('businessusers.profiles.partials.social_media')
                            </div>

                            <div class="row mb-3 profile-counts">
                                @include('businessusers.profiles.partials.counter_post_follow')
                            </div>

                            <div class="row mb-3 profile-engagement">
                                @include('businessusers.profiles.partials.counter_like_comment')
                            </div>
                        </div>
                    </div>

                    {{-- introduction --}}
                    <div class="row mb-3 mt-3">
                        @if ($user->introduction)
                            <p>{{ $user->introduction }}</p>
                        @endif
                    </div>


                    {{-- === タブ切り替えエリア === --}}

                    @include('businessusers.profiles.partials.tabs')

                    {{-- === コンテンツ表示（Switch） === --}}

                    <div class="row justify-content-center mt-5">
                        @if ($section == 'followers')
                            <!--Follower-->
                            <div class="col-8">
                                <div class="row mb-3 align-items-center ">
                                    <h3 class="text-center mb-3">Followers</h3>
                                    <ul class="list-group">
                                        @forelse($user->followers as $follower)
                                            <div
                                                class="row bg-white p-3 mx-0 mx-md-4 rounded-4 mb-3 align-items-center g-2">
                                                <div class="col-auto">
                                                    {{-- icon/avatar --}}
                                                    {{-- <a href="{{route('profile.show', $follower->follower->id)}}"> --}}
                                                    <a href="{{ route('profile.header', $follower->follower->id) }}">
                                                        @if ($follower->follower->avatar)
                                                            <img src="{{ $follower->follower->avatar }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        @else
                                                            <i
                                                                class="fa-solid fa-circle-user text-secondary profile-sm"></i>
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="col ps-0 text-truncate">
                                                    {{-- name --}}
                                                    {{-- <a href="{{route('profile.show', $follower->follower->id)}}" 
                                                class="text-decoration-none text-dark fw-bold"> --}}
                                                    <a href="{{ route('profile.header', $follower->follower->id) }}"
                                                        class="text-decoration-none text-dark fw-bold">
                                                        {{ $follower->follower->name }}
                                                    </a>
                                                </div>
                                                <div class="col-12 col-md-auto mt-2 mt-md-0">
                                                    {{-- button --}}
                                                    @if ($follower->follower->id != Auth::user()->id)
                                                        @if ($follower->follower->isFollowed())
                                                            <!-- unfollow -->
                                                            <form
                                                                action="{{ route('delete.follow', $follower->follower->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn-following ">Following</button>
                                                            </form>
                                                        @else
                                                            <!-- follow -->
                                                            <form
                                                                action="{{ route('store.follow', $follower->follower->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="btn-follow ">Follow</button>
                                                            </form>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @empty
                                            <h4 class="h4 text-center text-secondary">No followers yet</h4>
                                        @endforelse
                                    </ul>
                                    <div class="d-flex justify-content-end mb-5">
                                        {{ $followers->links() }}
                                    </div>
                                    <!--Following-->
                                @elseif ($section == 'follows')
                                    <div class="col-8">
                                        <div class="row mb-3 align-items-center ">
                                            <h3 class="text-center mb-3">Following</h3>
                                            <ul class="list-group">
                                                @forelse($user->follows as $following)
                                                    <div
                                                        class="row bg-white p-3 mx-0 mx-md-4 rounded-4 mb-3 align-items-center g-2">
                                                        <div class="col-auto">
                                                            {{-- icon/avatar --}}
                                                            <a
                                                                href="{{ route('profile.header', $following->followed->id) }}">
                                                                @if ($following->followed->avatar)
                                                                    <img src="{{ $following->followed->avatar }}"
                                                                        alt="" class="rounded-circle avatar-sm">
                                                                @else
                                                                    <i
                                                                        class="fa-solid fa-circle-user text-secondary profile-sm"></i>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="col ps-0 text-truncate">
                                                            {{-- name --}}
                                                            <a href="{{ route('profile.header', $following->followed->id) }}"
                                                                class="text-decoration-none text-dark fw-bold">
                                                                {{ $following->followed->name }}
                                                            </a>
                                                        </div>
                                                        <div class="col-12 col-md-6 col-xl-4 mb-4">
                                                            {{-- button --}}
                                                            @if ($following->followed->id != Auth::user()->id)
                                                                @if ($following->followed->isFollowed())
                                                                    {{-- unfollow --}}
                                                                    <form
                                                                        action="{{ route('delete.follow', $following->followed->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn-following ">Following</button>
                                                                    </form>
                                                                @else
                                                                    {{-- follow --}}
                                                                    <form
                                                                        action="{{ route('store.follow', $following->followed->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn-follow ">Follow</button>
                                                                    </form>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                @empty
                                                    <h4 class="h4 text-center text-secondary">No following yet</h4>
                                                @endforelse
                                            </ul>
                                            <div class="d-flex justify-content-end mb-5">
                                                {{ $follows->links() }}
                                            </div>
                                            <!--Likes-->
                                        @elseif ($section == 'likes')
                                            <div class="col-12">
                                                <div class="row mb-3 align-items-center ">
                                                    <div class="row justify-content-center">
                                                        <div class="row mb-1 mt-4">
                                                            @forelse($likedPosts as $post)
                                                                <div class="col-12 col-md-6 col-xl-4 mb-4">
                                                                    @include('businessusers.profiles.post-body-profile')
                                                                </div>
                                                            @empty
                                                                <h4 class="h4 text-center text-secondary">No posts yet</h4>
                                                            @endforelse
                                                        </div>
                                                        <div class="d-flex justify-content-end mb-5">
                                                            {{ $likedPosts->links() }}
                                                        </div>
                                                    </div>
                                                    <!--Comment-->
                                                @elseif ($section == 'comments')
                                                    <div class="col-12 col-xl-10">
                                                        <div class="row mb-3 align-items-center ">
                                                            <h3 class="text-center mb-3">Comments</h3>
                                                            <ul class="list-group">
                                                                @forelse($commentedPosts as $comment)
                                                                    <div
                                                                        class="row bg-white p-2 rounded-2 mb-3 d-flex align-items-center profile-post ">
                                                                        <div class="row mb-2">
                                                                            <div class="col-auto my-auto" rowspan="2">
                                                                                @if ($comment['type'] == 'businesses')
                                                                                    <a
                                                                                        href="{{ route('business.show', $comment['business_id']) }}">
                                                                                        <img src="{{ $comment['main_image'] }}"
                                                                                            alt="{{ $comment['title'] }}"
                                                                                            class="img-sm">
                                                                                    </a>
                                                                                @elseif($comment['type'] == 'quests')
                                                                                    <a
                                                                                        href="{{ route('quest.show', $comment['quest_id']) }}">
                                                                                        <img src="{{ $comment['main_image'] }}"
                                                                                            alt="{{ $comment['title'] }}"
                                                                                            class="img-sm">
                                                                                    </a>
                                                                                @elseif($comment['type'] == 'spots')
                                                                                    <a
                                                                                        href="{{ route('spot.show', $comment['spot_id']) }}">
                                                                                        <img src="{{ $comment['main_image'] }}"
                                                                                            alt="{{ $comment['title'] }}"
                                                                                            class="img-sm">
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col">
                                                                                <div class="row">
                                                                                    <div class="col-8 mt-2">
                                                                                        <span
                                                                                            class="fw-light text-dark">To:
                                                                                        </span>
                                                                                        <a href="#"
                                                                                            class="text-decoration-none text-dark fw-bold">
                                                                                            {{ $comment['title'] }}
                                                                                        </a>
                                                                                    </div>
                                                                                </div>

                                                                                <hr class="color-navy">
                                                                                <div class="row text-center">
                                                                                    <div class="col-auto">
                                                                                        @if ($comment['rating'])
                                                                                            @for ($i = 1; $i <= $comment['rating']; $i++)
                                                                                                <i
                                                                                                    class="fa-solid fa-star color-yellow "></i>
                                                                                            @endfor
                                                                                            @for ($i = 1; $i <= 5 - $comment['rating']; $i++)
                                                                                                <i
                                                                                                    class="fa-regular fa-star color-navy"></i>
                                                                                            @endfor
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="col-auto">
                                                                                        <a href="#"
                                                                                            class="text-decoration-none text-dark profile-comment">
                                                                                            {{ $comment['comment'] }}
                                                                                        </a>
                                                                                    </div>
                                                                                    <div>
                                                                                        <div
                                                                                            class="col-auto text-end text-secondary">
                                                                                            {{ date('H:i, M d Y', strtotime($comment['created_at'])) }}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                @empty
                                                                    <h4 class="h4 text-center text-secondary">No
                                                                        comments yet</h4>
                                                                @endforelse
                                                                <div class="d-flex justify-content-end mb-5">
                                                                    {{ $commentedPosts->links() }}
                                                                </div>
                                                            @else
                                                        </div>
                                                    </div>
                                                    @if ($user->role_id == 1)
                                                        @switch($tab)
                                                            @case('quests')
                                                                @include('businessusers.profiles.quests', [
                                                                    'quests' => $quests,
                                                                ])
                                                            @break

                                                            @case('spots')
                                                                @include('businessusers.profiles.spots', [
                                                                    'spots' => $spots,
                                                                ])
                                                            @break

                                                            @case('likedPosts')
                                                                @include(
                                                                    'businessusers.profiles.liked_posts',
                                                                    ['likedPosts' => $likedPosts]
                                                                )
                                                            @break

                                                            @default
                                                                @include('businessusers.profiles.quests', [
                                                                    'quests' => $quests,
                                                                ])
                                                        @endswitch
                                                    @elseif($user->role_id == 2)
                                                        @switch($tab)
                                                            @case('businesses')
                                                                @include(
                                                                    'businessusers.profiles.show_businesses',
                                                                    ['businesses' => $businesses]
                                                                )
                                                            @break

                                                            @case('promotions')
                                                                @include(
                                                                    'businessusers.profiles.show_promotions',
                                                                    ['promotions' => $business_promotions]
                                                                )
                                                            @break

                                                            @case('quests')
                                                                @include('businessusers.profiles.quests', [
                                                                    'quests' => $quests,
                                                                ])
                                                            @break

                                                            @default
                                                                @include(
                                                                    'businessusers.posts.businesses.show_body',
                                                                    ['businesses' => $businesses]
                                                                )
                                                        @endswitch
                                                    @endif
                        @endif
                    </div>
                </div>
            </div>
        @endsection
