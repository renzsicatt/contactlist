<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ContactList extends Component
{

    public $contacts;

    public function mount()
    {
        // Fetch contacts data from the database
        $this->contacts = Contact::where('isDeleted', 0)->get();
    }


    public function editContact($id)
    {
        return redirect()->to('/CreateUpdateContact/edit/' . $id);
    }


    public function render()
    {
        return view('livewire.contact-list')->layout('layouts.app');
    }

    public function download()
    {
        return view('livewire.contact-create-update')->layout('layouts.app');
    }





    public function deleteContacts($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->isDeleted = true;
        $contact->save();
        $this->contacts = Contact::where('isDeleted', 0)->get();

        $actions = 'Delete Contact ' . $contact->name;
        $this->SaveWebsocket($actions);
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
}
