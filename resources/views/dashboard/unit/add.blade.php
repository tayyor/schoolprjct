@extends('layouts.app')

@section('content')

    <div class="row" style='background: url("{{ asset('roadzoft-bg.jpg') }}") no-repeat; background-size: 100%;'>
        <div class="col-sm-1">
        </div>
        <div class="col-sm-7">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Apply for An Apartment Unit</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">
                    {!! Form::open(['route'=>['application.save']]) !!}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(old('success'))
                        <div class="alert alert-success text-center">Request was Successful</div>
                    @endif

                    <div class="form-group form-group--float">
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                        <label>Name</label>
                        <i class="form-group__bar"></i>
                    </div>
                    <div class="form-group form-group--float">
                        {!! Form::text('contact', null, ['class'=>'form-control']) !!}
                        <label>Contact</label>
                        <i class="form-group__bar"></i>
                    </div>
                    {{--<div class="form-group form-group--float">--}}
                    {{--<label>Home Jetty</label><br />--}}
                    {{--{!! Form::select('home_jetty', \App\Jetty::getJetty(), $user?$user->home_jetty:null, ['placeholder'=>'unit','class'=>'select2']) !!}--}}
                    {{--<i class="form-group__bar"></i>--}}
                    {{--</div>--}}
                    <div class="form-group form-group--float">
                        <label>Unit</label><br />
                        {!! Form::select('unit_id', \App\Unit::getUnits(), null, ['class'=>'select2']) !!}
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float">
                        {!! Form::number('family_size', null, ['class'=>'form-control']) !!}
                        <label>Family Size</label>
                        <i class="form-group__bar"></i>
                    </div>
                    <div class="form-group form-group--float">
                        {!! Form::number('age_range', null, ['class'=>'form-control']) !!}
                        <label>Age</label>
                        <i class="form-group__bar"></i>
                    </div>
                    <div class="form-group form-group--float">
                        {!! Form::text('occupation', null, ['class'=>'form-control']) !!}
                        <label>Occupation</label>
                        <i class="form-group__bar"></i>
                    </div>
                    <div class="form-group form-group--float">
                        {!! Form::text('income_range', null, ['class'=>'form-control']) !!}
                        <label>Income Range</label>
                        <i class="form-group__bar"></i>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush
@push('scripts')
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>

@endpush