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
			
				<li class="{{ str_contains(request()->path(), 'administration')?'navigation__active':'' }}" ><a href="{{ route('operator.dashboard',request()->route('id')) }}"><i class="zmdi zmdi-desktop-mac"></i> Dashboard</a></li>
				<li class="{{ str_contains(request()->path(), 'manage_boat')?'navigation__active':'' }}"><a href="{{ route('operator.assign.boat',request()->route('id')) }}"> <i class="zmdi zmdi-boat"></i>Boats</a></li>
				<li class="{{ str_contains(request()->path(), 'users/manage')?'navigation__active':'' }}"><a href="{{ route('admin.manage',request()->route('id')) }}"><i class="zmdi zmdi-accounts"></i> Staff</a></li>
				<li class="nav-item dropdown {{ str_contains(request()->path(), 'trip')?'navigation__active':'' }}">
                            <a class="nav-link" href="" data-toggle="dropdown"><i class="zmdi zmdi-swap"></i> Trips</a>
                            <div class="dropdown-menu">
                                <a href="{{ route('trip.home',request()->route('id')) }}" class="dropdown-item">Create</a>
								<a href="{{ route('trip.overview',request()->route('id')) }}" class="dropdown-item">Manage</a>
                            </div> 
                </li>
			
			</ul>
			   <div class="user">
                <div class="user__info" data-toggle="dropdown">
				<img class="user__img" src="{{ asset('img/assets/operator.jpg') }}" alt="">
                    <div>
                        <div class="user__name">Operator Name:{{ \App\Operator::find(request()->route('id'))->name }}</div>
                        <div class="user__email">Operator Number: {{ \App\Operator::find(request()->route('id'))->cac }}</div>
						<div class="user__email">Operator Boats: {{ \App\Boat::where('operator',request()->route('id'))->count() }}</div>
						<div class="user__email">Operator Jetties: {{ \App\Jetty::where('operator',request()->route('id'))->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            @yield('sub-body')
        </div>
    </div>

@endsection