@extends('dashboard.apartment.layout' )
    @section('sub-body')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Add/Edit An Apartment</h2>
                        <small class="card-subtitle"></small>
                    </div>

                    <div class="card-block">
                        {!! Form::open(['route'=>['apartment.save', $boat?$boat->id:null]]) !!}
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
							<div class="row">
							<div class="col-sm-6">
                            <div class="form-group form-group--float">
                                {!! Form::text('name', $boat?$boat->name:null, ['class'=>'form-control']) !!}
                                <label>Name</label>
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group form-group--float">
                                {!! Form::text('location', $boat?$boat->location:null, ['class'=>'form-control']) !!}
                                <label>Location</label>
                                <i class="form-group__bar"></i>
                            </div>
							
                            <div class="form-group form-group--float">
                                {!! Form::text('address', $boat?$boat->address:null, ['class'=>'form-control']) !!}
                                <label>Address</label>
                                <i class="form-group__bar"></i>
                            </div>


							</div>
							<div class="col-sm-6">
                                <div class="form-group form-group--float">
                                    {!! Form::text('state', $boat?$boat->state:null, ['class'=>'form-control']) !!}
                                    <label>State</label>
                                    <i class="form-group__bar"></i>
                                </div>
                            <div class="form-group form-group--float">
							 <label>Type</label><br>
                                {!! Form::select('type',['residential'=>'Residential','commercial'=>'Commercial'],$boat?$boat->type:null, ['placeholder'=>$boat?$boat->type:null,'class'=>'select2']) !!}
                               
                                <i class="form-group__bar"></i>
                            </div>
							
							<div class="form-group form-group--float">
                                <label>Landord</label><br />
                                {!! Form::select('owner_id', \App\User::getUserbyRole(0), $boat?$boat->landlord:null, ['placeholder'=>' ','class'=>'select2']) !!}
                                <i class="form-group__bar"></i>
                            </div>
							

							</div>
							</div>
                            <div class="card-block center-block text-center align-content-center">
                                <input type="submit" value="Add /Edit Apartment" class="btn btn-default waves-effect" />
                            </div>
							


                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    {{--<div class="card-header">--}}
                        {{--<h2 class="card-title">Manage Offices</h2>--}}
                        {{--<small class="card-subtitle"></small>--}}
                    {{--</div>--}}

                    <div class="card-block">
                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
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
    {!! $dataTable->scripts() !!}
@endpush