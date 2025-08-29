@if ($posts->isEmpty())
    <div class="empty d-flex justify-content-center not-found">
        No result
    </div>
@else
    @foreach ($posts as $post)
        <div class="col-4 mb-5">
            @include('home.search-result-body', ['post' => $post])
        </div>
    @endforeach

    <div class="mt-4">
        {{ $posts->appends(request()->query())->links() }}
    </div>
    
@endif
