@extends('dashboard.profile.layout')
@section('sub-body')
    <div class="row quick-stats">
        <div class="col-sm-4">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2>{{ \App\User::getRoleName($found_user->role) }}</h2>
                    <small>Role</small>
                </div>
            </div>
        </div>

        {{--<div class="col-sm-4">--}}
            {{--<div class="quick-stats__item bg-light-blue">--}}
                {{--<div class="quick-stats__info">--}}
                    {{--<h2>{{ \App\Jetty::getName($found_user->home_jetty) }}</h2>--}}
                    {{--<small>Home Jetty</small>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="col-sm-4">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2><small>{{ $found_user->created_at }}</small></h2>
                    <small>User Since</small>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2>{{  \App\Apartment::where('owner_id',$found_user->id)->get()->count() }}</h2>
                    <small>Apartments</small>
                </div>
            </div>
        </div>

        {{--<div class="col-sm-4">--}}
            {{--<div class="quick-stats__item bg-light-blue">--}}
                {{--<div class="quick-stats__info">--}}
                    {{--<h2>{{  \App\Trip_staff::where('staff_id',$found_user->id)->get()->count() }}</h2>--}}
                    {{--<small>Trips Managed</small>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        

    </div>
@endsection
