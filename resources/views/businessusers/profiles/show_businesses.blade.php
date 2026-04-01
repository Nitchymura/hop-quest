<div class="container-fluid px-3 px-md-4 px-xl-5 mt-4 mb-5">
    <div class="row justify-content-center">
        @forelse($businesses as $post)
            @if(!$post['is_trashed'] || (Auth::check() && $post['user_id'] == Auth::id()))
                <div class="col-12 col-md-6 col-xl-4 mb-4">
                    @include('businessusers.profiles.post-body-profile')
                </div>
            @endif
        @empty
            <h4 class="h4 text-center text-secondary">No posts yet</h4>
        @endforelse
    </div>

    <div class="d-flex justify-content-end mb-5">
        {{ $businesses->links() }}
    </div>
</div>