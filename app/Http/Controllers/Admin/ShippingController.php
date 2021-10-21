<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Shipping;
use Illuminate\Support\Str;


class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;
        if (!empty($keyword)) {
            $shippings = Shipping::where('description', 'LIKE', "%$keyword%")
                ->orWhere('shipment_number', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $shippings = Shipping::latest()->paginate($perPage);
        }
        return view('admin.shippings.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.shippings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'shipment_number' => 'nullable|min:10|max:10|unique:shippings,shipment_number',
            'description' => 'required|string|max:1000',
            'status' => [
                'required',
                'string',
                Rule::in(array_keys(config('enums.ship_status_enum')))
            ],
            'address' => 'required|string|max:255',
            'courier_id' => 'required|exists:App\Models\courier,id',
            'products' => 'nullable|array'
        ]);
        if (is_null($request->shipment_number)) {
            $request->merge(['shipment_number' => Str::random(10)]);
        }
        $shipping = Shipping::create($request->all());
        $shipping->products()->sync($request->products);
        return redirect()->route('shippings.index')->with('success', 'Shipping added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Shipping $shipping
     *
     * @return \Illuminate\View\View
     */
    public function show(Shipping $shipping)
    {
        return view('admin.shippings.show', compact('shipping'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Shipping $shipping
     *
     * @return \Illuminate\View\View
     */
    public function edit(Shipping $shipping)
    {
        return view('admin.shippings.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  App\Models\Shipping $shipping
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Shipping $shipping)
    {
        $this->validate($request, [
            'shipment_number' => [
                'required',
                'min:10',
                'max:10',
                Rule::unique('shippings')->ignore($shipping->id)
            ],
            'description' => 'required|string|max:1000',
            'status' => [
                'required',
                'string',
                Rule::in(array_keys(config('enums.ship_status_enum')))
            ],
            'address' => 'required|string|max:255',
            'courier_id' => 'exists:App\Models\courier,id',
            'products' => 'nullable|array'
        ]);
        $shipping->update($request->all());
        $shipping->products()->sync($request->products);
        return redirect()->route('shippings.index')->with('success', 'Shipping updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Shipping $shipping
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        return redirect()->route('shippings.index')->with('success', 'Shipping deleted!');
    }
}
