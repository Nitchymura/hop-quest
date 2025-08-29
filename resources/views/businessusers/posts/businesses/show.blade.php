@extends('layouts.app')


<link rel="stylesheet" href="{{ asset('css/viewbusiness.css') }}">

@section('title', 'Business View')

@section('content')
    <div class="page-wrapper mt-5">
        <div class="page-container">

            <!-- Main Image Section -->
            <section class="main-image-section">
                <div class="main-image-wrapper mt-3">
                    <img src="{{  $business->main_image }}" alt="{{ $business->title }}" class="card-img-top body-image" alt="image">
                    {{-- <img class="main-image" alt="Main picture" src="{{ $business->main_image }}" /> --}}


                    <div class="col-auto main-title ">
                        {{ $business->name }}
                    </div>
                    <div class="icon-container position-absolute d-flex align-items-center mt-3 ms-5">
                        <!-- アイコン（ハート） -->
                        <div class="me-2 mt-3">
                            @if($business->isLiked())                            
                                <form action="{{ route('businesses.like.delete', $business->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0">
                                        <i class="fa-solid fa-heart color-red"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('businesses.like.store', $business->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn p-0">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    
                        <!-- カウント -->
                        <div class="icons-in-image">
                                <span>{{ $business->likes->count() }}</span>
                        </div>

                        <div class="icons-in-image ms-5 mt-2 p-0">
                            <div>
                                <i class="fa-regular fa-comment h1"></i>
                            </div>
                        </div>
                        <div class="icons-in-image px-2">
                            <span>{{ $business->comments->count()}}</span>
                        </div>
                        <div class="icons-in-image ms-5 p-0">
                            <div>
                                <i class="fa-solid fa-chart-simple"></i>
                            </div>
                        </div>
                        <div class="icons-in-image px-2">
                                {{-- <span>{{ $business->pageViews->count() }}</span> --}}
                                <span>&nbsp;{{ $business->views->sum('views') ?? 0}}</span>
                        </div>
                    </div>
                    
 
                    <div class="event-dates">
                        {{ $business->term_start }} - {{ $business->term_end }}
                    </div>
                    <div class="post-dates">
                        @if($business->updated_at)
                            <h5 >Updated: {{ $business->updated_at->format('M d Y')}}</h5>
                        @else
                            <h5 >Posted: {{ $business->created_at->format('M d Y')}}</h5>
                        @endif
                    </div>

                    @if($business->official_certification==3)
                        <img src="{{ asset('images/logo/Official_Badge.png') }}" class="official-badge" alt="official">              
                    @else
                    @endif
                </div>
            </section>

            <!-- User Profile Header -->
            <section class="profile-header">
                <div class="profile-container">
                    <div class="profile-left d-flex align-items-center justify-content-between">
                        
                        <!-- 左側（プロフィール画像と名前） -->
                        <div class="profile-main d-flex align-items-center">
                            <div class="col-md-auto col-sm-2 my-auto p-0 profile-pic">                   
                                <button class="btn">
                                    <a href="{{route('profile.header', $business->user->id)}}">
                                    @if($business->user->avatar)
                                        <img src="{{ $business->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary profile-sm d-block text-center"></i>
                                    @endif
                                    </a>
                                </button>
                            </div>
                            <div class="col-auto profile-name ms-2 ">
                                <a href="{{route('profile.header', $business->user->id)}}" class="text-decoration-none d-inline text-dark">
                                    {{$business->user->name}}
                                </a>
                            </div>

                            @if($business->user->official_certification == 3)
                            <div class="col-md-1 col-sm-1 pb-1 p-1">
                                <img src="{{ asset('images/logo/official_personal.png')}}" class="official-personal d-inline ms-0 avatar-xs" alt="official-personal"> 
                            </div>
                            @endif
                        </div>
                         <!-- Followボタン -->
                        @if($business->user->id !== Auth::user()->id)
                            <div class="col-1 mt-3 me-auto">
                                @if($business->user->isFollowed())
                                    {{-- unfollow --}}
                                    <form action="{{route('delete.follow', $business->user->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-following btn-sm w-100">Following</button>
                                    </form>
                                @else
                                    {{-- follow --}}
                                    <form action="{{route('store.follow', $business->user->id )}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-follow btn-sm w-100">Follow</button>
                                    </form>
                                @endif 
                            </div>
                        @endif
                        <!-- 右側（SNSアイコン） -->
                        <div class="sns-icons d-flex align-items-center">
                            @if(!empty($business->user->instagram))
                                <a href="https://instagram.com/{{ $business->user->instagram }}" class="text-decoration-none d-flex align-items-center px-2" target="_blank" rel="noopener">
                                    <i class="fa-brands fa-instagram text-dark icon-md mx-1"></i><span class="text-dark ms-1">{{$business->user->instagram}}</span>
                                </a>
                            @endif
                            @if(!empty($business->user->facebook))
                                <a href="https://facebook.com/{{ $business->user->facebook }}" class="text-decoration-none d-flex align-items-center px-2" target="_blank" rel="noopener">
                                    <i class="fa-brands fa-facebook text-dark icon-md mx-1"></i><span class="text-dark ms-1">{{$business->user->facebook}}</span>
                                </a>
                            @endif
                            @if(!empty($business->user->x))
                                <a href="https://x.com/{{ $business->user->x }}" class="text-decoration-none d-flex align-items-center px-2" target="_blank" rel="noopener">
                                    <i class="fa-brands fa-x-twitter text-dark icon-md mx-1"></i><span class="text-dark ms-1">{{$business->user->x}}</span>
                                </a>
                            @endif
                            @if(!empty($business->user->tiktok))
                                <a href="https://www.tiktok.com/@{{ $business->user->tiktok }}" class="text-decoration-none d-flex align-items-center px-2" target="_blank" rel="noopener">
                                    <i class="fa-brands fa-tiktok text-dark icon-md mx-1"></i><span class="text-dark ms-1">{{$business->user->tiktok}}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
            

            <!-- Photo Section -->
            <section class="business-promotion">
            <div class="promotion-container">
                @if(count($business_photos) > 0)
                    <div class="promotion-carousel">
                        <div class="carousel-controls">
                            <button class="carousel-arrow prev" role="button" aria-label="Previous slide">&larr;</button>
                            <button class="carousel-arrow next" role="button" aria-label="Next slide">&rarr;</button>
                        </div>

                        <div class="carousel-items-container">
                            @foreach($business_photos as $index => $post)
                                <div class="promotion-item {{ $index < 5 ? 'active' : '' }}">
                                    <div class="col">
                                        @if($post->image)
                                        <img src="{{ $post->image }}" alt="Business Photo" class="img-photo mb-2 mx-auto">
                                        @else
                                        No photos yet
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="carousel-indicators">
                            @php
                                $totalSlides = ceil(count($business_photos) / 3);
                            @endphp
                            @for($i = 0; $i < $totalSlides; $i++)
                                <div class="carousel-indicator {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></div>
                            @endfor
                        </div>
                    </div>
                @else
                    <div class="text-center">No photos yet</div>
                @endif
            </div>
        </section>

            <!-- Business Promotion -->
            <section class="business-promotion">
                <h3>Business Promotion</h3>
                <div class="promotion-container">
                    @if(count($business_promotions) > 0)
                        <div class="promotion-carousel">
                            <div class="carousel-controls">
                                <button class="carousel-arrow prev" role="button" aria-label="Previous slide">&larr;</button>
                                <button class="carousel-arrow next" role="button" aria-label="Next slide">&rarr;</button>
                            </div>

                            <div class="carousel-items-container">
                                @foreach($business_promotions as $index => $post)
                                    <div class="promotion-item {{ $index < 5 ? 'active' : '' }}">
                                        <div class="col">
                                            @include('businessusers.posts.businesses.partials.promotion_body')
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="carousel-indicators">
                                @php
                                    $totalSlides = ceil(count($business_promotions) / 3);
                                @endphp
                                @for($i = 0; $i < $totalSlides; $i++)
                                    <div class="carousel-indicator {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></div>
                                @endfor
                            </div>
                        </div>
                    @else
                        <div class="text-center">No promotions yet</div>
                    @endif
                </div>
            </section> 

            <!-- Business Introduction -->
            <section class="business-introduction">
                <h3>Introduction</h3>
                <div class="introduction-box">                   
                    <p>{{ $business->introduction }}</p>
                </div>
            </section>


            <!-- Business Location -->
            <section class="business-location">
                <h3>Location</h3>
                <div class="location-wrapper">
                    <div class="location-details">
                        <div class="info-row">
                            <div class="info-label">
                                Service Category :
                            </div>
                            <div class="info-value">
                                {{ $business->service_category }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                Status :
                            </div>
                            <div class="info-value">
                                {{ $business->status }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                Identification No. :
                            </div>
                            <div class="info-value">
                                {{ $business->identification_number }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                Phone Number :
                            </div>
                            <div class="info-value">
                                {{ $business->phonenumber }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                Address - in local language :
                            </div>
                            <div class="info-value">
                                {{ $business->address_1 }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                Address - in English :
                            </div>
                            <div class="info-value">
                                {{ $business->address_2 }}
                            </div>
                        </div>
                    </div>
                    <div class="location-map">
                        <img alt="Google map view" src="{{ asset('public/google-map-view.svg') }}" />
                    </div>
                </div>
            </section>

            <!-- Website and Social Media -->
            <div class="web-social">
                <div class="web-social-content">
                    <h5 class="official-site">
                        Official Web site : 
                        @if(!empty($business->website_url))
                            {{ $business->website_url }}
                        @else
                            -----
                        @endif    
                    </h5>
                    
                    <div class="row justify-align-center">
                        <div class="col-auto">
                            <h5 class="d-flex">Social Media : </h5></div>
                        <div class="col-auto">
                            @if($business->instagram)
                                <a href="#" class="text-decoration-none">
                                <i class="fa-brands fa-instagram text-dark icon-md px-2"></i><span class="text-decoration-none text-dark my-auto">{{$business->instagram}}</span>
                                </a>
                            @endif
                        </div>
                        <div class="col-auto">
                            @if($business->facebook)
                                <a href="#" class="text-decoration-none">
                                <i class="fa-brands fa-facebook text-dark icon-md px-2"></i><span class="text-decoration-none text-dark my-auto">{{$business->facebook}}</span>
                                </a>
                            @endif
                        </div>
                        <div class="col-auto">
                            @if($business->x)
                                <a href="#" class="text-decoration-none">
                                <i class="fa-brands fa-x-twitter text-dark icon-md px-4"></i>
                                </a>
                            @endif
                        </div>
                        <div class="col-auto">
                            @if($business->tiktok)
                                <a href="#" class="text-decoration-none">
                                <i class="fa-brands fa-tiktok text-dark icon-md px-4"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Hours -->
            <section class="business-hours">
                <h3>Business Hours</h3>
                <div class="hours-table-wrapper">
                    <table class="hours-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Operating Hours</th>
                                <th>Break time</th>
                                <th>Notice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($business_hour as $hour)
                                <tr>
                                    @if($hour->is_closed == 0)
                                        <td>{{ $hour['day_of_week'] }} :</td>
                                        <td>
                                            @if(!empty($hour['opening_time']))
                                            {{date('H:i', strtotime($hour['opening_time'])) }} - {{ date('H:i', strtotime($hour['closing_time']))  }}
                                            @else
                                            ー
                                            @endif
                                        </td>

                                        <td>{{ isset($hour['break_start']) ? $hour['break_start'] . ' - ' . $hour['break_end'] : 'ー' }}</td>
                                        <td>{{ $hour['notice'] ?? 'ー' }}</td>
                                    @else
                                        <td>{{ $hour['day_of_week'] }} :</td>
                                        <td>Closed</td>
                                        <td>ー</td>
                                        <td>ー</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Details -->
            <section class="details-section">
                <h2 class="details-title">
                    Details
                </h2>

                <div class="details-container">
                    @foreach($business_info_category as $index => $category)
                        <div class="amenity-group">
                            <div class="amenity-group-title">
                                {{ $category->name }} :
                            </div>
                            <div class="amenity-items-container">
                                <div class="amenity-grid">
                                    @foreach($category->businessInfos as $info)
                                        @php
                                            $isValid = false;
                                            if ($info->businessDetails->isNotEmpty()) {
                                                $isValid = $info->businessDetails->first()->is_valid;
                                            }
                                        @endphp
                                        <div class="amenity-item me-auto">
                                            @if ($isValid)
                                                <i class="fa-solid fa-circle-check color-green ms-2"></i>  {{-- ①チェックあり（緑） --}}
                                            @else
                                                <i class="fa-solid fa-circle-xmark color-red ms-2"></i>    {{-- ②チェックなし（赤） --}}
                                            @endif                                            
                                            <label for="{{ $info->id }}" class="amenity-label ms-2 ">
                                                {{ $info->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if($index < count($business_info_category) - 1)
                            <hr class="amenity-divider" />
                        @endif
                    @endforeach
                </div>
            </section>

            <!-- Comments Section -->
            <hr>
            @include('businessusers.posts.businesses.partials.comment_body')
            <div class="d-flex justify-content-center mt-3">
                {{-- {{ $business_comments->links() }} --}}
            </div>

            <!-- Go to Top Button -->
            <div class="top-button-container">
                <button class="top-button">
                    <a href="#" class="text-decoration-none color-navy">
                        <i class="fa-solid fa-plane-up fs-3"></i>
                        <p class="color-navy m-0 p-0 text-center fs-8 poppins-semibold">Go TOP</p>
                    </a>
                </button>
            </div>
        </div>
    </div>


    {{-- public/map.js --}}
    <script src="{{ asset('map.js') }}"></script>

    {{-- Google Maps API (callback=initMap) --}}
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap">
    </script>

    {{--promotion carousel --}}
    <script src="{{ asset('js/viewbusiness.js') }}"></script>

@endsection