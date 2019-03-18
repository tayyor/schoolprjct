@extends('layouts.common.dashboard')
@section('body')
    <div class="row">
        <div class="col-sm-3">
            <div class="user">
                <div class="user__info" data-toggle="dropdown">
                    <img class="user__img" src="{{ asset('img/assets/profile_pics_placeholder.jpg') }}" alt="">
                    <div>
                        <div class="user__name">{{ Auth::user()->name }}</div>
                        <div class="user__email">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <ul class="navigation">
                <li class="{{ str_contains(request()->path(), 'view')?'navigation__active':'' }}"><a href="{{ route('profile.view') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                @if((Auth::user()->role != 1 || $found_user->id == Auth::user()->id) && is_null($id))
                    <li class="{{ str_contains(request()->path(), 'edit')?'navigation__active':'' }}"><a href="{{ route('profile.edit') }}"><i class="zmdi zmdi-edit"></i> Edit</a></li>
                    <li class="{{ str_contains(request()->path(), 'change')?'navigation__active':'' }}"><a href="{{ route('profile.password.change') }}"><i class="zmdi zmdi-shield-security"></i> Change Password</a></li>
                @endif
            </ul>

        </div>
        <div class="col-sm-9">
            @yield('sub-body')
        </div>
    </div>

@endsection
