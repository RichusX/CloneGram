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
                        <img class="card-img" style="border-radius: 0 !important;" src="/storage/{{ $post->image }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#" class="text-dark">
                                        <svg width="1.6em" height="1.6em" viewBox="0 0 16 16" class="bi bi-heart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="mr-3"><strong>66</strong> likes</div>
                            </div>
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
