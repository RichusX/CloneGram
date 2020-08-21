@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{ $post->image }}" class="img-fluid" alt="">
            </div>
            <div class="col-4">
                <a href="{{ @route('profile.show', ['username' => $post->user->username]) }}"><h3>{{ $post->user->username }}</h3></a>
                <p>{{ $post->caption }}</p>
            </div>
        </div>
    </div>
@endsection
