<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItemPost;
use App\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuItemPost $request)
    {
        # Cach dung gate trong controller
        // if ( ! $request->user()->can('edit-menu')) {
        //     return response('Unauthorized', 403);
        // }

        // $request->validate([
        //     'name' => 'required|max:128',
        //     'description' => 'required|max:512',
        //     'price' => 'required|numeric|min:0',
        //     'category_id' => 'required|numeric',
        //     'image' => 'required',
        // ]);

        MenuItem::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItem $menuItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItem $menuItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function update(MenuItemPost $request, MenuItem $menuItem)
    {
        $menuItem->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuItem  $menuItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItem $menuItem)
    {
        //
    }
}
