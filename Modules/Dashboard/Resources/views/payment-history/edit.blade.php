@extends('dashboard::layouts.list')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Condensed Full Width Table</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tr>
                                <th style="width: 10px">#ID</th>
                                <th>Seller</th>
                                <th>Price Payment</th>
                                <th>Fee</th>
                                <th>Price After Fee</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th style="width: 100px">Action</th>
                            </tr>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->user->getFullName() }}</td>
                                <td>{{ $payment->original_price }}$</td>
                                <td>{{ $payment->price_fee }}$</td>
                                <td>{{ $payment->price_after_fee }}$</td>
                                <td>{{ $payment->note }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>
                                    <a class="btn btn-info btn-flat" href="{{ route('dashboard.paid', $payment->id) }}" onclick="return confirm('Are you sure paid?');"><i class="fa fa-location-arrow" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop