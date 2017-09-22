@extends('dashboard::layouts.list')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List all order</h3>
                        <div class="pull-right box-tools">
                            <a href="{{ route('dashboard.order.create') }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="" data-original-title="Create">
                              <i class="fa fa-plus"></i></a>
                          </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(isset($orders) && $orders->count() )
                        <table id="list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="20">ID</th>
                                    <th>Status</th>
                                    <th>Order</th>
                                    <th>Ship to</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="list-image">#{{ $order->id }}</td>
                                        <td>{{ $order->status }}</td>
                                        @foreach($order->user_metas as $item)
                                            @if($item->key == 'shippingFirstName')
                                                <td>{{ $item->value }}</td>
                                            @endif
                                        @endforeach
                                        @foreach($order->user_metas as $item)
                                            @if($item->key == 'shippingAddress1')
                                                <td>{{ $item->value }}</td>
                                            @endif
                                        @endforeach
                                        <td>{{ $order->created_at }}</td>
                                        <td>${{ $order->total }}</td>
                                        <td style="text-align: center;">
                                                <form method="post" action="{{ route('dashboard.order.destroy', $order->id) }}">
                                                    {{ method_field('DELETE') }}
                                                    <div class="form-group">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="btn-group">
                                                        <a class="btn btn-info btn-flat" href="{{ route('dashboard.order.edit', $order->id) }}"><i class="fa fa-pencil-square-o"></i></a>
                                                        <button type="submit" class="btn btn-danger btn-delete-item btn-flat" data-confirm="Are you sure to delete this item?"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="20">ID</th>
                                    <th>Status</th>
                                    <th>Order</th>
                                    <th>Ship to</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                        @else
                        <h3>Order not found</h3>
                        @endif
                    </div>
                    <!-- /.box-body -->
                  </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop