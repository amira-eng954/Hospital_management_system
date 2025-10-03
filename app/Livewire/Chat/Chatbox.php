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

    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }

 #[On('load_conversationDoctor')]
    public function load_conversationDoctor(Conversation $conversation,  $receiver ){

        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Message::where('conversation_id',$this->selected_conversation->id)->get();
    }
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

