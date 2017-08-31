@extends('dashboard::layouts.list')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List all categories</h3>
                        <div class="pull-right box-tools">
                            <a href="{{ route('dashboard.category.create') }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="" data-original-title="Create">
                              <i class="fa fa-plus"></i></a>
                          </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(isset($categories) && $categories->count() )
                        <table id="list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        @if($category->image)
                                            <td>Image</td>
                                        @else
                                            <td>Image</td>
                                        @endif
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->showParent() }}</td>
                                        <td style="text-align: center;">
                                            <div class="btn-group">
                                                <a class="btn btn-info btn-flat" href="{{ route('dashboard.category.edit', $category->id) }}"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{ route('dashboard.category.destroy', $category->id) }}" class="btn btn-danger btn-delete-item btn-flat" data-confirm="Are you sure to delete this item?"><i class="fa fa-times"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                        @else
                        <h3>Category not found</h3>
                        @endif
                    </div>
                    <!-- /.box-body -->
                  </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
