@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <h2>Welcome to shipping tracker</h2>
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