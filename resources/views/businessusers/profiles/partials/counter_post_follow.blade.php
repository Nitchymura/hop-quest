{{-- items --}}
    <!--Post-->
    <div class="col-auto">
        @if($user->role_id == 1)                          
            @if($user->id == Auth::user()->id)
                <a href="{{ route('profile.header', $user->id) }}" class="text-decoration-none text-white"><span class="fw-bold">{{$user->quests->count()+$user->spots->count()}}</span> {{$user->quests->count()+$user->spots->count()==1 ? 'post' : 'posts'}}</a>
            @elseif($user->id != Auth::user()->id)
                <a href="{{ route('profile.header', $user->id) }}" class="text-decoration-none text-white"><span class="fw-bold">{{$user->questsVisible->count()+$user->spotsVisible->count()}}</span> {{$user->questsVisible->count()+$user->spotsVisible->count()==1 ? 'post' : 'posts'}}</a>
            @endif
        @else
            @if($user->id == Auth::user()->id)
                <a href="{{ route('profile.header', $user->id) }}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->businessPromotions->count()+$user->businesses->count()+$user->quests->count()}}</span> {{$user->businessPromotions->count()+$user->businesses->count()+$user->quests->count()==1 ? 'post' : 'posts'}}</a>
            @elseif($user->id != Auth::user()->id)
                <a href="{{ route('profile.header', $user->id) }}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->businessPromotionsVisible->count()+$user->businessesVisible->count()+$user->questsVisible->count()}}</span> {{$user->businessPromotionsVisible->count()+$user->businessesVisible->count()+$user->questsVisible->count()==1 ? 'post' : 'posts'}}</a>
            @endif
        @endif
    </div>
    <!--Follower-->
    @if($user->role_id == 1)  
        <div class="col-auto">
            <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'followers']) }}" class="text-decoration-none text-white"><span class="fw-bold">{{$user->followers->count()}}</span> {{$user->followers->count()==1 ? 'follower' : 'followers'}}</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'follows']) }}" class="text-decoration-none text-white"><span class="fw-bold">{{$user->follows->count()}}</span> following</a>
        </div>
    @else  
        <div class="col-auto">
            <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'followers']) }}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->followers->count()}}</span> {{$user->followers->count()==1 ? 'follower' : 'followers'}}</a>
        </div>
        {{-- <div class="col-auto">
            <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'follows']) }}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->follows->count()}}</span> following</a>
        </div> --}}
    @endif
    @if($user->id == Auth::user()->id && $user->role_id == 2)
        <div class="col-auto">
            @if($user->id == Auth::user()->id)                             
                <a href="{{ route('business.reviews.all', $user->id)}}" class="text-decoration-none text-dark"><span class="fw-bold">{{$business_comments->count()}}</span> {{$business_comments->count()==1 ? 'review' : 'reviews'}}</a>
            @endif
        </div>
    @endif
