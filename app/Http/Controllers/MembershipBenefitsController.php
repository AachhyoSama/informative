<?php

namespace App\Http\Controllers;

use App\Models\MembershipBenefits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MembershipBenefitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member_benefits = MembershipBenefits::first();
        return view('backend.membership_benefits.index', compact('member_benefits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.membership_benefits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MembershipBenefits  $membershipBenefits
     * @return \Illuminate\Http\Response
     */
    public function show(MembershipBenefits $membershipBenefits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MembershipBenefits  $membershipBenefits
     * @return \Illuminate\Http\Response
     */
    public function edit(MembershipBenefits $membershipBenefits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MembershipBenefits  $membershipBenefits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $member_benefits = MembershipBenefits::findorFail($id);
        $this->validate($request, [
            'cover_image' => 'mimes:png,jpg,jpeg',
            'title'    => 'required|array',
            'title.*'  => 'required|string',
            'descriptive_title'    => 'required|array',
            'descriptive_title.*'  => 'required|string',
            'content'    => 'required|array',
            'content.*'  => 'required|string',
        ]);

        $cover_image = '';
        if($request->hasfile('cover_image'))
        {
            $image = $request->file('cover_image');
            $cover_image = $image->store('cover_image', 'uploads');
        }
        else
        {
            $cover_image = $member_benefits->cover_image;
        }

        $member_benefits->update([
            'cover_image' => $cover_image,
            'title' => $request['title'],
            'descriptive_title' => $request['descriptive_title'],
            'content' => $request['content'],
        ]);

        return redirect()->back()->with('success', 'Benefit Information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MembershipBenefits  $membershipBenefits
     * @return \Illuminate\Http\Response
     */
    public function destroy(MembershipBenefits $membershipBenefits)
    {
        //
    }
}
