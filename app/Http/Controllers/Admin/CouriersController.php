<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courier;

class CouriersController extends Controller
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
            $couriers = Courier::where('name', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('number', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $couriers = Courier::latest()->paginate($perPage);
        }

        return view('admin.couriers.index', compact('couriers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.couriers.create');
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
        $request->validate([
            'name' => 'required|string',
            'address' => 'nullable|string',
            'number' => 'required|string'
        ]);
        Courier::create($request->all());
        return redirect('admin/couriers')->with('flash_message', 'Courier added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Courier $courier
     *
     * @return \Illuminate\View\View
     */
    public function show(Courier $courier)
    {
        return view('admin.couriers.show', compact('courier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Courier $courier
     *
     * @return \Illuminate\View\View
     */
    public function edit(Courier $courier)
    {
        return view('admin.couriers.edit', compact('courier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  Courier $courier
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Courier $courier)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'nullable|string',
            'number' => 'required|string'
        ]);
        $courier->update($request->all());
        return redirect('admin/couriers')->with('flash_message', 'Courier updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Courier  $courier
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Courier $courier)
    {
        $courier->delete();

        return redirect('admin/couriers')->with('flash_message', 'Courier deleted!');
    }
}
