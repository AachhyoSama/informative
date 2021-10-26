<?php

namespace App\Http\Controllers;

use App\Models\Membercategory;
use App\Models\Members;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = SubCategory::latest()->paginate(10);
        return view('backend.members.subcategory.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member_categories = Membercategory::latest()->where('is_active', 1)->get();
        return view('backend.members.subcategory.create', compact('member_categories'));
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
            'sub_category_name'    => 'required|array',
            'sub_category_name.*'  => 'required|string',
            'category' => 'required',
            'is_active' => '',
            'meta_title'  => '',
            'meta_keywords'  => '',
            'meta_description'  => '',
            'og_image' => 'mimes:png,jpg,jpeg',
        ]);

        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }

        $og_image = '';
        if($request->hasfile('og_image'))
        {
            $image = $request->file('og_image');
            $og_image = $image->store('og_image', 'uploads');
        }

        $sub_category = SubCategory::create([
            'sub_category_name' => $request['sub_category_name'],
            'slug' => Str::slug($request->sub_category_name['en']),
            'category_id' => $request['category'],
            'is_active' => $active,
            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'og_image' => $og_image,
        ]);

        $sub_category->save();

        return redirect()->route('subCategory.index')->with('success', 'Subcategory information is saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_category = SubCategory::findorFail($id);
        $member_categories = Membercategory::latest()->where('is_active', 1)->get();
        return view('backend.members.subcategory.edit', compact('sub_category', 'member_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sub_category = SubCategory::findorFail($id);

        $this->validate($request, [
            'sub_category_name'    => 'required|array',
            'sub_category_name.*'  => 'required|string',
            'category' => 'required',
            'is_active' => '',

            'meta_title'  => '',
            'meta_keywords'  => '',
            'meta_description'  => '',
            'og_image' => 'mimes:png,jpg,jpeg',
        ]);

        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }

        $og_image = '';
        if($request->hasfile('og_image'))
        {
            $image = $request->file('og_image');
            $og_image = $image->store('og_image', 'uploads');
        }
        else
        {
            $og_image = $sub_category->og_image;
        }

        $sub_category->update([
            'sub_category_name' => $request['sub_category_name'],
            'slug' => Str::slug($request->sub_category_name['en']),
            'category_id' => $request['category'],
            'is_active' => $active,
            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'og_image' => $og_image,
        ]);

        return redirect()->route('subCategory.index')->with('success', 'Subcategory information is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_category = SubCategory::findorFail($id);
        $members_category = Members::where('member_id', $id)->get();
        $commitee_category = Members::where('commitee_id', $id)->get();

        if (count($members_category) > 0 || count($commitee_category) > 0)
        {
            return redirect()->back()->with('error', 'There are members in this category. Cant delete.');
        }

        $sub_category->delete();

        return redirect()->route('subCategory.index')->with('success', 'Subcategory is deleted successfully.');
    }
}
