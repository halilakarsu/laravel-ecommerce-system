<?php

namespace App\Http\Controllers;

use App\Models\Menus;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.menus.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Menus $menus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menus $menus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menus $menus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menus $menus)
    {
        //
    }
}
