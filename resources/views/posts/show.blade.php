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
{{--                                <a href="#">Follow</a>--}}
                                <follow-button user-id="{{ $post->user_id }}" follows="{{ $follows }}" as-link="btn-link"></follow-button>
                            @endif

                        </div>
                    </div>
                <hr>
                <div class="d-flex">
                    <like-button post-id="{{ $post->id }}" liked="{{ $likes->contains($post->id) }}" likes="{{ $post->liked_by->count() }}"></like-button>
                    @can('delete', $post)
                    <button type="button" class="btn btn-link text-dark" data-toggle="modal" data-target="#deleteModal">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </button>
                    @endcan
                </div>
                <div class="text-muted small pt-1">{{ $post->created_at_string() }}</div>
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

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this post?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
