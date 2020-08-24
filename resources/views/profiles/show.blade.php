@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex align-items-center">
                <h1>{{ $user->username }}</h1>
                @auth
                        @if($user->id != Auth::user()->id)
                            <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                        @endif
                        <div class="d-flex">
                            @can('update', $user->profile)
                                <div><a href="{{ @route('profile.edit', ['username'=>$user->username]) }}" class="btn btn-outline-secondary ml-4">Edit profile</a></div>
                            @endcan
                        </div>
                @endauth
            </div>
            <div class="d-flex">
                <div class="pr-4"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pr-4"><strong>{{ $user->profile->followers->count() }}</strong> followers</div>
                <div class="pr-4"><strong>{{ $user->following->count() }}</strong> following</div>
            </div>
            <div class="pt-3 font-weight-bold">{{ $user->name }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="{{ $user->profile->url }}">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="{{ @route('post.show', ['post' => $post->id]) }}">
                    <img src="/storage/{{ $post->image }}" class="w-100" alt=""/>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
