@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <h2>Welcome to shipping tracker</h2>
                    @guest
                    <h3>Track your shipment</h3>
                    <form method="GET" action="{{ route('shippings.track') }}" accept-charset="UTF-8"
                        class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="shipment_number"
                                placeholder="shipment_number...">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    @endguest
                    @auth
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item mx-3">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('products.index') }}">Products</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('couriers.index') }}">Couriers</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('shippings.index') }}">Shippings</a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection