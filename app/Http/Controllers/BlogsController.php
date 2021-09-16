<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = News::latest()->where('news_blogs', 1)->paginate(10);
        return view('backend.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blogs.create');
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
            'title'    => 'required|array',
            'title.*'  => 'required|string',
            'descriptive_title'    => 'required|array',
            'descriptive_title.*'  => 'required|string',
            'author' => 'required',
            'written_date' => 'required',
            'content'    => 'required|array',
            'content.*'  => 'required|string',
        ]);

        $cover_image = '';
        if($request->hasfile('cover_image'))
        {
            $image = $request->file('cover_image');
            $cover_image = $image->store('cover_image', 'uploads');
        }

        $blogs = News::create([
            'cover_image' => $cover_image,
            'title' => $request['title'],
            'slug' => Str::slug($request->title['en']),
            'descriptive_title' => $request['descriptive_title'],
            'content' => $request['content'],
            'written_on' => $request['written_date'],
            'author' => $request['author'],
            'view_count' => 0,
            'news_blogs' => 1
        ]);

        $blogs->save();

        return redirect()->route('blogs.index')->with('success', 'Blogs is created successfully.');
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
        $existing_blogs = News::findorFail($id);
        return view('backend.blogs.edit', compact('existing_blogs'));
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
        $existing_blogs = News::findorFail($id);

        $this->validate($request, [
            'cover_image' => 'mimes:png,jpg,jpeg',
            'title'    => 'required|array',
            'title.*'  => 'required|string',
            'descriptive_title'    => 'required|array',
            'descriptive_title.*'  => 'required|string',
            'author' => 'required',
            'written_date' => 'required',
            'content'    => 'required|array',
            'content.*'  => 'required|string',
        ]);

        $cover_image = '';
        if($request->hasfile('cover_image'))
        {
            Storage::disk('uploads')->delete($existing_blogs->cover_image);
            $image = $request->file('cover_image');
            $cover_image = $image->store('cover_image', 'uploads');
        }
        else
        {
            $cover_image = $existing_blogs->cover_image;
        }

        $existing_blogs->update([
            'cover_image' => $cover_image,
            'title' => $request['title'],
            'slug' => Str::slug($request->title['en']),
            'descriptive_title' => $request['descriptive_title'],
            'content' => $request['content'],
            'written_on' => $request['written_date'],
            'author' => $request['author'],
            'view_count' => 0,
            'news_blogs' => 1
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blogs information is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existing_blogs = News::findorFail($id);
        Storage::disk('uploads')->delete($existing_blogs->cover_image);

        $existing_blogs->delete();

        return redirect()->route('news.index')->with('success', 'Blogs information deleted successfully.');
    }
}
