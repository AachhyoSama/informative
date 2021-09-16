<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::latest()->paginate(10);
        return view('backend.album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.album.create');
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
            'album_cover' => 'required|mimes:png,jpg,jpeg',
            'album_title'    => 'required|array',
            'album_title.*'  => 'required|string',
            'album_images' => 'required',
            'album_images.*' => 'mimes:jpeg,jpg,png'
        ]);

        $album_cover = '';
        if($request->hasfile('album_cover'))
        {
            $image = $request->file('album_cover');
            $album_cover = $image->store('album_covers', 'uploads');
        }

        $new_album = Album::create([
            'album_title' => $request['album_title'],
            'title_slug' => Str::slug($request->album_title['en']),
            'album_cover' => $album_cover
        ]);

        $imagename = '';
        if($request->hasfile('album_images'))
        {
            $images = $request->file('album_images');
            foreach($images as $image)
            {
                $imagename = $image->store('album_images', 'uploads');
                $album_images = AlbumImages::create([
                    'album_id' => $new_album['id'],
                    'album_images' => $imagename,
                ]);
                $album_images->save();
            }
        }

        $new_album->save();

        return redirect()->route('album.index')->with('success', 'Album is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::findorFail($id);
        $album_images = AlbumImages::where('album_id', $id)->get();

        return view('backend.album.edit', compact('album', 'album_images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $album = Album::findorFail($id);

        if (isset($_POST['updateAlbum']))
        {
            $this->validate($request, [
                'album_title'    => 'required|array',
                'album_title.*'  => 'required|string',
                'album_cover' => 'mimes:png,jpg,jpeg'
            ]);

            $album_cover = '';
            if($request->hasfile('album_cover'))
            {
                Storage::disk('uploads')->delete($album->album_cover);
                $image = $request->file('album_cover');
                $album_cover = $image->store('album_covers', 'uploads');
            }
            else
            {
                $album_cover = $album->album_cover;
            }

            $album->update([
                'album_title' => $request['album_title'],
                'title_slug' => Str::slug($request->album_title['en']),
                'album_cover' => $album_cover
            ]);

            return redirect()->route('album.index')->with('success', 'Album is updated successfully.');
        }
        elseif(isset($_POST['updateImages']))
        {
            $this->validate($request, [
                'album_images' => '',
                'album_images.*' => 'mimes:jpeg,jpg,png'
            ]);

            $imagename = '';
            if($request->hasfile('album_images'))
            {
                $images = $request->file('album_images');
                foreach($images as $image)
                {
                    $imagename = $image->store('album_images', 'uploads');
                    $album_images = AlbumImages::create([
                        'album_id' => $album->id,
                        'album_images' => $imagename,
                    ]);
                    $album_images->save();
                }
            }

            return redirect()->back()->with('success', 'Album Images is added successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::findorFail($id);
        $album_images = AlbumImages::where('album_id', $album->id)->get();
        foreach ($album_images as $images) {
            Storage::disk('uploads')->delete($images->album_images);
            $images->delete();
        }

        Storage::disk('uploads')->delete($album->album_cover);
        $album->delete();

        return redirect()->route('album.index')->with('success', 'Album Deleted Successfully');

    }

    public function deleteAlbumImage($id)
    {
        $album_image = AlbumImages::findorfail($id);
        $images = AlbumImages::where('album_id', $album_image->album_id)->get();
        if(count($images) < 2)
        {
            return redirect()->back()->with('error', 'Only one image cannot be deleted.');
        }

        Storage::disk('uploads')->delete($album_image->album_images);

        $album_image->delete();
        return redirect()->back()->with('success', 'Album Image Deleted Successfully');
    }
}
