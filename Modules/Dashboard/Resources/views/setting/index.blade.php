@extends('dashboard::layouts.list')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#payment" data-toggle="tab">Payment</a></li>
                        <li><a href="#shipping" data-toggle="tab">Shipping</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- /.tab-pane -->
                        <div class="tab-pane active" id="payment">
                            {!! Form::open(['route'=>'dashboard.setting.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                            <div class="form-group {{ $errors->has('admin_paypal') ? ' has-error' : '' }}">
                                <label for="admin-paypal" class="col-sm-2 control-label">PayPal Email</label>
                                <div class="col-sm-4">
                                    {!! Form::text('admin_paypal', old('admin_paypal') ? old('admin_paypal') : $oldPayPal, ['class' => 'form-control']) !!}
                                    @include('dashboard::partials.error', ['field' => 'admin_paypal'])
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('APIUsername') ? ' has-error' : '' }}">
                                <label for="admin-paypal" class="col-sm-2 control-label">API Username</label>
                                <div class="col-sm-4">
                                    {!! Form::text('APIUsername', old('APIUsername') ? old('APIUsername') : $oldPayPal, ['class' => 'form-control']) !!}
                                    @include('dashboard::partials.error', ['field' => 'APIUsername'])
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('APIPassword') ? ' has-error' : '' }}">
                                <label for="admin-paypal" class="col-sm-2 control-label">API Password</label>
                                <div class="col-sm-4">
                                    {!! Form::text('APIPassword', old('APIPassword') ? old('APIPassword') : $oldPayPal, ['class' => 'form-control']) !!}
                                    @include('dashboard::partials.error', ['field' => 'APIPassword'])
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('APISignature') ? ' has-error' : '' }}">
                                <label for="admin-paypal" class="col-sm-2 control-label">API Signature</label>
                                <div class="col-sm-4">
                                    {!! Form::text('APISignature', old('APISignature') ? old('APISignature') : $oldPayPal, ['class' => 'form-control', 'type' => 'password']) !!}
                                    @include('dashboard::partials.error', ['field' => 'APISignature'])
                                </div>
                            </div>
                            <div class="buttons">
                                <input type="submit" class="btn btn-primary" value="Save changes" />
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="shipping">

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
