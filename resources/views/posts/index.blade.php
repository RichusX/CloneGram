@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="row pb-4">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-body pb-1">
                            <div class="card-title">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <a href="{{ @route('profile.show', ['username' => $post->user->username]) }}" >
                                            <img src="{{ $post->user->profile->profileImage() }}" alt="{{ $post->user->username}}'s profile picture" class="rounded-circle w-100" style="max-width: 32px;">
                                        </a>
                                    </div>
                                    <div class="font-weight-bold">
                                        <a href="{{ @route('profile.show', ['username' => $post->user->username]) }}" >
                                            <span class="text-dark">{{ $post->user->username }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ @route('post.show', ['post'=>$post->id]) }}"><img class="card-img" style="border-radius: 0 !important;" src="/storage/{{ $post->image }}"></a>
                        <div class="card-body">
                            <like-button post-id="{{ $post->id }}" liked="{{ $likes->contains($post->id) }}" likes="{{ $post->liked_by->count() }}"></like-button>
                            <div class="text-muted small pt-1">{{ $post->created_at_string() }}</div>
                        </div>

                    </div>
                </div>
            </div>


{{--            <div class="row">--}}
{{--                <div class="col-8 offset-2">--}}
{{--                    <img src="/storage/{{ $post->image }}" class="img-fluid" alt="">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-4">--}}

{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div class="mr-3">--}}
{{--                                <a href="{{ @route('profile.show', ['username' => $post->user->username]) }}" >--}}
{{--                                    <img src="{{ $post->user->profile->profileImage() }}" alt="{{ $post->user->username}}'s profile picture" class="rounded-circle w-100" style="max-width: 40px;">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="font-weight-bold">--}}
{{--                                <a href="{{ @route('profile.show', ['username' => $post->user->username]) }}" >--}}
{{--                                    <span class="text-dark">{{ $post->user->username }}</span>--}}
{{--                                </a>--}}
{{--                                @if($post->user_id != Auth::user()->id)--}}
{{--                                    <span>•</span>--}}
{{--                                    <a href="#">Follow</a>--}}
{{--                                @endif--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    <hr>--}}
{{--                    <p>--}}
{{--                        <a href="{{ @route('profile.show', ['username' => $post->user->username]) }}" >--}}
{{--                            <span class="font-weight-bold text-dark">{{ $post->user->username }}</span>--}}
{{--                        </a>--}}
{{--                        {{ $post->caption }}--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
        @endforeach
    </div>
@endsection
