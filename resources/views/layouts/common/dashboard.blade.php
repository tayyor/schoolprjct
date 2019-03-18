@extends('layouts.app')
    @section('content')
        <main class="main main--alt">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>
            <header class="header">
                <div class="header__logo">
                    <h1><a href="{{ route('home') }}">{{ config('app.name') }}<sup>&trade;</sup></a></h1>
                </div>

                <ul class="top-nav">
                    <li class="hidden-xl-up"><a href="" data-ma-action="search-open"><i class="zmdi zmdi-search"></i></a></li>

                    <li class="dropdown top-nav__notifications">
                        <a href="" data-toggle="dropdown" class="top-nav__notify">
                            <i class="zmdi zmdi-notifications"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                            <div class="listview listview--hover">
                                <div class="listview__header">
                                    Notifications

                                    <div class="actions">
                                        <a href="" class="actions__item zmdi zmdi-rss" data-ma-action=""></a>
                                    </div>
                                </div>

                                {{--<div class="listview__scroll scrollbar-inner">--}}
                                    {{--<a href="" class="listview__item">--}}
                                        {{--<img src="demo/img/profile-pics/1.jpg" class="listview__img" alt="">--}}

                                        {{--<div class="listview__content">--}}
                                            {{--<div class="listview__heading">David Belle</div>--}}
                                            {{--<p>Cum sociis natoque penatibus et magnis dis parturient montes</p>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}

                                    {{--<a href="" class="listview__item">--}}
                                        {{--<img src="demo/img/profile-pics/2.jpg" class="listview__img" alt="">--}}

                                        {{--<div class="listview__content">--}}
                                            {{--<div class="listview__heading">Jonathan Morris</div>--}}
                                            {{--<p>Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</p>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}

                                    {{--<a href="" class="listview__item">--}}
                                        {{--<img src="demo/img/profile-pics/3.jpg" class="listview__img" alt="">--}}

                                        {{--<div class="listview__content">--}}
                                            {{--<div class="listview__heading">Fredric Mitchell Jr.</div>--}}
                                            {{--<p>Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</p>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}

                                    {{--<a href="" class="listview__item">--}}
                                        {{--<img src="demo/img/profile-pics/4.jpg" class="listview__img" alt="">--}}

                                        {{--<div class="listview__content">--}}
                                            {{--<div class="listview__heading">Glenn Jecobs</div>--}}
                                            {{--<p>Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</p>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}

                                    {{--<a href="" class="listview__item">--}}
                                        {{--<img src="demo/img/profile-pics/5.jpg" class="listview__img" alt="">--}}

                                        {{--<div class="listview__content">--}}
                                            {{--<div class="listview__heading">Bill Phillips</div>--}}
                                            {{--<p>Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</p>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}

                                    {{--<a href="" class="listview__item">--}}
                                        {{--<img src="demo/img/profile-pics/1.jpg" class="listview__img" alt="">--}}

                                        {{--<div class="listview__content">--}}
                                            {{--<div class="listview__heading">David Belle</div>--}}
                                            {{--<p>Cum sociis natoque penatibus et magnis dis parturient montes</p>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}

                                    {{--<a href="" class="listview__item">--}}
                                        {{--<img src="demo/img/profile-pics/2.jpg" class="listview__img" alt="">--}}

                                        {{--<div class="listview__content">--}}
                                            {{--<div class="listview__heading">Jonathan Morris</div>--}}
                                            {{--<p>Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</p>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}

                                    {{--<a href="" class="listview__item">--}}
                                        {{--<img src="demo/img/profile-pics/3.jpg" class="listview__img" alt="">--}}

                                        {{--<div class="listview__content">--}}
                                            {{--<div class="listview__heading">Fredric Mitchell Jr.</div>--}}
                                            {{--<p>Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</p>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--</div>--}}

                                <div class="p-1"></div>
                            </div>
                        </div>
                    </li>

                    <li class="dropdown hidden-xs-down">
                        <a href="" data-toggle="dropdown"><i class="zmdi zmdi-apps"></i></a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--block" role="menu">
                            <div class="row app-shortcuts">
                                <a class="col-6 app-shortcuts__item" href="{{ route('profile.view') }}">
                                    <i class="zmdi zmdi-settings-square bg-green"></i>
                                    <small class="">My Profile</small>
                                </a>
                                @if(Auth::user()->role == 1)
                                  
                                    <a class="col-6 app-shortcuts__item" href="{{ route('admin.home') }}">
                                        <i class="zmdi zmdi-folder-person bg-pink"></i>
                                        <small class="">Users</small>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>

                    <li class="">
                        <a href="{{ route('dashboard.logout') }}" data-toggle="" class="">
                            <i class="zmdi zmdi-power-off danger"></i>
                        </a>
                    </li>

                </ul>
                <ul class="nav top-menu">
					<li class="nav-item {{ str_contains(request()->path(), 'dashboard/profile')?'active':'' }}"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
				@if(Auth::user()->role == 1 )
                        <li class="nav-item {{ str_contains(request()->path(), 'dashboard/user')?'active':'' }}"><a class="nav-link" href="{{ route('admin.add') }}">Users</a></li>
				@endif
                   <li class="nav-item {{ str_contains(request()->path(), 'unit')?'active':'' }}"><a class="nav-link" href="{{ route('unit.home') }}">Units</a></li>
                   <li class="nav-item {{ str_contains(request()->path(), 'apartment')?'active':'' }}"><a class="nav-link" href="{{ route('apartment.home') }}">Apartments</a></li>
				           <li class="nav-item {{ str_contains(request()->path(), 'dashboard/application')?'active':'' }}"><a class="nav-link" href="{{ route('application.home') }}">Applications</a></li>
				   {{--<li class="nav-item {{ str_contains(request()->path(), 'dashboard/route')?'active':'' }}"><a class="nav-link" href="{{ route('route.home') }}">Rents</a></li>--}}

                </ul>
            </header>

            <section class="content content--full">
                <div class="content__inner">

                    @yield('body')

                    <footer class="footer hidden-xs-down">
                        <p><small>{{ ' v'.config('roadzoft.current_version') }}</small></p>
                        <p>&copy; 2018 Hafeez Gbenle.</p>

                        <ul class="nav footer__nav">
                        </ul>
                    </footer>
                </div>
            </section>

        </main>
    @endsection
@push('scripts')
    

@endpush