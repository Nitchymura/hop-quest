@extends('layouts.app')

@section('title', 'Home')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css')}}">
    <link rel="stylesheet" href="{{ asset('css/home-cards.css')}}">
@endsection

@section('js')
    <script src="{{ asset('js/like.js')}}"></script>
    <script src="{{ asset('js/follow.js')}}"></script>
@endsection

@section('content')
    {{-- @guest --}}
    {{-- Header video --}}
    <div class="wrapper-header position-relative overflow-hidden d-flex align-items-center justify-content-center">
        <video autoplay muted loop playsinline class="header_video">
            <source src="{{ asset('videos/header-video-1.mp4') }}" type="video/mp4">
        </video>
    
        {{-- Header video's title --}}
        <div class="title">
            @guest
                <h1 class="text-light z-1 title-text poppins-bold">Hello, Guest user !</h1>
            @else
                <h1 class="text-light z-1 title-text poppins-bold">Hello, <span>{{Auth::user()->name}}</span>!</h1>
            @endguest
            <h1 class="text-light z-1 title-text poppins-bold">Welcome to HopQuest</h1>
            <br>
            <h2 class="text-light z-1 title-text poppins-semibold">Plan Your Next Adventure</h2>
            <h2 class="text-light z-1 title-text poppins-semibold">Share Spots and Quests with the World</h2>
        </div>

        <div class="btn-arrow d-flex align-items-center">
            <a href="#wrapper-body-second" class="text-decoration-none btn-arrow-link">
                <h3 class="text-light z-1 poppins-semibold">
                    <span class="take-to-body">View Popular Contents ></span>
                    {{-- <img src="{{ asset('images/icons8-矢印-100.png')}}" alt=""> --}}
                </h3>
                {{-- <h3 class="text-light z-1 poppins-semibold take-to-body">
                    View Popular Contents <img src="{{ asset('images/icons8-矢印-100.png')}}" alt="">
                </h3> --}}
            </a>
        </div>
    </div>
  
    {{-- @else --}}
    {{-- Body for Popular Contents --}}
    <div class="wrapper-body-second" id="wrapper-body-second">
        <div class="container-fluid second-body"></div> {{-- For Background --}}

        {{-- Popular Contents --}}
        <div class="col tag-title">
            <h1 class="poppins-bold">Popular Contents</h1>
        </div>

        {{-- Button for sorting cards --}}
        <div class="row justify-content-center tag-category">
            @if (Auth::guest() || (Auth::check()))
                <div class="col-auto">
                    <a href="#tab-fol" class="tab-button text-decoration-none text-dark" data-category="#tab-fol">
                        <h1 class="poppins-semibold">
                            <i class="fa-solid fa-bookmark"></i> Followings'
                        </h1>
                    </a>
                </div>
            @endif

            <div class="col-auto ms-5">
                <a href="#tab-spot" class="tab-button text-decoration-none text-dark" data-category="#tab-spot">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-location-dot"></i> Spot
                    </h1>
                </a>
            </div>

            <div class="col-auto ms-5">
                <a href="#tab-quest" class="tab-button text-decoration-none text-dark" data-category="#tab-quest">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-plane fa-rotate-by" style="--fa-rotate-angle: -30deg;"></i> Quest
                    </h1>
                </a>
            </div>

            <div class="col-auto ms-5">
                <a href="#tab-location" class="tab-button text-decoration-none text-dark" data-category="#tab-location">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-map"></i> Location
                    </h1>
                </a>
            </div>

            <div class="col-auto ms-5">
                <a href="#tab-event" class="tab-button text-decoration-none text-dark" data-category="#tab-event">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-calendar"></i> Event
                    </h1>
                </a>
            </div>        
        </div>

        <div class="view-all">
            <div class="col-auto all-posts">
                <a href="{{ route('posts.all') }}" class="text-decoration-none text-dark">
                    <h1 class="poppins-semibold">
                        <i class="fa-solid fa-globe"></i> All
                    </h1>
                </a>
            </div>            
            {{-- <div class="line-2"></div> --}}
        </div>

        
        {{-- Under-line below categories --}}
        <div class="for-line">
            <div class="line"></div>
        </div>



        {{-- Slider Carousel --}}
        <div class="sliderdiv">
                            
                {{-- Tab content --}}
                <div class="container-fluid wrapper-body tab-content" id="tab-fol">
                    <div class="row" id="post-list-follow">
                        <div class="slider mt-5 {{ Auth::guest() ? 'no-dots' : '' }}">
                            @if (Auth::check())
                                @forelse($popular_follwings as $post)
                                    {{-- @if ($post->user && $post->user->isFollowed())
                                        <div class="slide">
                                            @include('home.home-body')         
                                        </div>                               
                                    @endif --}}
                                    @if ($post->user)
                                        <div class="slide">
                                            @include('home.home-body')         
                                        </div>
                                    @endif
                                @empty   
                                    @if(Auth::user()->role_id == 1)
                                        <div class="empty d-flex justify-content-center not-found">
                                            No posts yet
                                        </div>
                                    @else
                                        <div class="empty d-flex justify-content-center not-found text-center">
                                            No following function for business users<br>
                                            Please select other tabs
                                        </div>
                                    @endif
                                @endforelse
                            @else
                            <div class="empty d-flex flex-column justify-content-center align-items-center not-found p-4">
                                <img src="{{ asset('images/home/login-required.png') }}" alt="Login required" class="mb-3">
                                <h5 class="text-secondary mb-3">You need to log in to see posts from users you follow.</h5>
                                <div>
                                    <a href="{{ route('login') }}" class="btn btn-primary me-2">Log In</a>
                                    <a href="{{ route('register') }}" class="btn btn-outline-secondary">Sign Up</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="container-fluid wrapper-body tab-content" id="tab-spot">
                    <div class="row" id="post-list-spot">
                        <div class="slider mt-5">
                            @forelse ($popular_spots as $post)
                                <div class="slide">
                                    @include('home.home-body')
                                </div>
                            @empty
                                <div class="empty d-flex justify-content-center not-found">
                                    is not found...
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="container-fluid wrapper-body tab-content" id="tab-quest">
                    <div class="row" id="post-list-quest">
                        <div class="slider mt-5">
                            @forelse ($popular_quests as $post)
                                <div class="slide">
                                    @include('home.home-body')
                                </div>
                            @empty
                                <div class="empty d-flex justify-content-center not-found">
                                    is not found...
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="container-fluid wrapper-body tab-content" id="tab-location">
                    <div class="row" id="post-list-location">
                        <div class="slider mt-5">
                            @forelse ($popular_locations as $post)
                                <div class="slide">
                                    @include('home.home-body')
                                </div>
                            @empty
                                <div class="empty d-flex justify-content-center not-found">
                                    is not found...
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="container-fluid wrapper-body tab-content" id="tab-event">
                    <div class="row" id="post-list-event">
                        <div class="slider mt-5">
                            @forelse ($popular_events as $post)
                                <div class="slide">
                                    @include('home.home-body')
                                </div>
                            @empty
                                <div class="empty d-flex justify-content-center not-found">
                                    is not found...
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function(){
                
                function animationOthers(){
                    document.querySelector('.tag-title')?.classList.add('active');
                    document.querySelector('.tag-category')?.classList.add('active');
                    document.querySelector('.slider')?.classList.add('active');
                    document.querySelector('.all-posts')?.classList.add('active');
                    document.querySelector('.all-posts-img')?.classList.add('active');

                    // const line2 = document.querySelector('.line-2');
                    // if(line2){
                    //     setTimeout(() => {
                    //         line2.classList.add('active');
                    //     }, 100);
                    // }
                }
            
                const target = document.querySelector('.line');

                const observer = new IntersectionObserver(entries => {
                    entries.forEach(entry => {
                        if(entry.isIntersecting){
                            entry.target.classList.add('active');

                            entry.target.addEventListener('transitionend', () => {
                                animationOthers();

                                const initialSlider = document.querySelector(`#${defaultTab} .slider`);
                                if (initialSlider) {
                                    initialSlider.classList.add('active'); 
                                    initSlick(initialSlider);
                                }
                                
                            }, { once:true });

                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 1
                });

                if(target){
                    observer.observe(target);
                }
                // targets.forEach(target => {
                //     observer.observe(target);
                // });
            });
        </script>
    </div>

    
    
    {{-- Body for Description about HopQuest --}}
    <div class="wrapper-body-first position-relative">
        <div class="container-fluid">
            <div class="row body">

                {{-- HopQuest Logo --}}
                <div class="col-5 sharing-img">
                    {{-- <img src="{{ asset('images/home/オリジナル（透過背景） (1) 1.png')}}" alt="HopQuest-logo" class="hop-quest"> --}}
                </div>

                        {{-- For sharing-img's animation --}}
                        <script>
                            document.addEventListener('DOMContentLoaded', function(){
                                const target = document.querySelector('.sharing-img');

                                const observer = new IntersectionObserver(entries => {
                                    entries.forEach(entry => {
                                        if (entry.isIntersecting){
                                            entry.target.classList.add('active');
                                            observer.unobserve(entry.target);
                                        }
                                    });
                                },{
                                    threshold: 0.5
                                });

                                if(target){
                                    observer.observe(target);
                                }
                            });
                        </script>

                {{-- HopQuest description --}}
                <div class="col-5 position-relative what-hop">

                    {{-- for setting hopquest logo as background --}}
                    <div class="hopquest-logo"></div>

                    <div class="description-title d-flex ms-3"> {{-- add an animation to this text and it --}}
                        <p>A</p>
                        <P>B</P>
                        <P>O</P>
                        <P>U</P>
                        <P>T</P>
                        <P>&nbsp;</P>
                        <P>H</P>
                        <P>o</P>
                        <P>p</P>
                        <P>Q</P>
                        <P>u</P>
                        <P>e</P>
                        <P>s</P>
                        <P>t</P>
                    </div>

                            {{-- For description's animation --}}
                            <script>
                                document.addEventListener('DOMContentLoaded', function(){
                                    const target = document.querySelector('.description-title');

                                    const observer = new IntersectionObserver(entries => {
                                        entries.forEach(entry => {
                                            if (entry.isIntersecting){
                                                entry.target.classList.add('active');
                                                observer.unobserve(entry.target);
                                            }
                                        });
                                    }, {
                                        threshold: 0.5 // if users saw 50% of description, this program will implement execute
                                    });

                                    if (target){
                                        observer.observe(target);
                                    }
                                });
                            </script>

                    <div class="mt-3 description-text">
                        <p class="raleway-semibold">With HopQuest, you can share your own Quests and Spots with friends and even with people you’ve never met.</p>
                        <p class="raleway-semibold">A Quest is like a travel itinerary—it can be created after your trip as a travel log, or in advance as a travel plan!</p>
                        <p class="raleway-semibold">Each Quest is linked to various Spots, making it easy to see exactly where you explored on Google Maps. You can also register detailed Spot information, even for places that aren't saved on Google Maps.</p>
                        <br>
                        <p class="raleway-semibold">Ready to share your adventures with friends?</p>
                        <p class="raleway-semibold">Try it out on HopQuest!</p>
                    </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function(){
                                    const target = document.querySelector('.description-text');

                                    const observer = new IntersectionObserver(entries => {
                                        entries.forEach(entry => {
                                            if(entry.isIntersecting){
                                                entry.target.classList.add('active');
                                                observer.unobserve(entry.target);
                                            }
                                        });
                                    }, {
                                        threshold: 0.3
                                    });

                                    if(target){
                                        observer.observe(target);
                                    }
                                });
                            </script>
                </div>
            </div>
        </div>

        {{-- Body for FAQ --}}
        <div class="container faq-body d-flex justify-content-center align-items-center">
            <div class="faq-title col-6 text-center justify-content-center align-items-center">
                <h1 class="h1 poppins-bold">F A Q</h1>
                {{-- <h6 class="poppins-regular">Frequently asked questions</h6> --}}
            </div>
        </div>

        <div class="row justify-content-center gap-5">
            <div class="col-2 first-question pt-5">
                <div class="for-question d-flex gap-3">
                    <div class="for-mark ms-2">
                        <img src="{{ asset('images/home/はてなマークのアイコン素材 5.png')}}" alt="">
                    </div>
                    <p class="raleway-semibold">I can't register a Quest or Spot.</p>
                </div>
                <div class="p-4">
                    <p class="raleway-semibold"> You may not be logged in as a Tourist user. Only registered users can create Quests and Spots.</p>
                </div>
            </div>

            <div class="col-2 first-question pt-4">
                <div class="for-question-sec d-flex gap-3 mt-1">
                    <div class="for-mark-sec ms-2">
                        <img src="{{ asset('images/home/はてなマークのアイコン素材 5.png')}}" alt="">
                    </div>
                    <p class="raleway-semibold">How can I register as a Business user?</p>
                </div>
                <div class="for-answer p-4">
                    <p class="raleway-semibold"> Please Go to the "For Business" section in the header and fill in your and your company’s details on the form</p>
                </div>
            </div>

            <div class="col-2 first-question pt-4">
                <div class="for-question-sec d-flex gap-3 mt-1">
                    <div class="for-mark-sec ms-2">
                        <img src="{{ asset('images/home/はてなマークのアイコン素材 5.png')}}" alt="">
                    </div>
                    <p class="raleway-semibold">Is there a fee to register as a Business user?</p>
                </div>
                <div class="for-answer p-4">
                    <p class="raleway-semibold"> No, HopQuest is free to use — even if you promote your business through the platform.</p>
                </div>
            </div>            
        </div>
    {{-- @endguest --}}

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-2 faq-jump col-6 text-center justify-content-center align-items-center mt-5">
                    <a href="{{ route('faq')}}" class="text-decoration-none">
                        <button class="btn-faq slide">
                            Read Full FAQ
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@vite(['resources/js/home/home.js'])
