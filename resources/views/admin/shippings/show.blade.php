@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Shipping {{ $shipping->id }}</div>
                <div class="card-body">

                    <a href="{{ url('/admin/shippings') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                                class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/admin/shippings/' . $shipping->id . '/edit') }}" title="Edit Shipping"><button
                            class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Edit</button></a>

                    <form method="POST" action="{{ url('admin/shippings' . '/' . $shipping->id) }}"
                        accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Shipping"
                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                aria-hidden="true"></i> Delete</button>
                    </form>
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $shipping->id }}</td>
                                </tr>
                                <tr>
                                    <th> Shipment Number </th>
                                    <td> {{ $shipping->shipment_number }} </td>
                                </tr>
                                <tr>
                                    <th> Description </th>
                                    <td> {{ $shipping->description }} </td>
                                </tr>
                                <tr>
                                    <th> Status </th>
                                    <td> {{ config('enums.ship_status_enum')[$shipping->status] }} </td>
                                </tr>
                                <tr>
                                    <th> Courier </th>
                                    <td> {{ $shipping->courier->name }} </td>
                                </tr>
                                <tr>
                                    <th> Address </th>
                                    <td> {{ $shipping->address }} </td>
                                </tr>
                                <tr>
                                    <th> Created at </th>
                                    <td> {{ $shipping->created_at }} </td>
                                </tr>
                                <tr>
                                    <th> Updated at </th>
                                    <td> {{ $shipping->updated_at }} </td>
                                </tr>
                                <tr>
                                    <th> Products </th>
                                    @forelse ($shipping->products as $item)
                                    <td> {{ $item->name }} : {{ $item->pivot->count }} </td>
                                    @empty
                                    <td></td>
                                    @endforelse
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection