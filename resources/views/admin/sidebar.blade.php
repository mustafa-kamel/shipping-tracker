<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>

        <div class="card-body">
            <ul class="nav flex-column" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('products.index') }}">
                        Products
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('couriers.index') }}">
                        Couriers
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('shippings.index') }}">
                        Shippings
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>