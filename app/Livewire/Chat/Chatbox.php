<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class Chatbox extends Component
{
    public function render()
    {
        return view('livewire.chat.chatbox')->extends('dashboard.layouts.master');
    }
}
