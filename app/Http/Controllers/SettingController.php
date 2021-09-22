<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\MissionMessages;
use App\Models\Province;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::first();
        $provinces = Province::all();
        $districts = District::where('province_id', $setting->province_no)->get();
        return view('backend.setting.company_setting', compact('setting', 'provinces', 'districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    public function socialMedia()
    {
        $setting = Setting::first();
        return view('backend.setting.socialmedia', compact('setting'));
    }

    public function aboutUs()
    {
        $setting = Setting::first();
        return view('backend.setting.aboutus', compact('setting'));
    }

    public function missionVision()
    {
        $mission = MissionMessages::first();
        return view('backend.setting.welcome_message', compact('mission'));
    }

    public function updateMissionVision(Request $request, $id)
    {
        $mission = MissionMessages::findorFail($id);

        $this->validate($request, [
            'mission_vision' => 'required',
            'founder_message' => 'required',
            'welcome_title' => 'required',
            'welcome_sub_title' => 'required',
            'welcome_message' => 'required'
        ]);

        $mission->update([
            'mission_vision' => $request['mission_vision'],
            'founder_message' => $request['founder_message'],
            'welcome_title' => $request['welcome_title'],
            'welcome_sub_title' => $request['welcome_sub_title'],
            'welcome_message' => $request['welcome_message']
        ]);

        return redirect()->back()->with('success', 'Mission and messages updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::findorFail($id);
        if(isset($_POST['companySetting']))
        {
            $this->validate($request, [
                'company_name'    => 'required|array',
                'company_name.*'  => 'required|string',
                'email' => 'required|email',
                'contact_no'    => 'required|array',
                'contact_no.*'  => 'required|string',
                'pan_vat' => 'required',
                'province' => 'required',
                'district' => 'required',
                'local_address'    => 'required|array',
                'local_address.*'  => 'required|string',
                'company_logo' => 'mimes:jpg,png,jpeg',
                'footer_logo' => 'mimes:jpg,png,jpeg',
                'company_favicon' => 'mimes:jpg,png,jpeg',
                'projects_completed'    => 'required|array',
                'projects_completed.*'  => 'required|string',
                'clients_satisfied'    => 'required|array',
                'clients_satisfied.*'  => 'required|string',
                'award_winner'    => 'required|array',
                'award_winner.*'  => 'required|string',

                'meta_title'  => '',
                'meta_keywords'  => '',
                'meta_description'  => '',
                'og_image' => 'mimes:png,jpg,jpeg',
            ]);
            // dd($request['projects_completed']);

            $company_logo = '';
            if($request->hasfile('company_logo'))
            {
                $image = $request->file('company_logo');
                $company_logo = $image->store('company_logo', 'uploads');
            }else {
                $company_logo = $setting->company_logo;
            }

            $footer_logo = '';
            if($request->hasfile('footer_logo'))
            {
                $image = $request->file('footer_logo');
                $footer_logo = $image->store('footer_logo', 'uploads');
            }else {
                $footer_logo = $setting->footer_logo;
            }

            $og_image = '';
            if($request->hasfile('og_image'))
            {
                $image = $request->file('og_image');
                $og_image = $image->store('og_image', 'uploads');
            }else {
                $og_image = $setting->og_image;
            }

            $company_favicon = '';
            if($request->hasfile('company_favicon'))
            {
                $image = $request->file('company_favicon');
                $company_favicon = $image->store('company_favicon', 'uploads');
            }else {
                $company_favicon = $setting->company_favicon;
            }

            $setting->update([
                'company_name' => $request['company_name'],
                'email' => $request['email'],
                'contact_no' => $request['contact_no'],
                'pan_vat' => $request['pan_vat'],
                'province_no' => $request['province'],
                'district_no' => $request['district'],
                'local_address' => $request['local_address'],
                'company_logo' => $company_logo,
                'footer_logo' => $footer_logo,
                'company_favicon' => $company_favicon,
                'projects_completed' => $request['projects_completed'],
                'clients_satisfied' => $request['clients_satisfied'],
                'award_winner' => $request['award_winner'],

                'meta_title' => $request['meta_title'],
                'meta_keywords' => $request['meta_keywords'],
                'meta_description' => $request['meta_description'],
                'og_image' => $og_image,
            ]);
        }
        elseif (isset($_POST['socialMedia']))
        {
            $this->validate($request, [
                'facebook' => '',
                'instagram' => '',
                'whatsapp' => '',
                'youtube' => '',
                'twitter' => '',
            ]);

            $setting->update([
                'facebook' => $request['facebook'],
                'instagram' => $request['instagram'],
                'whatsapp' => $request['whatsapp'],
                'youtube' => $request['youtube'],
                'twitter' => $request['twitter'],
            ]);
        }
        elseif (isset($_POST['about_us']))
        {
            $this->validate($request, [
                'aboutUs'    => 'required|array',
                'aboutUs.*'  => 'required|string',
                'from_day' => 'required',
                'to_day' => 'required',
                'opening_time' => 'required',
                'closing_time' => 'required',
                'map_url' => 'required'
            ]);

            $setting->update([
                'aboutus' => $request['aboutUs'],
                'from_day' => $request['from_day'],
                'to_day' => $request['to_day'],
                'opening_time' => $request['opening_time'],
                'closing_time' => $request['closing_time'],
                'map_url' => $request['map_url'],
            ]);
        }

        return redirect()->back()->with('success', 'Setting information successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function getdistricts($id)
    {
        $districts = District::where('province_id', $id)->get();
        return response()->json($districts);
    }
}
