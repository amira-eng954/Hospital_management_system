<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\ReceiptAccount;
use App\Models\Patient;
use App\Models\FundAccount;
use App\Models\PatientAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptAccountController extends Controller
{
    public function index()
    {
        $receipts=ReceiptAccount::all();
      return view("dashboard.Receipt.index",compact("receipts"));

        
    }
    //

     public function create()
    {
         $Patients=Patient::all();
        return view("dashboard.Receipt.create",compact("Patients"));
    }

    public function store(Request $request)
    {//  تخزين فى جدول الحسابات 
        DB::beginTransaction();
        try{
      $ReceiptAccount=  ReceiptAccount::create([
            'date'=>date('y-m-d'),
            'patient_id'=>$request->patient_id,
            'Debit'=>$request->Debit,
            'description'=>$request->description
      ]);

       $ReceiptAccount->save();
      FundAccount::create([
        'receipt_id'=>$ReceiptAccount->id,
        'date'=>date('y-m-d'),
        'Debit'=> $ReceiptAccount->Debit,
        'credit'=>0.00
      ]);

      $PatientAccount= PatientAccount::create([
        'date'=>date('y-m-d'),
        'Debit'=>0.00,
        'credit'=>$ReceiptAccount->Debit,
         'patient_id'=>$request->patient_id,
        'receipt_id'=>$ReceiptAccount->id,
      ]);
      DB::commit();
     
      session()->flash('add',"تم تاكيد البيانات");
      return redirect()->route('Receipt.index');
        }
         catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);



    }

    }

    public function edit(Request $request,$id)
    {   $receipt_accounts= ReceiptAccount::find($id);
        $Patients =Patient::all();
        // $receipt_accounts
        return view("dashboard.Receipt.edit",compact("Patients","receipt_accounts"));


    }

     public function update(Request $request)
    {   
      DB::beginTransaction();
      try{
         $receipt_accounts= ReceiptAccount::find($request->id);
          $receipt_accounts->update([
            'date'=>date('y-m-d'),
            'patient_id'=>$request->patient_id,
            'Debit'=>$request->Debit,
            'description'=>$request->description
          ]);
          $receipt_accounts->save();

        $FundAccount=FundAccount::where('receipt_id','=',$request->id)->first();
        $FundAccount->update([
        'receipt_id'=>$request->id,
        'date'=>date('y-m-d'),
        'Debit'=> $receipt_accounts->Debit,
        'credit'=>0.00
      ]);

       $PatientAccount= PatientAccount::where('receipt_id','=',$request->id)->first();
       $PatientAccount->update([
        'date'=>date('y-m-d'),
        'Debit'=>0.00,
        'credit'=>$receipt_accounts->Debit,
         'patient_id'=>$request->patient_id,
        'receipt_id'=>$request->id,
      ]);
      DB::commit();
      session()->flash('edit',"تم تعديل البيانات");
       return redirect()->route('Receipt.index');



      }
       catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }


    }

    public function destroy(Request $request)
    {
        $receipt_accounts= ReceiptAccount::find($request->id);
        $receipt_accounts->delete();
        session()->flash("delete","تم حذف البيانات");
        return redirect()->route('Receipt.index');



    }



}
