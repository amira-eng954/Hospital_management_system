<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PaymentAccount;
use App\Models\FundAccount;
use App\Models\PatientAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class PaymentAccountController extends Controller
{
    //
    public function index()
    {
        $payments=PaymentAccount::all();
         return view("dashboard.Payment.index",compact("payments"));
    }
    public function show($id)
    { $payment_account= PaymentAccount::findorfail($id);
       return view("dashboard.Payment.print",compact("payment_account"));

    }

     public function create()
    {
         $Patients=Patient::all();
         //$credit=PatientAccount
        return view("dashboard.Payment.create",compact("Patients"));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{  // تخزي فى جدول الصرف
            $payment=PaymentAccount::create([
                'date'=>date('y-m-d'),
                'patient_id'=>$request->patient_id,
                'amount'=>$request->amount,
                'description'=>$request->description

            ]);
             $payment->save();
             //تخزين فى جدول حسابات المريض
              PatientAccount::create([
                'patient_id'=>$request->patient_id,
                 'date'=>date('y-m-d'),
                 'Payment_id'=>$payment->id,
                 'Debit'=> $payment->amount,
                  'credit'=>0.00

              ]);

        FundAccount::create([
        'Payment_id'=>$payment->id,
        'date'=>date('y-m-d'),
        'Debit'=> 0.00,
        'credit'=>$payment->amount,
      ]);
       DB::commit();
         session()->flash('add',"تم تاكيد البيانات");
      return redirect()->route('Payment.index');




        }
         catch (\Exception $e)
          {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }


    }



     public function edit(Request $request,$id)
    {   $payment_accounts= PaymentAccount::find($id);
        $Patients =Patient::all();
        // $receipt_accounts
        return view("dashboard.Payment.edit",compact("Patients","payment_accounts"));


    }

      public function update(Request $request)
    {   
      DB::beginTransaction();
      try{
              $payment=PaymentAccount::where('id','=',$request->id)->first();
              $payment->update([
                'date'=>date('y-m-d'),
                'patient_id'=>$request->patient_id,
                'amount'=>$request->amount,
                'description'=>$request->description

            ]);
             $payment->save();
             //تخزين فى جدول حسابات المريض
             $PatientAccount= PatientAccount::where('Payment_id','=',$request->id)->first();
               $PatientAccount->update([
                'patient_id'=>$request->patient_id,
                 'date'=>date('y-m-d'),
                 'Payment_id'=>$payment->id,
                 'Debit'=> $payment->amount,
                  'credit'=>0.00

              ]);

        $FundAccount=FundAccount::where('Payment_id','=',$request->id)->first();
        $FundAccount->update([
        'Payment_id'=>$payment->id,
        'date'=>date('y-m-d'),
        'Debit'=> 0.00,
        'credit'=>$payment->amount,
      ]);
       DB::commit();
         session()->flash('edit',"تم تاكيد البيانات");
      return redirect()->route('Payment.index');





      }

       catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

}













     public function destroy(Request $request)
    {
        $receipt_accounts= PaymentAccount::find($request->id);
        $receipt_accounts->delete();
        session()->flash("delete","تم حذف البيانات");
        return redirect()->route('Receipt.index');



    }






}
