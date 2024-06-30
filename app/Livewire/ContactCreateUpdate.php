<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Contact;
use App\Models\AuditTrail;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Pusher\Pusher;
use Carbon\Carbon;

class ContactCreateUpdate extends Component
{
    use WithFileUploads;


    public $actions;
    public $ids;
    public $image;
    public $imagePreviewUrl;

    public $name;
    public $email;
    public $contactnumber;
    public $address;
    public $notes;


    public function mount($action, $id)
    {
        $this->actions = $action;
        $this->ids = $id;

        if ($action != 'new') {
            $user = Contact::find($id); // Use find() instead of findOrFail()

            if ($user) {
                $this->name = $user->name;
                $this->email = $user->email;
                $this->contactnumber = $user->contactnumber;
                $this->address = $user->address;
                $this->notes = $user->notes;
                $this->imagePreviewUrl = $user->picture;
            }
        } else {
            // Handle case where contact with $id is not found
            // For example, set default values or show a message
            $this->name = '';
            $this->email = '';
            $this->contactnumber = '';
            $this->address = '';
            $this->notes = '';
            $this->imagePreviewUrl = '';
        }
    }

    public function updatedImage()
    {
        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
            $this->imagePreviewUrl = Storage::url($imagePath);
        }
    }

    public function editContact($id)
    {
        $this->validate([
            'image' => 'image|max:1024',
        ]);

        // Create a temporary URL for the image preview
        $this->imagePreviewUrl = $this->image->temporaryUrl();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contactnumber' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        if ($this->actions == 'new') {

            if ($this->image) {
                $imagePath = $this->image->store('images', 'public');
                $this->imagePreviewUrl = Storage::url($imagePath);
            }

            $user = new Contact(); // Adjust this if you are using a different model
            $user->name = $this->name;
            $user->email = $this->email;
            $user->contactnumber = $this->contactnumber;
            $user->address = $this->address;
            $user->notes = $this->notes;
            $user->picture = $this->imagePreviewUrl ?? null;
            $user->isDeleted = false;
            $user->save();

            $ActionString = 'Create new Contact - ' . $this->name;
            $this->SaveAuditTrail($ActionString);
            $this->SaveWebsocket($ActionString);
        } else {
            $user = Contact::findOrFail($this->ids);



            $user->name = $this->name;
            $user->email = $this->email;
            $user->contactnumber = $this->contactnumber;
            $user->address = $this->address;
            $user->notes = $this->notes;

            if ($this->image) {
                // Delete the old picture if it exists
                if ($user->picture) {
                    Storage::disk('public')->delete($user->picture);
                }

                // Store the new picture
                $imagePath = $this->image->store('images', 'public');
                $user->picture = $imagePath;
                $this->imagePreviewUrl = Storage::url($imagePath); // Update the preview URL
            }
            $user->save();

            $ActionString = 'Edit Contact - ' . $this->name;

            $this->SaveAuditTrail($ActionString);
            $this->SaveWebsocket($ActionString);
        }

        return redirect()->to('/ContactList');
    }


    public function SaveAuditTrail($Actions)
    {
        $currentDateTime = Carbon::now('UTC')->format('Y-m-d H:i:s');
        $Audit = new AuditTrail(); // Adjust this if you are using a different model
        $Audit->Action = $Actions;
        $Audit->Date = $currentDateTime;
        $Audit->save();
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


    public function render()
    {
        return view('livewire.contact-create-update')->layout('layouts.app');
    }
}
