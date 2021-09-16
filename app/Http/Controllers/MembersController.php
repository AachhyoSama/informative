<?php

namespace App\Http\Controllers;

use App\Models\Membercategory;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::latest()->paginate(10);
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
        // dd($request->all());
        $this->validate($request, [
            'profile_photo' => 'required|mimes:png,jpg,jpeg',
            'name'    => 'required|array',
            'name.*'  => 'required|string',
            'email' => 'required|email',
            'contact_no'    => 'required|array',
            'contact_no.*'  => 'required|string',
            'address'    => 'required|array',
            'address.*'  => 'required|string',
            'position'    => 'required|array',
            'position.*'  => 'required|string',
            'member_category' => '',
            'commitee_category' => '',
            'details'    => 'required|array',
            'details.*'  => 'required|string',

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
            'details' => $request['details'],

            'facebook' => $request['facebook'],
            'whatsapp' => $request['whatsapp'],
            'youtube' => $request['youtube'],
            'twitter' => $request['twitter'],
            'linkedin' => $request['linkedin'],
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
        $commiteeCategories = Membercategory::latest()->where('member_commities', 1)->where('is_active', 1)->get();
        $memberCategories = Membercategory::latest()->where('member_commities', 0)->where('is_active', 1)->get();
        return view('backend.members.edit', compact('existing_member', 'memberCategories', 'commiteeCategories'));
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
            'email' => 'required|email',
            'contact_no'    => 'required|array',
            'contact_no.*'  => 'required|string',
            'address'    => 'required|array',
            'address.*'  => 'required|string',
            'position'    => 'required|array',
            'position.*'  => 'required|string',
            'member_category' => '',
            'commitee_category' => '',
            'details'    => 'required|array',
            'details.*'  => 'required|string',

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
}
