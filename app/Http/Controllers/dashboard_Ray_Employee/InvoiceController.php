<?php

namespace App\Http\Controllers\dashboard_Ray_Employee;
use App\Models\Ray;
use App\Http\Controllers\Controller;
use App\Services\Upload;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    public function index()
    {
        $invoices=Ray::where('case',0)->get();
         return view("dashboard.dashboard_ray_employee.invoices.index",compact("invoices"));
    }

    public function store()
    {
        
    }
     public function completed_invoices()
    {
          $invoices=Ray::where('case',1)->get();
         return view("dashboard.dashboard_ray_employee.invoices.completed_invoices",compact("invoices"));
    }


    public function edit($id)
    {
        $invoice=Ray::find($id);
    
         return view("dashboard.dashboard_ray_employee.invoices.edit",compact("invoice"));
        
    }

    public function update(Request $request,$id)
    {
         $invoice=Ray::find($id);
         $invoice->update([
            'description_employee'=>$request->description_employee,
            'employee_id'=>auth()->user()->id,
            'case'=>1
         ]);
         if($request->hasFile('photo')){
            foreach($request->file('photo') as $photo)
            {
                (new Upload())->upload($photo,'rays',$invoice);
            }
         }
         //(new upload())->upload($request->file('photo'),'rays',auth()->user()->id);
            return redirect()->route('invoice.index');
        
    }

    public function delete($id)
    {
        
    }
}
