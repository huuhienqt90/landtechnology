@extends('dashboard::layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Create commission</h3>
                    </div>
                    {!! Form::model($commission, ['route' => ['dashboard.commission.store'], 'class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('category_id') ? ' has-error' : ''}}">
                           <label for="category_id" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-4">
                                <select class="form-control select2" name="category_id">
                                    <option value="">Please select a category</option>
                                    @foreach($categories as $category)
                                        @if( $category->getChildren()->count() )
                                            <optgroup label="{{ $category->name }}">
                                                @foreach($category->getChildren() as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                                @include('dashboard::partials.error', ['field' => 'category'])
                            </div>
                        </div>
                        @include('dashboard::partials.select', ['field' => 'type', 'label' => 'Type', 'options' => setTypeCommission()])
                        @include('dashboard::partials.input', ['field' => 'cost', 'label' => 'Cost', 'options' => ['class' => 'form-control']])
                        @include('dashboard::partials.input', ['field' => 'maximum', 'label' => 'Maximum', 'options' => ['class' => 'form-control', 'placeholder' => 0]])
                        @include('dashboard::partials.select', ['field' => 'product_type', 'label' => 'Product Type', 'options' => setProductTypeCommission()])
                        <div class="buttons">
                            <input type="submit" class="btn btn-primary" value="Save changes" />
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@stop