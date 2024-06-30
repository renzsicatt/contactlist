<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SampleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // get
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //post
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) // get ${id}
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) // put ${} 
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) //delete
    {
        //
    }
}
