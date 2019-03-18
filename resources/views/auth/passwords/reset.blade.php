@extends('layouts.app')
    @section('content')
        <div class="login"
             style='background: url("{{ asset('roadzoft-bg.jpg') }}") no-repeat; background-size: 100%;'>
            <!-- Forgot Password -->
            <div class="login__block active" style="max-width:430px;" id="l-forget-password">
                <div class="login__block__header palette-Purple bg">
                    <i class="zmdi zmdi-account-circle"></i>
                    New Password Window

                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('home.login') }}">Already have an account?</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    <p class="mt-4">Change your password here.</p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {!! Form::open(['route'=>'password.request', 'id'=>'password-reset-form']) !!}

                    <div class="form-group form-group--float form-group--centered">
                        <input type="password" name="password" class="form-control" required>
                        <label>New Password</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float form-group--centered">
                        <input type="password" name="password_confirmation" class="form-control" required>
                        <label>Confirm Password</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <a href="javascript:;" onclick="return $('#password-reset-form').submit()" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-check"></i></a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endsection