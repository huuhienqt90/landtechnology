@extends('dashboard::layouts.list')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List all countries</h3>
                        <div class="pull-right box-tools">
                            <a href="{{ route('dashboard.country.create') }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="" data-original-title="Create">
                              <i class="fa fa-plus"></i></a>
                          </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(isset($countries) && $countries->count() )
                        <table id="list" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="80">#ID</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($countries as $country)
                                    <tr>
                                        <td>#{{ $country->id }}</td>
                                        <td>{{ $country->code }}</td>
                                        <td>{{ $country->name }}</td>
                                        <td style="text-align: center;">
                                            <form method="post" action="{{ route('dashboard.country.destroy', $country->id) }}">
                                                {{ method_field('DELETE') }}
                                                <div class="form-group">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="btn-group">
                                                        <a class="btn btn-info btn-flat" href="{{ route('dashboard.country.edit', $country->id) }}"><i class="fa fa-pencil-square-o"></i></a>
                                                        <button type="submit" class="btn btn-danger btn-delete-item btn-flat" data-confirm="Are you sure to delete this item?"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th width="80">#ID</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                        @else
                        <h3>Country not found</h3>
                        @endif
                    </div>
                    <!-- /.box-body -->
                  </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
