<?php

namespace App\Http\Controllers;

use App\Models\Membercategory;
use App\Models\Members;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MembercategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memberCategories = Membercategory::latest()->where('member_commities', 0)->paginate(10);
        return view('backend.members.category.index', compact('memberCategories'));
    }

    public function commiteeCategory()
    {
        $commiteeCategories = Membercategory::latest()->where('member_commities', 1)->paginate(10);
        return view('backend.members.category.commitee_index', compact('commiteeCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.members.category.create');
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
            'category_name'    => 'required|array',
            'category_name.*'  => 'required|string',
            'member_commities' => 'required',
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

        $new_category = Membercategory::create([
            'category_name' => $request['category_name'],
            'slug' => Str::slug($request->category_name['en']),
            'member_commities' => $request['member_commities'],
            'is_active' => $active,
            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'og_image' => $og_image,
        ]);
        $new_category->save();
        if ($request['member_commities'] == 0)
        {
            return redirect()->route('memberCategory.index')->with('success', 'New Category is saved successfully.');
        }
        elseif ($request['member_commities'] == 1)
        {
            return redirect()->route('commiteeCategory')->with('success', 'New Category is saved successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Membercategory  $membercategory
     * @return \Illuminate\Http\Response
     */
    public function show(Membercategory $membercategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Membercategory  $membercategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $memberCategory = Membercategory::findorFail($id);
        return view('backend.members.category.edit', compact('memberCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Membercategory  $membercategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $memberCategory = Membercategory::findorFail($id);
        $this->validate($request, [
            'category_name'    => 'required|array',
            'category_name.*'  => 'required|string',
            'member_commities' => 'required',
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
            $og_image = $memberCategory->og_image;
        }

        $memberCategory->update([
            'category_name' => $request['category_name'],
            'slug' => Str::slug($request->category_name['en']),
            'member_commities' => $request['member_commities'],
            'is_active' => $active,
            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'og_image' => $og_image,
        ]);

        if ($request['member_commities'] == 0)
        {
            return redirect()->route('memberCategory.index')->with('success', 'New Category is updated successfully.');
        }
        elseif ($request['member_commities'] == 1)
        {
            return redirect()->route('commiteeCategory')->with('success', 'New Category is updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Membercategory  $membercategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $memberCategory = Membercategory::findorFail($id);
        $members_category = Members::where('member_id', $id)->get();
        $commitee_category = Members::where('commitee_id', $id)->get();

        $sub_category = SubCategory::where('category_id', $memberCategory->id)->get();
        if (count($members_category) > 0 || count($commitee_category) > 0) {
            return redirect()->back()->with('error', 'There are members in this category. Cant delete.');
        }

        if (count($sub_category) > 0) {
            return redirect()->back()->with('error', 'This category has sub categories. Cant delete.');
        }

        $memberCategory->delete();
        return redirect()->back()->with('success', 'New Category is deleted successfully.');
    }
}
