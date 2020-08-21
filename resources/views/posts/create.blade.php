@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="row">
                <h1>Create a new post</h1>
            </div>
        </div>
        <div class="col-8">
            <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="image" >{{ __('Image') }}</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    @error('image')
                        <strong style="color: #e3342f">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="caption">{{ __('Caption') }}</label>
                        <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" required autocomplete="caption" autofocus>
                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-primary">Create post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
