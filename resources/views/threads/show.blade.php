@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between items-center">
                        {{ $thread->title }}
                        @if (Auth::check())
                                @can('update', $thread)
                                    <form action="{{ $thread->path() }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                @endcan
                            @endif
                    </div>

                    <div class="card-body">
                        <article>
                            <p>{{ $thread->body }}</p>
                        </article>

                    </div>
                </div>
                @forelse($replies as $reply)
                    @include('threads.reply')
                @empty
                    Replies list is empty
                @endforelse
                {{ $replies->links() }}

                @guest
                    <p class="text-center pt-3">
                        Please
                        <a href="{{ route('login') }}">sign in</a>
                        to participate
                    </p>
                @else
                    <form action="{{ $thread->path() . '/replies' }}" method="post">
                        @csrf

                        <textarea name="body"
                                  id="body"
                                  cols="30"
                                  rows="5"
                                  class="form-control"
                                  placeholder="Say something?"></textarea>
                        <button class="btn btn-primary" type="submit">Send</button>
                    </form>
                @endguest
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        Published {{ $thread->created_at->diffForHumans() }} by
                        <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
                        , and has {{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection