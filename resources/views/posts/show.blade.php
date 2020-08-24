@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{ $post->image }}" class="img-fluid" alt="">
            </div>
            <div class="col-4">


                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <a href="{{ @route('profile.show', ['username' => $post->user->username]) }}" >
                                <img src="{{ $post->user->profile->profileImage() }}" alt="{{ $post->user->username}}'s profile picture" class="rounded-circle w-100" style="max-width: 40px;">
                            </a>
                        </div>
                        <div class="font-weight-bold">
                            <a href="{{ @route('profile.show', ['username' => $post->user->username]) }}" >
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                            @if($post->user_id != Auth::user()->id)
                                <span>•</span>
                                <a href="#">Follow</a>
                            @endif

                        </div>
                    </div>
                <hr>
                <p>
                    <a href="{{ @route('profile.show', ['username' => $post->user->username]) }}" >
                        <span class="font-weight-bold text-dark">{{ $post->user->username }}</span>
                    </a>
                    {{ $post->caption }}
                </p>
            </div>
        </div>
    </div>
@endsection
