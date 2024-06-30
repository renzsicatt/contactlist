<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index()
    {
        $parameter = 'Parameter value'; // This could be any data, like $id or fetched from a model
        return view('livewire.example-component');
    }
}
