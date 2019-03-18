@extends('dashboard.profile.layout')
@section('sub-body')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Reset my password</h2>
                </div>

                <div class="card-block">
                    {!! Form::open(['route'=>['profile.password.change.save']]) !!}
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
                        <div class="alert alert-success text-center">Password changed Successfully</div>
                    @endif

                    <div class="form-group form-group--float">
                        {!! Form::password('password', ['class'=>'form-control']) !!}
                        <label>New Password</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float">
                        {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                        <label>Confirm Password</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="card-block center-block text-center align-content-center">
                        <input type="submit" value="Reset Password" class="btn btn-default waves-effect" />
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
