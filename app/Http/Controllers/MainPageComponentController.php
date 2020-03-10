<?php

namespace App\Http\Controllers;

use App\MainPageComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $response = [
            'error' => null,
            'data' => null,
            'msg' => null
        ];

        switch($request->method) {
            case 'getMPC':
                $mpc = MainPageComponent::findOrFail($request->id);
                if (!is_null($mpc)) {
                    $mpc->slider_image = Storage::url($mpc->slider_image);
                    $mpc->screen_image = Storage::url($mpc->screen_image);
                    $response['data'] = $mpc;
                } else {
                    $response['error'] = true;
                    $response['msg'][] = "Could not find component with id: {$request->id}";
                }
                break;
            case 'getMPCs':
                $mpcs = MainPageComponent::all();
                $data = [];
                foreach( $mpcs as $mpc) {
                    $mpc->slider_image = Storage::url($mpc->slider_image);
                    $mpc->screen_image = Storage::url($mpc->screen_image);
                    $data[] = $mpc;
                }
                $response['data'] = $data;
                break;
            case 'createMPC':
                // Validation
                $validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'description' => 'required',
                    'slider_image' => 'required|image',
                    'screen_image' => 'required|image',
                    'caption_color' => 'required',
                    'font_color' => 'required'
                ]);

                if ($validator->fails()) {
                    $response['error'] = true;
                    $response['msg'] = $validator->errors()->messages();
                } else {
                    $mpc = new MainPageComponent($request->except(['slider_image', 'screen_image']));

                    if ($request->hasFile('slider_image')) {
                        $mpc->slider_image = $request->file('slider_image')->store('public');
                    }
                    if ($request->hasFile('screen_image')) {
                        $mpc->screen_image = $request->file('screen_image')->store('public');
                    }

                    if (!$mpc->save()) {
                        $response['error'] = true;
                        $response['msg'] = ['system' => 'Could not save record.'];
                    } else {
                        $response['data'] = ['id' => $mpc->id];
                    }
                }
                break;
            case 'updateMPC':
                $mpc = MainPageComponent::findOrFail($request->id);

                if (is_null($mpc)) {
                    $response['error'] = true;
                    $response['msg'][] = "Could not find component with id: {$request->id}";
                } else {
                    // Validation
                    $validator = Validator::make($request->all(), [
                        'title' => 'required',
                        'description' => 'required',
                        'slider_image' => 'image',
                        'screen_image' => 'image',
                        'caption_color' => 'required',
                        'font_color' => 'required'
                    ]);

                    if ($validator->fails()) {
                        $response['error'] = true;
                        $response['msg'] = $validator->errors()->messages();
                    } else {
                        $mpc->fill($request->except(['slider_image', 'screen_image']));

                        if ($request->hasFile('slider_image')) {
                            $mpc->slider_image = $request->file('slider_image')->store('public');
                        }
                        if ($request->hasFile('screen_image')) {
                            $mpc->screen_image = $request->file('screen_image')->store('public');
                        }

                        if (!$mpc->save()) {
                            $response['error'] = true;
                            $response['msg'] = ['system' => 'Could not save record.'];
                        } else {
                            $response['data'] = ['id' => $mpc->id];
                        }
                    }
                }
                break;
        }

        return response()->json($response);
    }
}
