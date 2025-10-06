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
// دى بعملها كدا عشان لما اخزن الرسايل عايز المعلومات دى ف بجيبها لما اضعط على الليست
#[On('updateMessage')]
    public function updateMessage(Conversation $conversation, $receiver){
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
    }

// دى بيخزن الرساله فى جدول الرسايل 
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
        $this->dispatch('pushMessage',$createdMessage->id)->to(\App\Livewire\Chat\Chatbox::class);
         $this->dispatch('refresh')->to(\App\Livewire\Chat\ChatList::class);


    }


    public function render()
    {
         return view('livewire.chat.send-message');//->extends('dashboard.layouts.master');
    }
}