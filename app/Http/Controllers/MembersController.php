<?php

namespace App\Http\Controllers;

use App\Models\Membercategory;
use App\Models\Members;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MembersController extends Controller
{
    protected $member;
    public function __construct(Members $member)
    {
        $this->member = $member;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::orderBy('in_order', 'asc')->paginate(10);
        return view('backend.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commiteeCategories = Membercategory::latest()->where('member_commities', 1)->where('is_active', 1)->get();
        $memberCategories = Membercategory::latest()->where('member_commities', 0)->where('is_active', 1)->get();
        return view('backend.members.create', compact('memberCategories', 'commiteeCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member_count = Members::orderBy('in_order', 'desc')->first();
        $member_order = $member_count->in_order + 1;

        $this->validate($request, [
            'profile_photo' => 'required|mimes:png,jpg,jpeg',
            'name'    => 'required|array',
            'name.*'  => 'required|string',
            'email' => '',
            'contact_no'    => 'required|array',
            'contact_no.*'  => 'required|string',
            'address'    => 'required|array',
            'address.*'  => 'required|string',
            'position'    => 'required|array',
            'position.*'  => 'required|string',
            'member_category' => '',
            'commitee_category' => '',
            'member_subcategory' => '',
            'committee_subcategory' => '',
            'details'    => '',
            'details.*'  => '',

            'facebook' => '',
            'whatsapp' => '',
            'youtube' => '',
            'twitter' => '',
            'linkedin' => '',
        ]);

        $profile_photo = '';
        if($request->hasfile('profile_photo'))
        {
            $image = $request->file('profile_photo');
            $profile_photo = $image->store('profile_photo', 'uploads');
        }

        $new_member = Members::create([
            'profile_photo' => $profile_photo,
            'name' => $request['name'],
            'email' => $request['email'],
            'contact_no' => $request['contact_no'],
            'address' => $request['address'],
            'position' => $request['position'],
            'member_id' => $request['member_category'],
            'commitee_id' => $request['commitee_category'],
            'member_subcategory_id' => $request['member_subcategory'],
            'committee_subcategory_id' => $request['committee_subcategory'],
            'details' => $request['details'],

            'facebook' => $request['facebook'],
            'whatsapp' => $request['whatsapp'],
            'youtube' => $request['youtube'],
            'twitter' => $request['twitter'],
            'linkedin' => $request['linkedin'],

            'in_order' => $member_order,
        ]);

        $new_member->save();
        return redirect()->route('member.index')->with('success', 'Member information saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function show(Members $members)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $existing_member = Members::findorFail($id);
        $member_subcategories = SubCategory::where('category_id', $existing_member->member_id)->get();
        $committee_subcategories = SubCategory::where('category_id', $existing_member->commitee_id)->get();
        $commiteeCategories = Membercategory::latest()->where('member_commities', 1)->where('is_active', 1)->get();
        $memberCategories = Membercategory::latest()->where('member_commities', 0)->where('is_active', 1)->get();
        return view('backend.members.edit', compact('existing_member', 'memberCategories', 'commiteeCategories', 'member_subcategories', 'committee_subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existing_member = Members::findorFail($id);
        $this->validate($request, [
            'profile_photo' => 'mimes:png,jpg,jpeg',
            'name'    => 'required|array',
            'name.*'  => 'required|string',
            'email' => '',
            'contact_no'    => 'required|array',
            'contact_no.*'  => 'required|string',
            'address'    => 'required|array',
            'address.*'  => 'required|string',
            'position'    => 'required|array',
            'position.*'  => 'required|string',
            'member_category' => '',
            'commitee_category' => '',
            'member_subcategory' => '',
            'committee_subcategory' => '',
            'details'    => '',
            'details.*'  => '',

            'facebook' => '',
            'whatsapp' => '',
            'youtube' => '',
            'twitter' => '',
            'linkedin' => '',
        ]);

        $profile_photo = '';
        if($request->hasfile('profile_photo'))
        {
            Storage::disk('uploads')->delete($existing_member->profile_photo);
            $image = $request->file('profile_photo');
            $profile_photo = $image->store('profile_photo', 'uploads');
        }
        else
        {
            $profile_photo = $existing_member->profile_photo;
        }

        $existing_member->update([
            'profile_photo' => $profile_photo,
            'name' => $request['name'],
            'email' => $request['email'],
            'contact_no' => $request['contact_no'],
            'address' => $request['address'],
            'position' => $request['position'],
            'member_id' => $request['member_category'],
            'commitee_id' => $request['commitee_category'],
            'member_subcategory_id' => $request['member_subcategory'],
            'committee_subcategory_id' => $request['committee_subcategory'],
            'details' => $request['details'],

            'facebook' => $request['facebook'],
            'whatsapp' => $request['whatsapp'],
            'youtube' => $request['youtube'],
            'twitter' => $request['twitter'],
            'linkedin' => $request['linkedin'],
        ]);

        return redirect()->route('member.index')->with('success', 'Member information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Members  $members
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existing_member = Members::findorFail($id);
        Storage::disk('uploads')->delete($existing_member->profile_photo);
        $existing_member->delete();

        return redirect()->route('member.index')->with('success', 'Member information deleted successfully.');
    }

    public function updateMemberOrder(Request $request)
    {
        parse_str($request->sort, $arr);
        $order = 1;
        if (isset($arr['menuItem'])) {
            foreach ($arr['menuItem'] as $key => $value) {  //id //parent_id
                $this->member->where('id', $key)
                    ->update([
                        'in_order' => $order,
                    ]);
                $order++;
            }
        }

        return true;
    }

    public function getSubCategory($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json($subcategories);
    }
}
