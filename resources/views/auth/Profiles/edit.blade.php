@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ __('Edit Profile') }}</h2>
    <div class="card">
        <div class="card-header">{{ __('Edit Your Profile') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update', ['hashed_user_id' => $hashed_user_id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="avatar">{{ __('Avatar') }}</label>
                    <input type="file" id="avatar" name="avatar" class="form-control">
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="img-thumbnail mt-2" width="100">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
