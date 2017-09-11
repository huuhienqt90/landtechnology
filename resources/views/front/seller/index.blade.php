@extends('layouts.front.master-dashboard')

@section('meta')
    <title>Dashboard - Land Technology</title>
    @include('social::meta-article', [
        'title'         => 'Login',
        'description'   => 'Welcome from Hello World',
        'image'         => 'http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg',
        'author'        => 'Set Kyar Wa Lar'
    ])
@stop

@section('content-dashboard')
    <h3 style="visibility: hidden;">Edit My Account</h3>
    @if(Session::has('msgOk'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Well done!</strong> {{ Session::get('msgOk') }}
        </div>
    @endif
    @if(Session::has('msgEr'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> {{ Session::get('msgEr') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">List items sell</h3>
        </div>
        <div class="panel-body">
            <div class="main-content full-width inner-page">
                <div class="background">
                    <div class="pattern">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-8">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Image</th> 
                                                <th>Name</th> 
                                                <th>Price</th> 
                                                <th>Stock</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr> 
                                        </thead> 
                                        @if( ($products->count() > 0) && ($products != null) )
                                        <tbody>
                                            @foreach($products as $product)
                                            <tr> 
                                                <td class="list-image"><img class="img-responsive" style="max-height:100px" src="{{ asset('storage/'.$product->feature_image) }}"/></td></th> 
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->original_price }}</td> 
                                                <td>{{ $product->stock }}</td>
                                                <td>{{ $product->status }}</td>
                                                <td>
                                                    <form method="post" action="{{ route('seller.destroy', $product->id) }}">
                                                        {{ method_field('DELETE') }}
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <div class="btn-group">
                                                            <a class="btn btn-info btn-flat" href="{{ route('seller.edit', $product->id) }}"><i class="fa fa-pencil-square-o"></i></a>
                                                            <button type="submit" class="btn btn-danger btn-delete-item btn-flat" data-confirm="Are you sure to delete this item?"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody> 
                                        @else
                                        <tbody>
                                            <tr>
                                                <td colspan="6"><h2>Product not found</h2></td>
                                            </tr>
                                        </tbody>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop