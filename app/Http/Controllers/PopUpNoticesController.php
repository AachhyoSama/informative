<?php

namespace App\Http\Controllers;

use App\Models\PopupNotices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopUpNoticesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $popupnotices = PopupNotices::latest()->paginate(10);
        return view('backend.popupnotice.index', compact('popupnotices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.popupnotice.create');
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
            'cover_image' => 'required|mimes:png,jpg,jpeg',
            'is_active' => ''
        ]);

        $cover_image = '';
        if($request->hasfile('cover_image'))
        {
            $image = $request->file('cover_image');
            $cover_image = $image->store('cover_images', 'uploads');
        }

        if ($request['is_active'] == null)
        {
            $status = 0;
        } else
        {
            $status = 1;
        }

        $new_popup = PopupNotices::create([
            'cover_image' => $cover_image,
            'status' => $status
        ]);

        $new_popup->save();
        return redirect()->route('popupnotice.index')->with('success', 'Pop up Notice is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $popupnotice = PopupNotices::findorFail($id);
        return view('backend.popupnotice.edit', compact('popupnotice'));
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
        $existing_popup = PopupNotices::findorFail($id);

        $this->validate($request, [
            'cover_image' => 'mimes:png,jpg,jpeg',
            'is_active' => ''
        ]);

        $cover_image = '';
        if($request->hasfile('cover_image'))
        {
            Storage::disk('uploads')->delete($existing_popup->cover_image);
            $image = $request->file('cover_image');
            $cover_image = $image->store('cover_images', 'uploads');
        }
        else
        {
            $cover_image = $existing_popup->cover_image;
        }

        if ($request['is_active'] == null)
        {
            $status = 0;
        } else
        {
            $status = 1;
        }

        $existing_popup->update([
            'cover_image' => $cover_image,
            'status' => $status
        ]);

        return redirect()->route('popupnotice.index')->with('success', 'Pop up Notice is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existing_popup = PopupNotices::findorFail($id);
        Storage::disk('uploads')->delete($existing_popup->cover_image);

        $existing_popup->delete();
        return redirect()->route('popupnotice.index')->with('success', 'Pop up Notice is deleted successfully.');
    }
}
