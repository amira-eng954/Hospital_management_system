<?php

namespace App\Http\Controllers\Dashboard_Laboratorie_Employee;
use App\Models\Laboratorie;
use App\Http\Controllers\Controller;
use App\Services\Upload;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $invoices= Laboratorie::where('case',0)->get();
      // return  $invoices;
         return view("dashboard.dashboard_laboratorie_employee.invoices.index",compact("invoices"));


    }

    public function comboleted()
    {
       $invoices= Laboratorie::where('case',1)->get();
      // return  $invoices;
         return view("dashboard.dashboard_laboratorie_employee.invoices.comboleted",compact("invoices"));


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
        //
    }

    /**
     * Display the specified resource.
     */
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $invoice=Laboratorie::findorFail($id);
        return view("dashboard.dashboard_laboratorie_employee.invoices.edit",compact("invoice"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
         $invoice=Laboratorie::findorFail($id);
         $invoice->update([
            'employee_id'=>auth()->user()->id,
             'description_employee'=> $request->description_employee,
            'case'=> 1,
         ]);
         if($request->hasFile('photo'))
         {
            foreach ($request->file('photo') as $img) {
               (new Upload())->upload($img,'laboratory',$invoice);
            }
            
         }

         return  redirect()->back();


          

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function view_laboratories($id)
    {
          $laboratorie=Laboratorie::findorFail($id);
        
         return view("dashboard.dashboard_laboratorie_employee.invoices.patient_details",compact("laboratorie"));
    }
}
