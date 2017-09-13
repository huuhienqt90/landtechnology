@extends('dashboard::layouts.master')
<link rel="stylesheet" href="{{ asset('themes/dashboard/bower_components/select2/dist/css/select2.min.css') }}">
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
        {!! Form::model($order, ['route' => ['dashboard.order.update', $order->id], 'class' => 'form-horizontal', 'files' => true, 'method' => 'PUT']) !!}
            <div class="col-lg-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">General Details</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('order_date') ? ' has-error' : ''}}">
                            <label for="order_date" class="col-sm-2 control-label">Order date:</label>
                            <div class="col-sm-4">
                                {!! Form::date('order_date', $order->created_at, ['class' => 'form-control']) !!}
                                @include('dashboard::partials.error', ['field' => 'order_date'])
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('order_status') ? ' has-error' : ''}}">
                            <label for="order_status" class="col-sm-2 control-label">Order status:</label>
                            <div class="col-sm-4">
                                {!! Form::select('order_status', setOrderStatus(), $order->status, ['class' => 'form-control']) !!}
                                @include('dashboard::partials.error', ['field' => 'order_status'])
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('customer_user') ? ' has-error' : ''}}">
                           <label for="customer_user" class="col-sm-2 control-label">Customer</label>
                           <div class="col-sm-4">
                                {!! Form::select('customer_user', $arUser, Form::getValueAttribute('customer_user'), ['class' => 'form-control select2', 'data-placeholder' => 'Guest']) !!}
                                @include('dashboard::partials.error', ['field' => 'customer_user'])
                            </div>
                        </div>
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Billing Details</h3>
                    </div>
                    <div class="box-body">
                        @foreach($orderMetas as $orderMeta)
                            @if($orderMeta->key == 'billingFirstName')
                                <div class="form-group {{ $errors->has('billingFirstName') ? ' has-error' : '' }}">
                                    <label for="billingFirstName" class="col-sm-2 control-label">First name</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('billingFirstName', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'billingFirstName'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'billingLastName')
                                <div class="form-group {{ $errors->has('billingLastName') ? ' has-error' : '' }}">
                                    <label for="billingLastName" class="col-sm-2 control-label">Last name</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('billingLastName', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'billingLastName'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'billingCompany')
                                <div class="form-group {{ $errors->has('billingCompany') ? ' has-error' : '' }}">
                                    <label for="billingCompany" class="col-sm-2 control-label">Company</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('billingCompany', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'billingCompany'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'billingAddress1')
                                <div class="form-group {{ $errors->has('billingAddress1') ? ' has-error' : '' }}">
                                    <label for="billingAddress1" class="col-sm-2 control-label">Address 1</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('billingAddress1', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'billingAddress1'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'billingAddress2')
                                <div class="form-group {{ $errors->has('billingAddress2') ? ' has-error' : '' }}">
                                    <label for="billingAddress2" class="col-sm-2 control-label">Address 2</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('billingAddress2', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'billingAddress2'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'billingPostCode')
                                <div class="form-group {{ $errors->has('billingPostCode') ? ' has-error' : '' }}">
                                    <label for="billingPostCode" class="col-sm-2 control-label">Postcode / ZIP</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('billingPostCode', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'billingPostCode'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'billingCity')
                                <div class="form-group {{ $errors->has('billingCity') ? ' has-error' : '' }}">
                                    <label for="billingCity" class="col-sm-2 control-label">Town / City</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('billingCity', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'billingCity'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'billingPhone')
                                <div class="form-group {{ $errors->has('billingPhone') ? ' has-error' : '' }}">
                                    <label for="billingPhone" class="col-sm-2 control-label">Phone</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('billingPhone', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'billingPhone'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'billingEmail')
                                <div class="form-group {{ $errors->has('billingEmail') ? ' has-error' : '' }}">
                                    <label for="billingEmail" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('billingEmail', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'billingEmail'])
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="box-header with-border">
                        <h3 class="box-title">Shipping Details</h3>
                    </div>
                    <div class="box-body">
                        @foreach($orderMetas as $orderMeta)
                            @if($orderMeta->key == 'shippingFirstName')
                                <div class="form-group {{ $errors->has('shippingFirstName') ? ' has-error' : '' }}">
                                    <label for="shippingFirstName" class="col-sm-2 control-label">First name</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('shippingFirstName', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'shippingFirstName'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'shippingLastName')
                                <div class="form-group {{ $errors->has('shippingLastName') ? ' has-error' : '' }}">
                                    <label for="shippingLastName" class="col-sm-2 control-label">Last name</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('shippingLastName', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'shippingLastName'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'shippingCompany')
                                <div class="form-group {{ $errors->has('shippingCompany') ? ' has-error' : '' }}">
                                    <label for="shippingCompany" class="col-sm-2 control-label">Company</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('shippingCompany', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'shippingCompany'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'shippingAddress1')
                                <div class="form-group {{ $errors->has('shippingAddress1') ? ' has-error' : '' }}">
                                    <label for="shippingAddress1" class="col-sm-2 control-label">Address 1</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('shippingAddress1', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'shippingAddress1'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'shippingAddress2')
                                <div class="form-group {{ $errors->has('shippingAddress2') ? ' has-error' : '' }}">
                                    <label for="shippingAddress2" class="col-sm-2 control-label">Address 2</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('shippingAddress2', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'shippingAddress2'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'shippingPostCode')
                                <div class="form-group {{ $errors->has('shippingPostCode') ? ' has-error' : '' }}">
                                    <label for="shippingPostCode" class="col-sm-2 control-label">Postcode / ZIP</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('shippingPostCode', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'shippingPostCode'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'shippingCity')
                                <div class="form-group {{ $errors->has('shippingCity') ? ' has-error' : '' }}">
                                    <label for="shippingCity" class="col-sm-2 control-label">Town / City</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('shippingCity', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'shippingCity'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'shippingPhone')
                                <div class="form-group {{ $errors->has('shippingPhone') ? ' has-error' : '' }}">
                                    <label for="shippingPhone" class="col-sm-2 control-label">Phone</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('shippingPhone', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'shippingPhone'])
                                    </div>
                                </div>
                            @endif
                            @if($orderMeta->key == 'shippingEmail')
                                <div class="form-group {{ $errors->has('shippingEmail') ? ' has-error' : '' }}">
                                    <label for="shippingEmail" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('shippingEmail', $orderMeta->value, ['class' => 'form-control', 'id' => 'first_name']) !!}
                                        @include('dashboard::partials.error', ['field' => 'shippingEmail'])
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order Actions</h3>
                    </div>
                    <div class="box-body">
                        <div class="buttons">
                            <input type="submit" class="btn btn-primary" value="Save changes" />
                        </div>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order notes</h3>
                    </div>
                    <div class="box-body">
                        <ul class="timeline" id="order_note">
                        </ul>
                        <label class="form-label">Add note</label>
                        <textarea class="form-control" id="contentOrderNote"></textarea>
                        <br>
                        <a href="javascript:void(0)" class="btn btn-default pull-right" id="addOrderNote">Add</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="box box-primary">
                    <div class="box-body">
                        <table class="table table-condensed" id="rowProduct">
                        </table>
                        <!-- <div class="box-footer clearfix">
                            <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Add item(s)</a>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                
            </div>
            {!! Form::close() !!}
        </div>
    </section>
    <!-- /.content -->
    <script src="{{ asset('themes/dashboard/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('select[name="customer_user"]').select2({
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route("dashboard.getcustomer") }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        console.log(data);
                        return {
                          results: data
                        };
                    },
                    cache: true
                }
            }).on('change', function(){
                var id = $(this).val();
                $.ajax({
                    url: "{{ route('dashboard.getcustomerbyid') }}",
                    type: "get",
                    data: {id : id},
                    success: function(result) {
                        console.log(result);
                        $("#first_name").val(result.first_name);
                        $("#last_name").val(result.last_name);
                        $("#address1").val(result.address1);
                        $("#address2").val(result.address2);
                        $("#post_code").val(result.postal_code);
                        $("#city").val(result.country);
                        $("#email").val(result.email);
                    }
                });
            });


        });
    </script>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Default Modal</h4>
                </div>
                <div class="modal-body">
                    <!-- Horizontal Form -->
                        <!-- form start -->
                        <form class="form-horizontal">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="name_product" class="col-sm-2 control-label">Product</label>
                              <div class="col-sm-10">
                                {!! Form::select('product_name', [], Form::getValueAttribute('product'), ['class' => 'form-control select2', 'data-placeholder' => 'Search for a product...']) !!}
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="cost" class="col-sm-2 control-label">Cost</label>
                              <div class="col-sm-10">
                                <input type="number" class="form-control" readonly name="cost" id="cost" placeholder="0">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="qty" class="col-sm-2 control-label">Qty</label>
                              <div class="col-sm-10">
                                <input type="number" class="form-control" min="0" name="qty" id="qty" placeholder="0">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="total" class="col-sm-2 control-label">Total</label>
                              <div class="col-sm-10">
                                <input type="number" class="form-control" min="0" readonly name="total" id="total" placeholder="0">
                              </div>
                            </div>
                          </div>
                          <!-- /.box-body -->
                        </form>
                      <!-- /.box -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-primary" data-dismiss="modal" id="addProduct">Add product</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('select[name="product_name"]').select2({
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route("dashboard.getproduct") }}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        console.log(data);
                        return {
                          results: data
                        };
                    },
                    cache: true
                }
            }).on('change', function(){
                var id = $(this).val();
                $.ajax({
                    url: "{{ route('dashboard.getproductid') }}",
                    type: "get",
                    data: {id : id},
                    success: function(result) {
                        console.log(result);
                        $("#cost").val(result);
                    }
                });
            });

            $("#qty").keyup(function() {
                var cost = $("#cost").val();
                var total = cost * $(this).val();
                $("#total").val(total);
            });

            $("#rowProduct").append('<tr><th>Item</th><th>Cost</th><th>Qty</th><th>Total</th><th></th></tr>');
            @foreach($order_products as $order_product)
                $("#rowProduct").append('<tr><td>{{ $order_product->product_id }}</td><td>{{ $order_product->price }}</td><td>{{ $order_product->qty }}</td><td>{{ $order_product->total }}</td><td></td></tr>');
            @endforeach
            $("#addProduct").on('click', function() {
                if( !$("#total"+$("select[name=product_name]").val()).length ) {
                    $("#rowProduct").append('<tr><td>'+$("select[name=product_name]").val()+'<input type="hidden" name="product_id[]" value="'+$("select[name=product_name]").val()+'" /></td><td>'+$("#cost").val()+'<input type="hidden" name="price" value="'+$("#cost").val()+'" /></td><td><input type="number" name="qtyShow['+$("select[name=product_name]").val()+']" min="0" value="'+$("#qty").val()+'" class="pr-item-qty" /></td><td><span class="total">'+$("#total").val()+'</span><input type="hidden" name="totalShow" id="total'+$("select[name=product_name]").val()+'" value="'+$("#total").val()+'" /></td><td style="width: 150px"><a href="#" class="btn btn-danger delRow"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td></tr>');
                }
                $("select[name=product_name]").val(0);
                $("#cost").val(0);
                $("#qty").val(0);
                $("#total").val(0);
                $('.delRow').on('click', function(e) {
                    e.preventDefault();
                    $(this).closest('tr').remove();
                });
            });

            $('#rowProduct').on('change', '.pr-item-qty', function(){
                var parent = $(this).parent().parent();
                var price = parent.find('input[name="price"]').val();
                parent.find('input[name="totalShow"]').val($(this).val() * price);
                parent.find('.total').text($(this).val() * price);
            });

            // Add Order Note
            var d = new Date();
            var strDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();
            var time = d.getHours() + ":" + d.getMinutes();

            $("#addOrderNote").on('click', function() {
                if( $("#contentOrderNote").val() ){
                    $("#order_note").append('<li class="time-label"><span class="bg-green">'+strDate+'</span><input type="hidden" name="dateOrder[]" value="'+strDate+'"/></li><li><i class="fa fa-comments bg-yellow"></i><div class="timeline-item"><span class="time"><i class="fa fa-clock-o"></i> '+time+'</span><input type="hidden" name="timeOrder[]" value="'+time+'"/><h3 class="timeline-header">{{ Auth::user()->username }}<input type="hidden" name="nameOrder" value="{{ Auth::user()->username }}"/></h3><div class="timeline-body">'+$("#contentOrderNote").val()+'<input type="hidden" name="contentOrder[]" value="'+$("#contentOrderNote").val()+'"/></div><div class="timeline-footer"><a class="btn btn-danger btn-xs btn-delNote" href="javascript:void(0)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></div></li>');
                }
                $("#contentOrderNote").val('');

                $(".btn-delNote").on('click', function() {
                    var parent = $(this).parent().parent();
                    parent.closest('li').prev().remove();
                    parent.closest('li').remove();
                });
            });
        });
    </script>
@stop