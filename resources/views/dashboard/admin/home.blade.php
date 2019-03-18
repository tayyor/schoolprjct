@extends('layout')
@section('sub-body')
    <div class="row quick-stats">
        <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2>{{ \App\User::where('role', '!=', \App\User::$SYSTEM_ADMIN_ROLE)->count() }}</h2>
                    <small>Total Admins</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-light-green">
                <div class="quick-stats__info">
                    <h2>{{ \App\User::where('role', '!=', \App\User::$SYSTEM_ADMIN_ROLE)->where('active', 1)->count() }}</h2>
                    <small>Active Users</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-red">
                <div class="quick-stats__info">
                    <h2>{{ \App\User::where('role', '!=', \App\User::$SYSTEM_ADMIN_ROLE)->where('active', 0)->count() }}</h2>
                    <small>Suspended Users</small>
                </div>
            </div>
        </div>
		</div>
		<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"></h2>
                    <small class="card-subtitle"></small>
						{!! Charts::assets() !!}
                    {!! $chart->render() !!}
                </div>
                <div class="card-block">

                </div>
            </div>
        </div>
    </div>
@endsection
 {!! $chart->script() !!}
