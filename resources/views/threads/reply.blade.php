{{-- <div class="card">
    <div class="card-header">
        <div class="level">
            <h5 class="flex">
                <a href="{{ route('profile', $reply->owner) }}">
                    {{ $reply->owner->name }}
                </a> said {{ $reply->created_at->diffForHumans() }}...
            </h5>

            <div>
                <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                    {{ csrf_field() }}

                    <button type="submit" class="btn btn-default" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ Str::plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>
</div> --}}


<div class="card mb-2">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('profile', $reply->owner) }}">{{ $reply->owner->name }}</a>
            said
            {{ $reply->created_at->diffForHumans() }}
        </div>
        <div>
            <form action="/replies/{{ $reply->id }}/favorites" method="post">
                @csrf
                <button class="form-control"
                        type="submit" {{ $reply->isFavorited() ? 'disabled' : '' }}>{{ $reply->favorites_count. ' '. Str::plural('like', $reply->favorites_count) }}</button>
            </form>
        </div>
    </div>

    <div class="card-body">
        <article>
            <p>{{ $reply->body }}</p>
        </article>
    </div>
</div>