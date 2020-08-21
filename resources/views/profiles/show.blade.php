@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="/img/profile_pic.jpg" class="rounded-circle">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{ $user->username }}</h1>
                <div><a href="{{ @route('post.create') }}" class="btn btn-primary ml-4"> Create post</a></div>
            </div>
            <div class="d-flex">
                <div class="pr-4"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pr-4"><strong>335</strong> followers</div>
                <div class="pr-4"><strong>204</strong> following</div>
            </div>
            <div class="pt-3 font-weight-bold">{{ $user->name }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="{{ $user->profile->url }}">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4 pb-4">
                <img src="/storage/{{ $post->image }}" class="w-100" alt=""/>
            </div>
        @endforeach

{{--        <div class="col-4">--}}
{{--            <img src="/img/instapic1.jpg" class="w-100" alt=""/>--}}
{{--        </div>--}}
{{--        <div class="col-4">--}}
{{--            <img src="/img/instapic1.jpg" class="w-100" alt=""/>--}}
{{--        </div>--}}
    </div>
</div>
@endsection
