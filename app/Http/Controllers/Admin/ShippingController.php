<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;

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
                ->orWhere('courier_id', 'LIKE', "%$keyword%")
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
            'shipment_number' => 'required|unique|min:10|max:10',
            'description' => 'text',
            'address' => 'string',
            'courier_id' => 'exists:couriers,id'
        ]);
        $requestData = $request->all();

        Shipping::create($requestData);

        return redirect('admin/shippings')->with('flash_message', 'Shipping added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $shipping = Shipping::findOrFail($id);

        return view('admin.shippings.show', compact('shipping'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $shipping = Shipping::findOrFail($id);

        return view('admin.shippings.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'shipment_number' => 'required|unique|min:10|max:10',
            'description' => 'text',
            'address' => 'string',
            'courier_id' => 'exists:couriers,id'
        ]);
        $requestData = $request->all();

        $shipping = Shipping::findOrFail($id);
        $shipping->update($requestData);

        return redirect('admin/shippings')->with('flash_message', 'Shipping updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Shipping::destroy($id);

        return redirect('admin/shippings')->with('flash_message', 'Shipping deleted!');
    }
}
