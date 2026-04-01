<!-- User Profile Header -->
<section class="profile-header">
    <div class="profile-container">
        <div class="profile-left">

            <div class="profile-main">
                <div class="profile-user">
                    <div class="profile-pic">
                        <a href="{{ route('profile.header', $quest_a->user->id) }}">
                            @if ($quest_a->user->avatar)
                                <img src="{{ $quest_a->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary profile-sm d-block text-center"></i>
                            @endif
                        </a>
                    </div>

                    <div class="profile-name-badge">
                        <div class="profile-name">{{ $quest_a->user->name }}</div>

                        @if ($quest_a->user->official_certification == 3)
                            <img src="{{ asset('images/logo/official_personal.png') }}"
                                class="official-personal-inline" alt="official-personal">
                        @endif
                    </div>
                </div>

                @if ($quest_a->user->id !== Auth::user()->id && Auth::user()->role_id == 1)
                    <div class="follow-area">
                        @if ($quest_a->user->isFollowed())
                            <form action="{{ route('delete.follow', $quest_a->user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-following btn-sm w-100">Following</button>
                            </form>
                        @else
                            <form action="{{ route('store.follow', $quest_a->user->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-follow btn-sm w-100">Follow</button>
                            </form>
                        @endif
                    </div>
                @endif

                <div class="sns-icons">
                    @if (!empty($quest_a->user->instagram))
                        <a href="https://instagram.com/{{ $quest_a->user->instagram }}"
                            class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-instagram text-dark icon-md"></i>
                        </a>
                    @endif

                    @if (!empty($quest_a->user->facebook))
                        <a href="https://facebook.com/{{ $quest_a->user->facebook }}"
                            class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-facebook text-dark icon-md"></i>
                        </a>
                    @endif

                    @if (!empty($quest_a->user->x))
                        <a href="https://x.com/{{ $quest_a->user->x }}"
                            class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-x-twitter text-dark icon-md"></i>
                        </a>
                    @endif

                    @if (!empty($quest_a->user->tiktok))
                        <a href="https://www.tiktok.com/@{{ $quest_a->user->tiktok }}"
                            class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-tiktok text-dark icon-md"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>