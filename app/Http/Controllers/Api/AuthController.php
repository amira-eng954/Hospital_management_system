<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\STR;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'role'=>'required|in:0,1',
            
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'An error occurred. Please check your input',
                'errors' => $validator->errors()
            ],422);
        }
        $password=bcrypt($request->password);
        $access_takon=STR::random(64);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            
            'role' => $request->role,
            'access_token' => $access_takon
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'data' => $user,
            'access_token'=>$access_takon
        ],200);
    }


    public function login(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email'=>"required|email",
            'password'=>"required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'An error occurred. Please check your input',
                'errors' => $validator->errors()
            ],422);
        }

        $user=User::where('email','=',$request->email)->first();
        if($user!=null)
        {
            $passcheck=Hash::check($request->password,$user['password']);
            if($passcheck!=null)
            {
                $access_takon=STR::random(64);
                $user->update([
                  'access_token'  =>$access_takon
                ]);
                $user->save();
                return response()->json([
                    'message'=>"Login successful",
                    'data'=>$user,
                    'access_token'=>$access_takon
    
                   ],200);
            }
    
            return response()->json([
                'message'=>"Incorrect password. Please try again."
               ],400);        
        }
      
           return response()->json([
            'message'=>"The requested resource was not found"
           ]);

    }


    public function logout(Request $request)
    {
         $access_takon=$request->header('access_token');
         if($access_takon!=null)
         {
            $user=User::where('access_token','=',$access_takon)->first();
            if($user!=null)
            {
               $user->update([
                   'access_token'=>null
               ]);
               $user->save();
               return response()->json([
                   'message'=>"Logged out successfully",
                   'token'=>$user->access_token
               ]);
            }
   
            return response()->json([
               'message'=>"Access token not found."
           ]);
           
         }
        
        return response()->json([
            'message'=>"Access token must be provided."
        ]);


    }
}

