@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="row">
                    <h1>Edit profile</h1>
                </div>
            </div>
            <div class="col-8">
                <form method="POST" action="{{ route('profile.update', ['username'=>$user->username]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="form-group row">
                        <label for="image" >{{ __('Profile image') }}</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                        @error('image')
                            <strong style="color: #e3342f">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="description">{{ __('Description') }}</label>
                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $user->profile->description}}" required autocomplete="description" autofocus>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="url">{{ __('URL') }}</label>
                        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url }}" required autocomplete="url" autofocus>
                        @error('url')
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
