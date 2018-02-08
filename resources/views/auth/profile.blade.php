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

            <div class="box-body">
                <div class="row">
                    <form class="form-horizontal" action="{!! url('') !!}/change_pass" method="POST">
                        <fieldset>
                            <!-- Form Name -->
                            <legend>Change password</legend>
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
