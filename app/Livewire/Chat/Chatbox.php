<?php

namespace App\Livewire\Chat;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use App\Models\Message;
use App\Models\Conversation;
use Livewire\Component;

class Chatbox extends Component
{
      
    // protected $listeners=['load_conversationDoctor','load_conversationPatient'];
    public $receiver;
    public $selected_conversation;
    public $receviverUser;
    public $messages;
    public $auth_email;
   

//عشان اجيب الشخص المسجل حاليا
    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }


    //الرساله الجديده تظهر فى الشات من غير ما اعمل ريفرش
     #[On('pushMessage')]
     public function  pushMessage($id)
     {
         $message=Message::find($id);
         $this->messages->push($message);

     }


//دى لما المريض يبعت لدكتور والمريض يفتح شات دكتور معين يجيب الرسايل بتاعتهم
 #[On('load_conversationDoctor')]
    public function load_conversationDoctor(Conversation $conversation,  $receiver ){

        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Message::where('conversation_id',$this->selected_conversation->id)->get();
    }


//دى لما الدكتو يبعت لمريض والدكتور يفتح شات تامريض معين يجيب الرسايل بتاعتهم

 #[On('load_conversationPatient')]
    public function load_conversationPatient(Conversation $conversation,  $receiver ){

        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Message::where('conversation_id',$this->selected_conversation->id)->get();
    }




    public function render()
    {
        return view('livewire.chat.chatbox')->extends('dashboard.layouts.master');
    }
}

