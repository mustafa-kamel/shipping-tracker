<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courier;

class CourierController extends Controller
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
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'number' => 'required|string|max:255'
        ]);
        Courier::create($request->all());
        return redirect()->route('couriers.index')->with('success', 'Courier added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Courier $courier
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
     * @param  App\Models\Courier $courier
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
     * @param  App\Models\Courier $courier
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Courier $courier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'number' => 'required|string|max:255'
        ]);
        $courier->update($request->all());
        return redirect()->route('couriers.index')->with('success', 'Courier updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Courier  $courier
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Courier $courier)
    {
        $courier->delete();
        return redirect()->route('couriers.index')->with('success', 'Courier deleted!');
    }
}
