<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Http\Requests\PatientRequest;
use App\Http\Requests\PatientUpdateRequest;
use  App\Models\single_invoice;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //
    public function index()
    {
       $patients=Patient::all();
       return view('dashboard.patients.index',compact('patients'));

    
    }
    public function show($id)
    {
      $Patient=Patient::findorfail($id);
      $invoices=single_invoice::where("patient_id",'=',$id)->get();
      $receipt_accounts=ReceiptAccount::where("patient_id",'=',$id)->get();
       $Patient_accounts = PatientAccount::orWhereNotNull('single_invoice_id')
            ->orWhereNotNull('receipt_id')
            ->orWhereNotNull('Payment_id')
            ->where('patient_id', $id)
            ->get();
           // return   $Patient_accounts;
        return view('dashboard.patients.show', compact('Patient', 'invoices', 'receipt_accounts', 'Patient_accounts'));
        
    }
    public function create(Request $request)
    {
         return view('dashboard.patients.create');
        
    }


    public function store(PatientRequest $request)
    {
        $data=$request->validated();
        $data['Password']=Hash::make($data['Password']);
        Patient::create($data);
        return redirect()->route('patients.index')->with('add',"add suc");
    }


    public function edit(Request $request,$id)
    {
         $Patient=Patient::find($id);
          return view('dashboard.patients.edit',compact('Patient'));

    }
    public function update( PatientUpdateRequest $request,$id)
    {
       $data=$request->validated();
         $Patient=Patient::find($id);
         print_r($Patient);
        // if($data['Password']){
        //   $data['Password']=Hash::make($data['Password']);
        // }
       $Patient->update($data);

       
       
        return redirect()->route('patients.index')->with('add',"add suc");
        
    } 

    public function destroy(Request $request,$id)
    {
      $Patient=Patient::find($id);
      $Patient->delete();
      return redirect()->route('patients.index');
        
    }
}
