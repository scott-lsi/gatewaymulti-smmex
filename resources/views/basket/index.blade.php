@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Basket</h1>
    
    <hr>
    
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <hr>
    @endif
    
    <div class="row">
        <div class="col-md-9">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-xs-3">Image</th>
                        <th class="col-xs-9">Product Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($basket as $row)
                    <tr>
                        <td><img src="{{ $row->options->imageurl }}" alt="{{ $row->name }}" class="img-responsive"></td>
                        <td>
                            <p>{{ $row->name }}</p>
                            
                            @if($row->options->textinputs)
                            <p>
                            <strong>Text to be printed</strong><br>
                            @foreach($row->options->textinputs as $textinput)
                            {{ $textinput }}<br>
                            @endforeach
                            </p>
                            @endif
                            
                            {!! Form::open(['action' => ['CartController@postUpdateQty', $row->rowId]]) !!}
                            <div class="row">
                                <div class="col-xs-6">
                                    {!! Form::hidden('productId', $row->id) !!}
                                    {!! Form::number('qty', $row->qty, ['class' => 'input-sm form-control']) !!}
                                </div>
                                <div class="col-xs-6">
                                    {!! Form::submit('Update Qty', ['class' => 'btn btn-primary btn-sm']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                            
                            <p><small><a href="{{ action('CartController@getRemoveItem', ['rowId' => $row->rowId]) }}">Remove</a></small></p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="col-md-3">
            @if($basket->count() >= 1)
            <div class="panel panel-primary">
                <div class="panel-heading">Just a few details&hellip;</div>
                <div class="panel-body">
                    {!! Form::open(['action' => 'CartController@postToPrint']) !!}
                        <div class="form-group">
                            <label for="name">Recipient Name *</label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                        </div>
                    
                        <div class="form-group">
                            <label for="name">Recipient Company *</label>
                            {!! Form::text('company', null, ['class' => 'form-control', 'id' => 'company']) !!}
                        </div>

                        <div class="form-group">
                            <label for="email">Recipient Email Address *</label>
                            {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                        </div>

                        <hr>

                        {!! Form::submit('Place Order', ['class' => 'btn btn-block btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            @endif
        </div>
    </div>
    
</div>

@endsection
