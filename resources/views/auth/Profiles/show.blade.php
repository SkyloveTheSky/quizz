@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $user->name }}</h1>
    @if($user->avatar)
        <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="img-thumbnail" width="100">
    @endif
    <a href="{{ route('profile.edit', ['hashed_user_id' => $hashed_user_id]) }}" class="btn btn-primary">Edit Profile</a>
</div>
@endsection
