<?php

namespace App\Livewire\Chat;

use Livewire\Attributes\On;
use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use Livewire\Component;

class SendMessage extends Component
{
    public $body;
    public $selected_conversation;
    public $receviverUser;
    public $auth_email;
   

    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }

#[On('updateMessage')]
    public function updateMessage(Conversation $conversation, $receiver){
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
    }


    public function sendMessage()
    {

        if($this->body == null){

            return null;
        }

        $createdMessage = Message::create([
            'conversation_id' => $this->selected_conversation->id,
            'sender_email' => $this->auth_email,
            'receiver_email' => $this->receviverUser['email'],
            'body' => $this->body,
        ]);
        $this->selected_conversation->last_time_message = $createdMessage->created_at;
        $this->selected_conversation->save();
        $this->reset('body');
    }


    public function render()
    {
         return view('livewire.chat.send-message');//->extends('dashboard.layouts.master');
    }
}