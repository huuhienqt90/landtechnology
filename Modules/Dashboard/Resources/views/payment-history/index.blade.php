@extends('dashboard::layouts.list')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List all payment histories</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(isset($histories) && $histories->count() )
                        <table id="list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="20">ID</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($histories as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        @foreach($order->user_metas as $item)
                                            @if($item->key == 'billingFirstName')
                                                <td>{{ $item->value }}</td>
                                            @endif
                                        @endforeach
                                        <td>{{ $order->status }}</td>
                                        <td style="text-align: center;">
                                            <form method="post" action="{{ route('dashboard.payment-history.destroy', $order->id) }}">
                                                {{ method_field('DELETE') }}
                                                <div class="form-group">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="btn-group">
                                                        <a class="btn btn-info btn-flat" href="{{ route('dashboard.payment-history.edit', $order->id) }}"><i class="fa fa-pencil-square-o"></i></a>
                                                        <button type="submit" class="btn btn-danger btn-delete-item btn-flat" onclick="return confirm('Are you sure to delete this item?');"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="20">ID</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                        @else
                        <h3>Payment histories not found</h3>
                        @endif
                    </div>
                    <!-- /.box-body -->
                  </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
