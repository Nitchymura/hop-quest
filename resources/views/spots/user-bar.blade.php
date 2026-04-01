<!-- User Profile Header -->
<section class="profile-header">
    <div class="profile-container">
        <div class="profile-left">

            <div class="profile-main">
                <div class="profile-user">
                    <div class="profile-pic">
                        <a href="{{ route('profile.header', $spot->user->id) }}">
                            @if ($spot->user->avatar)
                                <img src="{{ $spot->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary profile-sm d-block text-center"></i>
                            @endif
                        </a>
                    </div>

                    <div class="profile-name-badge">
                        <div class="profile-name">{{ $spot->user->name }}</div>

                        @if ($spot->user->official_certification == 3)
                            <img src="{{ asset('images/logo/official_personal.png') }}"
                                class="official-personal-inline" alt="official-personal">
                        @endif
                    </div>
                </div>

                @if ($spot->user->id !== Auth::user()->id && Auth::user()->role_id == 1)
                    <div class="follow-area">
                        @if ($spot->user->isFollowed())
                            <form action="{{ route('delete.follow', $spot->user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-following btn-sm w-100">Following</button>
                            </form>
                        @else
                            <form action="{{ route('store.follow', $spot->user->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-follow btn-sm w-100">Follow</button>
                            </form>
                        @endif
                    </div>
                @endif

                <div class="sns-icons">
                    @if (!empty($spot->user->instagram))
                        <a href="https://instagram.com/{{ $spot->user->instagram }}"
                            class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-instagram text-dark icon-md"></i>
                        </a>
                    @endif

                    @if (!empty($spot->user->facebook))
                        <a href="https://facebook.com/{{ $spot->user->facebook }}"
                            class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-facebook text-dark icon-md"></i>
                        </a>
                    @endif

                    @if (!empty($spot->user->x))
                        <a href="https://x.com/{{ $spot->user->x }}"
                            class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-x-twitter text-dark icon-md"></i>
                        </a>
                    @endif

                    @if (!empty($spot->user->tiktok))
                        <a href="https://www.tiktok.com/@{{ $spot->user->tiktok }}"
                            class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-tiktok text-dark icon-md"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
