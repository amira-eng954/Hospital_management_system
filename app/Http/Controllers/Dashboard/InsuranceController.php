<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Http\Requests\InsuranceRequest;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    //

    public function index()
    {
         $insurances=Insurance::all();
         return view("dashboard.insurances.index",compact("insurances"));


    }

    public function show()
    {
        
    }

    public function create()
    {
        return view("dashboard.insurances.create");
    }

    public function store(InsuranceRequest $request)
    {
        $data=$request->validated();
        $data['status']=1;
        Insurance::create($data);
        return redirect()->route('insurance.index');
    }

    public function edit($id)
    {
       $insurances =Insurance::find($id);
        return view("dashboard.insurances.edit",compact("insurances"));

    }

    public function update(Request $request)
    {
        if(!$request->has('status'))
        {
           $request->request->add(['status'=>0]);
        }
        else {
            {
                $request->request->add(['status'=>1]);
                }
        }
        $Insurance=Insurance::find($request->id);
        $Insurance->update($request->all());
        return redirect()->route('insurance.index');
        
    }

    public function destroy($id)
    {
        $Insurance=Insurance::find($id);
         $Insurance->delete();
        return redirect()->route('insurance.index');

    }

   
}
