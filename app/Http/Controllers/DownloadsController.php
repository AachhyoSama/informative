<?php

namespace App\Http\Controllers;

use App\Models\Downloads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $downloads = Downloads::latest()->paginate(10);
        return view('backend.downloads.index', compact('downloads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.downloads.create');
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
            'file_name' => 'required',
            'file' => 'required|mimes:pdf'
        ]);

        $file = '';
        if($request->hasfile('file'))
        {
            $image = $request->file('file');
            $file = $image->store('file', 'uploads');
        }

        $new_file = Downloads::create([
            'file_name' => $request['file_name'],
            'file_location' => $file
        ]);

        $new_file->save();
        return redirect()->route('download.index')->with('success', 'File is saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Downloads  $downloads
     * @return \Illuminate\Http\Response
     */
    public function show(Downloads $downloads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Downloads  $downloads
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $existing_file = Downloads::findorFail($id);
        return view('backend.downloads.edit', compact('existing_file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Downloads  $downloads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existing_file = Downloads::findorFail($id);
        $this->validate($request, [
            'file_name' => 'required',
            'file' => 'mimes:pdf'
        ]);

        $file = '';
        if($request->hasfile('file'))
        {
            Storage::disk('uploads')->delete($existing_file->file_location);
            $image = $request->file('file');
            $file = $image->store('file', 'uploads');
        }
        else{
            $file = $existing_file->file_location;
        }

        $existing_file->update([
            'file_name' => $request['file_name'],
            'file_location' => $file
        ]);

        return redirect()->route('download.index')->with('success', 'File is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Downloads  $downloads
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existing_file = Downloads::findorFail($id);
        Storage::disk('uploads')->delete($existing_file->file_location);
        $existing_file->delete();

        return redirect()->route('download.index')->with('success', 'File is updated successfully.');
    }
}
