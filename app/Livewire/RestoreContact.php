<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\AuditTrail;
use Livewire\Component;
use Pusher\Pusher;
use Carbon\Carbon;

class RestoreContact extends Component
{

    public $contacts;

    public function mount()
    {
        // Fetch contacts data from the database
        $this->contacts = Contact::where('isDeleted', 1)->get();
    }


    public function render()
    {
        return view('livewire.restore-contact')->layout('layouts.app');;
    }


    public function RestoreContact($id)
    {
        $user = Contact::findOrFail($id);
        $user->isDeleted = false;
        $user->save();
        $ActionString = 'Restore Contact - ' .  $user->name;
        $this->contacts = Contact::where('isDeleted', 1)->get();
        $this->SaveWebsocket($ActionString);
        $this->SaveAuditTrail($ActionString);
    }

    public function SaveWebsocket($actions)
    {
        $pusher = new Pusher('7985b68dea8ee8b4f360', 'a169e4fc74fb00e9f149', '1824345', [
            'cluster' => 'ap1',
            'encrypted' => true // optional, depending on your setup
        ]);

        $data = ['message' => $actions];
        $pusher->trigger('channel_name', 'eventName', $data);
    }

    public function SaveAuditTrail($Actions)
    {
        $currentDateTime = Carbon::now('UTC')->format('Y-m-d H:i:s');
        $Audit = new AuditTrail(); // Adjust this if you are using a different model
        $Audit->Action = $Actions;
        $Audit->Date = $currentDateTime;
        $Audit->save();
    }
}
