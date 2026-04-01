@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
@endsection

<div class="card p-3 h-100">
    <div class="card-header border-0 bg-light p-0 overflow-hidden">
        <a href="{{ route('promotions.show', $post->id) }}">
            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="post-image">
        </a>
    </div>

    <div class="card-body d-flex flex-column">

        <!-- 日付 -->
        <div class="mb-2 text-end">
            @if($post->updated_at)
                <small class="text-muted">
                    {{ $post->updated_at->format('H:i, M d Y') }}
                </small>
            @else
                <small class="text-muted">
                    {{ $post->created_at->format('H:i, M d Y') }}
                </small>
            @endif
        </div>

        <!-- タイトル -->
        <h5 class="fw-bold mb-2">{{ $post->title }}</h5>

        <!-- 期間 -->
        @if($post->promotion_start)
            <div class="mb-2">
                <small class="fw-semibold">
                    {{ date('M d Y', strtotime($post->promotion_start)) }}
                    ~
                    {{ date('M d Y', strtotime($post->promotion_end)) }}
                </small>
            </div>
        @endif

        <!-- 説明 -->
        <p class="card_description flex-grow-1">
            {{ $post->introduction }}
        </p>

    </div>
</div>

