@extends( 'dashboard.admin.layout' );

@section('sub-body')
    <div class="row">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-7">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Invite/Edit User</h2>
                    <small class="card-subtitle"></small>
                </div>

                <div class="card-block">
                    {!! Form::open(['route'=>['admin.invite.update', $user?$user->id:null]]) !!}
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
                        {!! Form::text('name', $user?$user->name:null, ['class'=>'form-control']) !!}
                        <label>Name</label>
                        <i class="form-group__bar"></i>
                    </div>
                    <div class="form-group form-group--float">
                        {!! Form::text('email', $user?$user->email:null, ['class'=>'form-control']) !!}
                        <label>Email Address</label>
                        <i class="form-group__bar"></i>
                    </div>
                    {{--<div class="form-group form-group--float">--}}
                    {{--<label>Home Jetty</label><br />--}}
                    {{--{!! Form::select('home_jetty', \App\Jetty::getJetty(), $user?$user->home_jetty:null, ['placeholder'=>'unit','class'=>'select2']) !!}--}}
                    {{--<i class="form-group__bar"></i>--}}
                    {{--</div>--}}
                    <div class="form-group form-group--float">
                        <label>User Role</label><br />
                        {!! Form::select('role', \App\User::getRoles(), $user?$user->role:null, ['class'=>'select2']) !!}
                        <i class="form-group__bar"></i>
                    </div>
                    {{--{!! Form::hidden('operator',\App\Operator::find(request()->route('id')) ) !!}--}}

                    @if(!$user)
                        <div class="form-group form-group--float">
                            {!! Form::password('password', ['class'=>'form-control']) !!}
                            <label>Temporary Password</label>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="form-group form-group--float">
                            {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                            <label>Confirm Password</label>
                            <i class="form-group__bar"></i>
                        </div>
                    @endif
                    <div class="card-block center-block text-center align-content-center">
                        <input type="submit" value="Invite/Update" class="btn btn-default waves-effect" />
                    </div>
                    @if($user)
                        <p class="text-right">User access is currently <strong>{{ $user->active?'Active':'Disabled' }}</strong></p>
                        <hr>
                        <p class="text-right text-danger"><a href="{{ route('admin.manage') }}" class="text-danger">cancel edit here</a></p>
                    @endif

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
    {!! $dataTable->scripts() !!}
@endpush