@extends('layouts.app')
    @section('content')
        <div class="login"
             style='background: url("{{ asset('roadzoft-bg.jpg') }}") no-repeat; background-size: 100%;'>
            <!-- Login -->
            <div class="login__block active" style="max-width:430px;" id="l-login">
                <div class="login__block__header">
                    <i class="zmdi zmdi-account-circle"></i>
                    Have an account? Sign in OR <br/>
                    <a href="{{route('unit.public')}}" style="color: yellow">Click here to see apartments</a>

                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('password.request') }}">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    {!! Form::open(['route'=>'login', 'id'=>'login-form']) !!}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group form-group--float form-group--centered">
						
                            {!! Form::email('email', null, ['class'=>'form-control', 'required']) !!}
							 <label >Email Address</label>
                            {{--<input type="email" name="email" class="form-control" required>--}}
                           
                            <i class="form-group__bar"></i>
                        </div>

                        <div class="form-group form-group--float form-group--centered">
						 
                            <input type="password" name="password" class="form-control" required>
                           <label>Password</label>
                            <i class="form-group__bar"></i>
                        </div>

                        <a href="javascript:;" onclick="return $('#login-form').submit()" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-long-arrow-right"></i></a>
                    {!! Form::close() !!}
                    <p class="text-center mt-3"><small>{{ config('app.name').' v'.config('roadzoft.current_version') }}</small></p>
                </div>
            </div>
        </div>
    @endsection