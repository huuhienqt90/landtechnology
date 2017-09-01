@extends('dashboard::layouts.list')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List all products</h3>
                        <div class="pull-right box-tools">
                            <a href="{{ route('dashboard.product.create') }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="" data-original-title="Create">
                              <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(isset($products) && $products->count() )
                        <table id="list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="80">Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Slug</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        @if($product->feature_image)
                                            <td class="list-image"><img class="img-responsive" style="max-height:100px" src="{{ asset('storage/'.$product->feature_image) }}"/></td>
                                        @else
                                            <td class="list-image"><img class="img-responsive" style="max-height:100px" src="{{ asset('themes/dashboard/dist/img/boxed-bg.jpg') }}"/></td>
                                        @endif
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->original_price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->slug }}</td>
                                        <td style="text-align: center;">
                                                <form method="post" action="{{ route('dashboard.product.destroy', $product->id) }}">
                                                    {{ method_field('DELETE') }}
                                                    <div class="form-group">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="btn-group">
                                                        <a class="btn btn-info btn-flat" href="{{ route('dashboard.product.edit', $product->id) }}"><i class="fa fa-pencil-square-o"></i></a>
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
                                    <th width="80">Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Slug</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                        @else
                        <h3>Product not found</h3>
                        @endif
                    </div>
                    <!-- /.box-body -->
                  </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
