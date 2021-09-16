<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->paginate(10);
        return view('backend.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sliders.create');
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
            'slider_image' => 'required|mimes:png,jpg,jpeg',
            'active' => ''
        ]);

        $slider_image = '';
        if($request->hasfile('slider_image'))
        {
            $image = $request->file('slider_image');
            $slider_image = $image->store('slider_image', 'uploads');
        }
        
        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }

        $slider = Slider::create([
            'location' => $slider_image,
            'is_active' => $active
        ]);
        $slider->save();

        return redirect()->route('slider.index')->with('success', 'Slider is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findorFail($id);
        return view('backend.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existing_slider = Slider::findorFail($id);

        $this->validate($request, [
            'slider_image' => 'mimes:png,jpg,jpeg',
            'active' => ''
        ]);

        $slider_image = '';
        if($request->hasfile('slider_image'))
        {
            Storage::disk('uploads')->delete($existing_slider->location);
            $image = $request->file('slider_image');
            $slider_image = $image->store('slider_image', 'uploads');
        }
        else
        {
            $slider_image = $existing_slider->location;
        }

        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }

        $existing_slider->update([
            'location' => $slider_image,
            'is_active' => $active
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existing_slider = Slider::findorFail($id);
        Storage::disk('uploads')->delete($existing_slider->location);
        $existing_slider->delete();

        return redirect()->route('slider.index')->with('success', 'Slider is deleted successfully.');
    }
}
