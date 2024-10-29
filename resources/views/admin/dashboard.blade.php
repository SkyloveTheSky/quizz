@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        {{ __('You are logged in as, ') }} {{ Auth::guard('admin')->user()->name }}{{ __('!') }}
                </div>

                <div class="card">
                    <div class="card-body">
                        <p>Total Users: {{ $userCount }}</p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
