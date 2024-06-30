<?php

namespace App\Livewire;

use App\Models\AuditTrail  as AuditTrailModel;
use Livewire\Component;

class AuditTrail extends Component
{

    public $ATrail;

    public function mount()
    {
        // Fetch contacts data from the database
        $this->ATrail = AuditTrailModel::all();
    }


    public function render()
    {
        return view('livewire.audit-trail')->layout('layouts.app');;
    }
}
