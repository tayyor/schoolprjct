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
                <li class="{{ str_contains(request()->path(), 'home')?'navigation__active':'' }}"><a href="{{ route('unit.home') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                <li class="{{ str_contains(request()->path(), 'table')?'navigation__active':'' }}"><a href="{{ route('unit.table') }}"><i class="zmdi zmdi-storage"></i> Manage</a></li>
            </ul>

        </div>
        <div class="col-sm-9">
            @yield('sub-body')
        </div>
    </div>

@endsection
