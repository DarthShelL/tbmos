<?php

namespace App\Http\Controllers;

use App\MainPageComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainPageComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mpcs = MainPageComponent::all();
        return view('mpc.index', compact('mpcs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mpc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $mpc = new MainPageComponent($request->all());

        if ($request->hasFile('screen_image')) {
            $mpc->screen_image = $request->file('screen_image')->store('public');
        }

        $mpc->save();

        return redirect()->route('MainPageComponent.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mpc = MainPageComponent::findOrFail($id);

        return view('mpc.edit', compact('mpc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MainPageComponent  $mainPageComponent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MainPageComponent $mainPageComponent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MainPageComponent  $mainPageComponent
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainPageComponent $mainPageComponent)
    {
        //
    }

    public function api(Request $request) {
        $mpc = MainPageComponent::findOrFail($request->id);
        if (!is_null($mpc->screen_image)) {
            $mpc->screen_image = Storage::url($mpc->screen_image);
        }

        return response()->json($mpc);
    }
}
