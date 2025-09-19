<?php

namespace App\Http\Controllers\Doctor;
use  App\Models\single_invoice;
 use  App\Models\Ray;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // قايمه الكشوفات تحت الاجراء
    public function index()
    {
        $invoices=single_invoice::where("doctor_id",'=',auth()->user()->id)->where('invoice_status',1)->get();
        return view("dashboard.Doctor.Invoices.index",compact("invoices"));

        
    }
// قايمه الكشوفات  المراجعه
    public function reviewInvoices()
    {
         $invoices=single_invoice::where("doctor_id",'=',auth()->user()->id)->where('invoice_status',2)->get();
        return view("dashboard.Doctor.Invoices.review_invoices",compact("invoices"));


    }

// قايمه الكشوفات المكتمله
    public function completedInvoices()
    {

         $invoices=single_invoice::where("doctor_id",'=',auth()->user()->id)->where('invoice_status',3)->get();
        return view("dashboard.Doctor.Invoices.completed_invoices",compact("invoices"));

       
    }

    
    public function show($id)
    {
        
         $rays = Ray::findorFail($id);
         //return $rays;
        
            
         if($rays->doctor_id !=auth()->user()->id){
            //abort(404);
        
            return redirect()->route('404');
        }
         //$rays->image();
        return view('dashboard.Doctor.Invoices.view_rays', compact('rays'));
    }

     public function create(Request $request)
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
