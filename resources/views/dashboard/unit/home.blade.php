@extends('dashboard.unit.layout')
@section('sub-body')
    <div class="row quick-stats">
        <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-light-blue">
                <div class="quick-stats__info">
                    <h2>{{ \App\Apartment::count() }}</h2>
                    <small>All Apartments</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-light-green">
                <div class="quick-stats__info">
                    <h2>{{ \App\User::where('role', 0)->count() }}</h2>
                    <small>Active Landords</small>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-deep-orange">
                <div class="quick-stats__info">
                    <h2>{{ \App\Application::count() }}</h2>
                    <small>Applications</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="quick-stats__item bg-deep-purple">
                <div class="quick-stats__info">
                    <h2>{{ \App\Unit::count() }}</h2>
                    <small>Total Units</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card-block">
            <div class="row">
                <div class="col-sm-12">
                    {!! Charts::assets() !!}
                    {!! $chart->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
{!! $chart->script() !!}
