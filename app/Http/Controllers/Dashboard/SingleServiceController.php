<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class SingleServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services=Service::all();
        return view("dashboard.services.single_service.index",compact("services"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $services=$request->validate([
        'name'=>"required|string",
          'price'=>"required",
            'des'=>"required|string",
       ]);
       Service::create($services);
       return redirect()->route("services.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $service=Service::find($id);
       $services=$request->validate([
        'name'=>"required|string",
          'price'=>"required",
            'des'=>"required|string",
       ]);
       $service->update($services);
        return redirect()->route("services.index");
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id ,Request $request)
    {
        //

        $service=Service::find($request->id);
        $service->delete();
         return redirect()->route("services.index");
    }
}
