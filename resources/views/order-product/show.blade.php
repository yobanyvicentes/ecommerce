@extends('layouts.app')

@section('template_title')
    {{ $orderProduct->name ?? 'Show Order Product' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Order Product</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('order-products.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Order Id:</strong>
                            {{ $orderProduct->order_id }}
                        </div>
                        <div class="form-group">
                            <strong>Product Id:</strong>
                            {{ $orderProduct->product_id }}
                        </div>
                        <div class="form-group">
                            <strong>Quantity:</strong>
                            {{ $orderProduct->quantity }}
                        </div>
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $orderProduct->price }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
