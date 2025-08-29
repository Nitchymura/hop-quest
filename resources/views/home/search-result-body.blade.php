@section('css')
    <link rel="stylesheet" href="{{ asset('css/search-body.css')}}">
@endsection

{{-- @extends('layouts.app') --}}
    <div class="card p-3">

                {{-- what model is the post in? --}}
                @php
                    $class = class_basename(get_class($post));
                @endphp

        {{-- Card Image with official mark --}}
        @if ($class === 'Business' && $post->official_certification === 3)
            <img src="{{ asset('images/home/Official Badge.png') }}" class="official" alt="official">
        @endif


        {{-- Image & Routing to each show page --}}
        @if($class === 'Quest')
            <a href="{{ route('quest.show', $post->id )}}" class="">

        @elseif($class === 'Spot')
            <a href="{{ route('spot.show', $post->id )}}" class="">

        @elseif($class === 'Business' && $post->category_id === 1)
            <a href="{{ route('business.show', $post->id )}}" class="">

        @elseif($class === 'Business' && $post->category_id === 2)
            <a href="{{ route('business.show', $post->id )}}" class="">

        @endif

                @if ($post->main_image)
                    <img src="{{ $post->main_image }}" class="card-img-top body-image" alt="image">
                @else
                    <img src="{{ asset('storage/app/public/images/home/noImage.jpg')}}" class="card-img-top body-image" alt="image">
                @endif
            </a>
        
        {{-- Card Body --}}
        <div class="row align-items-center card-body ps-1">  
            <div class="row justify-content-between ms-1">
                {{-- Category --}}
                <div class="col-auto p-0">
                    <h5 class="card-subtitle">Category: 
                        <strong>
                            @if ($class == 'Quest')
                                Quest
                            @elseif ($class == 'Spot')
                                Spot
                            @elseif ($class == 'Businesses' || $post->category_id == '1')
                                Location
                            @elseif ($class == 'Businesses' || $post->category_id == '2')
                                Event
                            @endif
                        </strong>
                    </h5>
                </div>
                
                {{-- Postdate --}}
                <div class="col-auto pe-0">
                    <h5 class="card-subtitle">{{ date('Y/m/d', strtotime($post->created_at)) }}</h5>
                </div>
            </div>                

            
            {{-- Title --}}
            <div class="mt-2">
                @if($class === 'Quest')
                    <a href="{{ route('quest.show', $post->id )}}" class="text-decoration-none">

                @elseif($class === 'Spot')
                    <a href="{{ route('spot.show', $post->id )}}" class="text-decoration-none">

                @elseif($class === 'Business' && $post->category_id === 1)
                    <a href="{{ route('business.show', $post->id )}}" class="text-decoration-none">

                @elseif($class === 'Business' && $post->category_id === 2)
                    <a href="{{ route('business.show', $post->id )}}" class="text-decoration-none">

                @endif
                        <h4 class="card-title text-dark"><strong>{{ $post->title ?? $post->name }}</strong></h4>
                    </a>
            </div>

            {{-- Icon & Name & Official mark --}}
            <div class="d-flex flex-wrap align-items-center personal_space">

                {{-- User Icon --}}
                <div class="col-auto ms-1">
                    @php
                        $avatar     = $post->user->avatar;
                        $check      = $avatar && (Str::startsWith($avatar, 'http') || Str::startsWith($avatar, 'data:'));
                        $avatarPath = $check ? $avatar : ($avatar ? asset('storage/'. $avatar) : asset('images/home/free-user.png'));
                    @endphp
                    
                    @auth
                        @if ($post->user->id === Auth::user()->id)
                            <a href="{{ route('profile.header', $post->user->id )}}" class="text-decoration-none h5 d-flex align-items-center">
                                <img src="{{ $avatarPath }}" class="card-icon" alt="card-icon">
                            </a>
                        @else
                            <a href="{{ route('profile.header', $post->user->id )}}" class="text-decoration-none h5 d-flex align-items-center">
                                <img src="{{ $avatarPath }}" class="card-icon" alt="card-icon">
                            </a>
                        @endif
                    @endauth

                    @guest
                        <a href="{{ route('profile.header', $post->user->id )}}" class="text-decoration-none h5 d-flex align-items-center">
                            <img src="{{ $avatarPath }}" class="card-icon" alt="card-icon">
                        </a>
                    @endguest

                </div>

                {{-- User Name --}}
                <div class="col-auto ms-1 pt-2">
                    @auth
                        {{-- @if ($post->user->id === Auth::user()->id && Auth::user()->role_id === 1) --}}
                            <a href="{{ route('profile.header', $post->user->id )}}" class="text-decoration-none h5 d-flex align-items-center">
                                <h1 class="username h5"><strong>{{ $post->user->name }}</strong></h1>
                            </a>
                        {{-- @elseif ($post->user->role_id === 2)
                            <a href="{{ route('profile.header', $post->user->id )}}" class="text-decoration-none h5 d-flex align-items-center">
                                <h1 class="username h5"><strong>{{ $post->user->name }}</strong></h1>
                            </a>
                            @elseif ($post->user->id !== Auth::user()->id && Auth::user()->role_id === 1)
                            <a href="{{ route('profile.header', $post->user->id )}}" class="text-decoration-none h5 d-flex align-items-center">
                                <h1 class="username h5"><strong>{{ $post->user->name }}</strong></h1>
                            </a>
                        @endif --}}
                    @endauth

                    @guest
                        @if ($post->user->role_id === 1)
                            <a href="{{ route('profile.header', $post->user->id )}}" class="text-decoration-none h5 d-flex align-items-center">
                                <h1 class="username h5"><strong>{{ $post->user->name }}</strong></h1>
                            </a>
                        @elseif ($post->user->role_id === 2)
                            <a href="{{ route('profile.header', $post->user->id )}}" class="text-decoration-none h5 d-flex align-items-center">
                                <h1 class="username h5"><strong>{{ $post->user->name }}</strong></h1>
                            </a>
                        @endif
                    @endguest
                </div>

                {{-- Javascript for character limit --}}
                <script>
                    document.querySelectorAll('.username').forEach(elem => {
                        const text = elem.textContent;

                        if (text.length > 10){
                        elem.textContent = text.substring(0, 10) + "...";
                        }
                    });
                </script>



                {{-- User official mark --}}
                <div class="col-auto pb-2">
                    @if ($post->user->official_certification === 3)
                        <img src="{{ asset('images/home/名称未設定のデザイン (8) 1.png')}}" class="official-personal ms-2" alt="official-personal">
                    @endif
                </div>

                {{-- Follow Button --}}
                @if($post['user_id'] != Auth::user()->id && Auth::user()->role_id == 1)
                <div class="col-auto pb-2 ms-auto">                        
                    <button type="button"
                        class="btn follow-button {{ $post->user->isFollowed() ? 'btn-following' : 'btn-follow' }}"
                        data-id="{{ $post->user->id }}"
                        data-followed="{{ $post->user->isFollowed() ? '1' : '0' }}">
                        {{ $post->user->isFollowed() ? 'Following' : 'Follow' }}
                    </button>
                </div>
                @endif
            </div>
            
            {{-- Heart icon & Like function --}}
            <div class="d-flex align-items-center hcv-icon">
                <div class="col-auto d-flex">
                    <button type="button"
                        class="btn btn-sm shadow-none like-button"
                        data-id = "{{ $post->id }}"
                        data-type = "{{ $class }}"
                        data-liked = "{{ $post->isLiked() ? '1' : '0' }}">
                        <i class="{{ $post->isLiked() ? 'fa-solid fa-heart text-danger' : 'fa-regular fa-heart' }}"></i>
                    </button>
                    
                    <button class="btn btn-sm p-0 text-center like-count" data-id="{{ $post->id }}">
                        <span>{{ $post->likes_count ?? $post->likes->count() }}</span>
                    </button>
                </div>
                {{-- Modal for displaying all users who liked owner of post--}}
                                        

                
                {{-- Comment icon & Number of comments --}}
                <div class="col-auto d-flex ms-3 comment">
                    <div>
                        <i class="fa-regular fa-comment h4"></i>
                    </div>

                    <button class="btn btn-sm p-0 text-center no-click">
                        <span>&nbsp;&nbsp;{{ $post->comments->count() }}</span>
                    </button>
                </div>

                {{-- Number of views --}}
                <div class="col-auto d-flex ms-3">
                    <div class="chart-img">
                        <img src="{{ asset('images/chart.png')}}" alt="">
                    </div>

                    <button class="btn btn-sm p-0 text-center no-click">
                        <span>&nbsp;&nbsp;{{ $post->views->sum('views') ?? 0 }}</span>
                    </button>
                </div>
            </div>

            {{-- Description of posts --}}
            <div>
                <p class="card_description">
                    {{ $post->introduction }}
                </p>
            </div>
        </div>        
    </div>

