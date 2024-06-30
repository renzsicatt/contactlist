<?php

namespace App\Livewire;

use App\Models\WebSocket as WebSocketModel;
use Livewire\Component;

class WebSocket extends Component
{
    public $WebSocket;

    public function mount()
    {
        $this->WebSocket = WebSocketModel::all();
    }

    public function render()
    {
        return view('livewire.web-socket')->layout('layouts.app');;
    }
}
