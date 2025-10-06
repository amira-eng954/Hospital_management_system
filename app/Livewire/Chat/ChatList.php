<?php

namespace App\Livewire\Chat;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\patient;
use Livewire\Component;
use Livewire\Attributes\On;

use Illuminate\Support\Facades\Auth;

class ChatList extends Component
{

    public $conversations;
     public $auth_email;
     public  $selected_conversation;
     public  $receviverUser;


// refresh
 //$this->dispatch('refresh')->to(\App\Livewire\Chat\ChatList::class);
#[On('refresh')]
public function refreshList()
{
    $this->dispatch('$refresh');
}


    
     public function mount()
        {
             $this->auth_email=auth()->user()->email;
       }

// دى لما اضعط على اسم معين فى الليست يروح يجيب الاسم الل انا باعت له والمحادثه ويعمل ايفين عشان يظهر الشات الل بنا
       public function chatUserSelected(Conversation $conversation ,$receiver_id){
        $this->selected_conversation = $conversation;
        
        if(Auth::guard('patient')->check()){
            $this->receviverUser = Doctor::find($receiver_id);
            
            $this->dispatch('load_conversationDoctor', $this->selected_conversation, $this->receviverUser)
     ->to(\App\Livewire\Chat\Chatbox::class);

        }
        else{
            $this->receviverUser = Patient::find($receiver_id);

           $this->dispatch('load_conversationPatient', $this->selected_conversation, $this->receviverUser)
     ->to(\App\Livewire\Chat\Chatbox::class);

        }

          $this->dispatch('updateMessage', $this->selected_conversation, $this->receviverUser)
     ->to(\App\Livewire\Chat\SendMessage::class);
     }


// دى بتجيب اسماء الاشخاص الل فى الليست الل انا مكلمهم بس اول ما بيفتح المحادثه خالص المريض 
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
       // dd($this->conversation);

      

     }
     

      

       
    public function render()
    {
    $this->conversations=Conversation::where('sender_email',$this->auth_email)->orwhere('receiver_email',$this->auth_email)->get();

//dd($this->conversations);
      return view('livewire.chat.chat-list');
    }
}
