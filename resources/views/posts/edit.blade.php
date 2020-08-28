@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="row">
                    <h1>Edit post</h1>
                </div>
            </div>
            <div class="col-8">
                <form method="POST" action="{{ route('post.update', ['post'=>$post->id]) }}">
                    @csrf
                    @method('patch')

                    <div class="form-group row">
                        <label for="caption">{{ __('Caption') }}</label>
                        <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') ?? $post->caption}}" required autocomplete="caption" autofocus>
                        @error('caption')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
