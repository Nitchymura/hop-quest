@if ($user->role_id == 1)
    {{-- SNS icons --}}
    <div class="sns-icons d-flex align-items-center col-auto ms-auto">
        @if (!empty($user->instagram))
            <a href="https://instagram.com/{{ $user->instagram }}"
                class="text-decoration-none d-flex align-items-center px-2" target="_blank" rel="noopener">
                <i class="fa-brands fa-instagram text-white icon-md mx-1"></i>
            </a>
        @endif
        @if (!empty($user->facebook))
            <a href="https://facebook.com/{{ $user->facebook }}"
                class="text-decoration-none d-flex align-items-center px-2" target="_blank" rel="noopener">
                <i class="fa-brands fa-facebook text-white icon-md mx-1"></i>
            </a>
        @endif
        @if (!empty($user->x))
            <a href="https://x.com/{{ $user->x }}" class="text-decoration-none d-flex align-items-center px-2"
                target="_blank" rel="noopener">
                <i class="fa-brands fa-x-twitter text-white icon-md mx-1"></i>
            </a>
        @endif
        @if (!empty($user->tiktok))
            <a href="https://www.tiktok.com/@{{ $user - > tiktok }}"
                class="text-decoration-none d-flex align-items-center px-2" target="_blank" rel="noopener">
                <i class="fa-brands fa-tiktok text-white icon-md mx-1"></i>
            </a>
        @endif
    </div>
@elseif($user->role_id == 2)
    <div class="sns-icons d-flex align-items-center col-auto ms-auto">
        @if (!empty($user->instagram))
            <a href="https://instagram.com/{{ $user->instagram }}"
                class="text-decoration-none d-flex align-items-center px-2" target="_blank" rel="noopener">
                <i class="fa-brands fa-instagram text-dark icon-md mx-1"></i>
            </a>
        @endif
        @if (!empty($user->facebook))
            <a href="https://facebook.com/{{ $user->facebook }}"
                class="text-decoration-none d-flex align-items-center px-2" target="_blank" rel="noopener">
                <i class="fa-brands fa-facebook text-dark icon-md mx-1"></i>
            </a>
        @endif
        @if (!empty($user->x))
            <a href="https://x.com/{{ $user->x }}" class="text-decoration-none d-flex align-items-center px-2"
                target="_blank" rel="noopener">
                <i class="fa-brands fa-x-twitter text-dark icon-md mx-1"></i>
            </a>
        @endif
        @if (!empty($user->tiktok))
            <a href="https://www.tiktok.com/@{{ $user - > tiktok }}"
                class="text-decoration-none d-flex align-items-center px-2" target="_blank" rel="noopener">
                <i class="fa-brands fa-tiktok text-dark icon-md mx-1"></i>
            </a>
        @endif
    </div>
@endif
