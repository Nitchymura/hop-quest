@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
    <link rel="stylesheet" href="{{ asset('css/quest/view-quest.css') }}">
@endsection

<main>
    

<div class="row justify-content-center tag-category">
    <div class="col-auto">
        <a href="{{ route('posts.followings') }}" class="text-decoration-none text-dark" data-category="followings">
            <h1 class="poppins-semibold {{ request()->is('home/posts/followings*') ? 'active' : '' }}">
                <i class="fa-solid fa-bookmark"></i> Followings'
            </h1>
        </a>
    </div>

    <div class="col-auto ms-5">
        <a href="{{ route('posts.spots') }}" class="text-decoration-none text-dark" data-category="spot">
            <h1 class="poppins-semibold {{ request()->is('home/posts/spots*') ? 'active' : '' }}">
                <i class="fa-solid fa-location-dot"></i> Spots
            </h1>
        </a>
    </div>
    <div class="col-auto ms-5">
        <a href="{{ route('posts.quests') }}" class="text-decoration-none text-dark" data-category="quest">
            <h1 class="poppins-semibold {{ request()->is('home/posts/quest*') ? 'active' : '' }}">
                <i class="fa-solid fa-plane fa-rotate-by" style="--fa-rotate-angle: -30deg;"></i> Quests
            </h1>
        </a>
    </div>
    <div class="col-auto ms-5">
        <a href="{{ route('posts.locations') }}" class="text-decoration-none text-dark" data-category="location">
            <h1 class="poppins-semibold {{ request()->is('home/posts/locations*') ? 'active' : '' }}">
                <i class="fa-solid fa-map"></i> Locations
            </h1>
        </a>
    </div>
    <div class="col-auto ms-5">
        <a href="{{ route('posts.events') }}" class="text-decoration-none text-dark" data-category="event">
            <h1 class="poppins-semibold {{ request()->is('home/posts/events*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar"></i> Events
            </h1>
        </a>
    </div>
    <div class="col-auto ms-5">
        <a href="{{ route('posts.all') }}" class="text-decoration-none text-dark" data-category="all">
            <h1 class="poppins-semibold {{ request()->is('home/posts/all*') ? 'active' : '' }}">
                <i class="fa-solid fa-globe"></i> All
            </h1>
        </a>
    </div>
</div>
<hr>

</main>

