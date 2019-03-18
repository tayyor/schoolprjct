@extends('dashboard.profile.layout')
@section('sub-body')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Update my profile</h2>
                </div>

                <div class="card-block">
                    {!! Form::open(['route'=>['profile.edit.save']]) !!}
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
                        <div class="alert alert-success text-center">Profile details updated Successfully</div>
                    @endif

                    <div class="form-group form-group--float">
                        {!! Form::text('name', $found_user?$found_user->name:null, ['class'=>'form-control']) !!}
                        <label>Name</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label><br />
                        <strong>{{ $found_user->email }}</strong>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group">
                        <label>Role</label><br />
                        <strong>{{ \App\User::getRoleName($found_user->role) }}</strong>
                        <i class="form-group__bar"></i>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label>Home Jetty</label><br />--}}
                        {{--<strong>{{ $found_user->home_jetty?\App\Jetty::getName($found_user->home_jetty) :'NONE' }}</strong>--}}
                        {{--<i class="form-group__bar"></i>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <label>Picture</label><br />
                        <img class="user__img" src="{{ asset('img/assets/profile_pics_placeholder.jpg') }}" alt="">
                        <a href="#" class="color-red">change picture</a>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="card-block center-block text-center align-content-center">
                        <input type="submit" value="Save" class="btn btn-default waves-effect" />
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
