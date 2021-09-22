<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::latest()->where('news_blogs', 0)->paginate(10);
        return view('backend.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.news.create');
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
            'meta_title'  => '',
            'meta_keywords'  => '',
            'meta_description'  => '',
            'og_image' => 'mimes:png,jpg,jpeg',
        ]);

        $cover_image = '';
        if($request->hasfile('cover_image'))
        {
            $image = $request->file('cover_image');
            $cover_image = $image->store('cover_image', 'uploads');
        }

        $og_image = '';
        if($request->hasfile('og_image'))
        {
            $image = $request->file('og_image');
            $og_image = $image->store('og_image', 'uploads');
        }

        $news = News::create([
            'cover_image' => $cover_image,
            'title' => $request['title'],
            'slug' => Str::slug($request->title['en']),
            'descriptive_title' => $request['descriptive_title'],
            'content' => $request['content'],
            'written_on' => $request['written_date'],
            'author' => $request['author'],
            'view_count' => 0,
            'news_blogs' => 0,

            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'og_image' => $og_image,
        ]);

        $news->save();

        return redirect()->route('news.index')->with('success', 'News is created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $existing_news = News::findorFail($id);
        return view('backend.news.edit', compact('existing_news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existing_news = News::findorFail($id);

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
            'meta_title'  => '',
            'meta_keywords'  => '',
            'meta_description'  => '',
            'og_image' => 'mimes:png,jpg,jpeg',
        ]);

        $cover_image = '';
        if($request->hasfile('cover_image'))
        {
            Storage::disk('uploads')->delete($existing_news->cover_image);
            $image = $request->file('cover_image');
            $cover_image = $image->store('cover_image', 'uploads');
        }
        else
        {
            $cover_image = $existing_news->cover_image;
        }

        $og_image = '';
        if($request->hasfile('og_image'))
        {
            $image = $request->file('og_image');
            $og_image = $image->store('og_image', 'uploads');
        }
        else
        {
            $og_image = $existing_news->og_image;
        }

        $existing_news->update([
            'cover_image' => $cover_image,
            'title' => $request['title'],
            'slug' => Str::slug($request->title['en']),
            'descriptive_title' => $request['descriptive_title'],
            'content' => $request['content'],
            'written_on' => $request['written_date'],
            'author' => $request['author'],
            'view_count' => 0,
            'news_blogs' => 0,

            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'og_image' => $og_image,
        ]);

        return redirect()->route('news.index')->with('success', 'News is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existing_news = News::findorFail($id);
        Storage::disk('uploads')->delete($existing_news->cover_image);

        $existing_news->delete();

        return redirect()->route('news.index')->with('success', 'News information deleted successfully.');
    }
}
