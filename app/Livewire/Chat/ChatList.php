<?php

namespace App\Livewire\Chat;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\patient;
use Livewire\Component;

class ChatList extends Component
{

    public $conversations;
     public $auth_email;

    // $table->string('sender_email');
           // $table->string('receiver_email');

     public function mount()
        {
             $this->auth_email=auth()->user()->email;
       }


       public function getUsers( Conversation $conversation,$request)
       {
        if($conversation->sender_email == $this->auth_email){
            $this->receviverUser = Doctor::firstwhere('email',$conversation->receiver_email);
        }

        else{
            $this->receviverUser = Patient::firstwhere('email',$conversation->sender_email);
        }

        if(isset($request)){
            return $this->receviverUser->$request;
        }

     }
       
    public function render()
    {
    $this->conversations=Conversation::where('sender_email',$this->auth_email)->orwhere('receiver_email',$this->auth_email)->get();

//dd($this->conversations);
       return view('livewire.chat.chat-list');
    }
}
