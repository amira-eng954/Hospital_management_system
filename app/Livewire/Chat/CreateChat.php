<?php

namespace App\Livewire\Chat;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\patient;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CreateChat extends Component
{

    
    public $users;
     public $auth_email;

    public function mount()
    {
          $this->auth_email=auth()->user()->email;
    }

    public function createConversation($emailRecive)
    {
        DB::beginTransaction();
        $Conversation=Conversation::where('sender_email',$this->auth_email)
        ->where('receiver_email',$emailRecive)
        ->orwhere('receiver_email',$this->auth_email)->where('sender_email',$emailRecive)->get();
        
        if($Conversation->isEmpty())
        {
        try
        {
           $con=Conversation::create([
            'sender_email'=>$this->auth_email,
            'receiver_email'=>$emailRecive,
             'last_time_message' => null,
           ]);


           Message::create([
             'sender_email'=>$this->auth_email,
            'receiver_email'=>$emailRecive,
            'body'=>'السلام عليكم',
            'conversation_id'=>$con->id,

           ]);
           DB::commit();
            $this->emitSelf('render');
            } 
            catch (\Exception $e) {
                DB::rollBack();
            }

       
    }
    else {
         dd('Conversation yes');
            
    }
    }
    public function render()
    {
        if(Auth::guard('doctor')->check())
        {
          $this->users = Patient::all();

        }
        elseif(Auth::guard('patient')->check()) {
           $this->users=Doctor::all();
           //dd('aaaa');
        }
        


       
        return view('livewire.chat.createchat')->extends('dashboard.layouts.master');
    }
  
}


