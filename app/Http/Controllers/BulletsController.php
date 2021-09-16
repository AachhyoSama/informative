<?php

namespace App\Http\Controllers;

use App\Models\Bullets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BulletsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bullets = Bullets::latest()->paginate(10);
        return view('backend.bullets.index', compact('bullets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.bullets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'    => 'required|array',
            'title.*'  => 'required|string',
            'descriptive_title'    => 'required|array',
            'descriptive_title.*'  => 'required|string',
            'icons' => 'required|mimes:png'
        ]);

        $icons = '';
        if($request->hasfile('icons'))
        {
            $image = $request->file('icons');
            $icons = $image->store('icons', 'uploads');
        }

        $bullets = Bullets::create([
            'title' => $request['title'],
            'descriptive_title' => $request['descriptive_title'],
            'icons' => $icons
        ]);

        $bullets->save();

        return redirect()->route('bullets.index')->with('success', 'Feature bullet is saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bullets  $bullets
     * @return \Illuminate\Http\Response
     */
    public function show(Bullets $bullets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bullets  $bullets
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $existing_feature = Bullets::findorFail($id);
        return view('backend.bullets.edit', compact('existing_feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bullets  $bullets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existing_feature = Bullets::findorFail($id);
        $this->validate($request, [
            'title'    => 'required|array',
            'title.*'  => 'required|string',
            'descriptive_title'    => 'required|array',
            'descriptive_title.*'  => 'required|string',
            'icons' => 'mimes:png'
        ]);

        $icons = '';
        if($request->hasfile('icons'))
        {
            Storage::disk('uploads')->delete($existing_feature->icons);
            $image = $request->file('icons');
            $icons = $image->store('icons', 'uploads');
        }
        else
        {
            $icons = $existing_feature->icons;
        }

        $existing_feature->update([
            'title' => $request['title'],
            'descriptive_title' => $request['descriptive_title'],
            'icons' => $icons
        ]);

        return redirect()->route('bullets.index')->with('success', 'Feature bullet is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bullets  $bullets
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existing_feature = Bullets::findorFail($id);
        Storage::disk('uploads')->delete($existing_feature->location);
        $existing_feature->delete();

        return redirect()->route('bullets.index')->with('success', 'Feature bullet is deleted successfully.');
    }
}
