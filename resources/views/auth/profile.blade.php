@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Profile
        </h1>
    </section>
    <div class="content">
        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body" style="overflow: hidden">
                <div class="col-xs-4">
                    <div class="form-group">
                        {!! Form::label('name', __('messages.name') . ':') !!}
                        <p>{!! $user->name !!}</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', __('messages.email') . ':') !!}
                        <p>{!! $user->email !!}</p>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="form-group">
                        {!! Form::label('address', __('messages.address') . ':') !!}
                        <p>{!! $user->address ? $user->address  : "&nbsp;" !!}</p>
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone_number', __('messages.phone_number') . ':') !!}
                        <p>{!! $user->phonenumber ? $user->phonenumber : "&nbsp;" !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body" style="overflow: hidden">
                <div class="row">
                    <form class="form-horizontal" action="{!! url('') !!}/change_pass" method="POST">
                        <fieldset>
                            <!-- Form Name -->
                            <legend style="margin-left: 15px">Change password</legend>
                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="piCurrPass">Current password</label>
                                <div class="col-md-4">
                                    <input id="piCurrPass" name="piCurrPass" type="password" placeholder="" class="form-control input-md" required="">
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="piNewPass">New password</label>
                                <div class="col-md-4">
                                    <input id="piNewPass" name="piNewPass" type="password" placeholder="" class="form-control input-md" required="">
                                </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="piNewPassRepeat">Confirm new password</label>
                                <div class="col-md-4">
                                    <input id="piNewPassRepeat" name="piNewPassRepeat" type="password" placeholder="" class="form-control input-md" required="">
                                </div>
                            </div>
                            <!-- Button (Double) -->
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="bCancel"></label>
                                <div class="col-md-8">
                                    <button id="bGodkend" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
