<?php

namespace App\Http\Controllers;

use App\Models\Membercategory;
use App\Models\MemberPDF;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class MemberPDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $membersPDF = MemberPDF::latest()->paginate(10);
        return view('backend.members.memberpdf.index', compact('membersPDF'));
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
        return view('backend.members.memberpdf.create', compact('memberCategories', 'commiteeCategories'));
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
            'pdf_file' => 'required|mimes:pdf',
            'name'    => 'required|array',
            'name.*'  => 'required|string',
            'member_category' => '',
            'commitee_category' => '',
            'member_subcategory' => '',
            'committee_subcategory' => '',
            'is_active' => ''
        ]);

        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }

        $pdf_file = '';
        if($request->hasfile('pdf_file'))
        {
            $file = $request->file('pdf_file');
            $pdf_file = $file->store('pdf_file', 'uploads');
        }

        $member_pdf = MemberPDF::create([
            'pdf_file' => $pdf_file,
            'name' => $request['name'],
            'member_id' => $request['member_category'],
            'committee_id' => $request['commitee_category'],
            'member_subcategory_id' => $request['member_subcategory'],
            'committee_subcategory_id' => $request['committee_subcategory'],
            'is_active' => $active
        ]);

        $member_pdf->save();
        return redirect()->route('memberpdf.index')->with('success', 'Member PDF saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MemberPDF  $memberPDF
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MemberPDF  $memberPDF
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $memberPDF = MemberPDF::findorFail($id);
        $member_subcategories = SubCategory::where('category_id', $memberPDF->member_id)->get();
        $committee_subcategories = SubCategory::where('category_id', $memberPDF->committee_id)->get();
        $commiteeCategories = Membercategory::latest()->where('member_commities', 1)->where('is_active', 1)->get();
        $memberCategories = Membercategory::latest()->where('member_commities', 0)->where('is_active', 1)->get();
        return view('backend.members.memberpdf.edit', compact('memberPDF', 'memberCategories', 'commiteeCategories', 'member_subcategories', 'committee_subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MemberPDF  $memberPDF
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $memberPDF = MemberPDF::findorFail($id);
        $this->validate($request, [
            'pdf_file' => 'mimes:pdf',
            'name'    => 'required|array',
            'name.*'  => 'required|string',
            'member_category' => '',
            'commitee_category' => '',
            'member_subcategory' => '',
            'committee_subcategory' => '',
            'is_active' => ''
        ]);

        $active = 0;
        if($request['active'] != null)
        {
            $active = 1;
        }

        $pdf_file = '';
        if($request->hasfile('pdf_file'))
        {
            $file = $request->file('pdf_file');
            $pdf_file = $file->store('pdf_file', 'uploads');
        }
        else
        {
            $pdf_file = $memberPDF->pdf_file;
        }

        $memberPDF->update([
            'pdf_file' => $pdf_file,
            'name' => $request['name'],
            'member_id' => $request['member_category'],
            'committee_id' => $request['commitee_category'],
            'member_subcategory_id' => $request['member_subcategory'],
            'committee_subcategory_id' => $request['committee_subcategory'],
            'is_active' => $active
        ]);

        return redirect()->route('memberpdf.index')->with('success', 'Member PDF updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemberPDF  $memberPDF
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $memberPDF = MemberPDF::findorFail($id);
        $memberPDF->delete();

        return redirect()->route('memberpdf.index')->with('success', 'Member PDF deleted successfully.');
    }
}
