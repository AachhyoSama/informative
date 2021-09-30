<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisement = Advertisement::first();
        return view('backend.setting.advertisement_setting', compact('advertisement'));
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
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $advertisement = Advertisement::findorFail($id);
        $this->validate($request, [
            'header_advertisement' => '',
            'header_advertisement_url' => 'required',

            'middle_ad_one' => '',
            'middle_ad_one_url' => 'required',

            'middle_ad_two' => '',
            'middle_ad_two_url' => 'required',

            'middle_ad_three' => '',
            'middle_ad_three_url' => 'required',

            'middle_ad_four' => '',
            'middle_ad_four_url' => 'required',

            'main_advertisement' => '',
            'main_advertisement_url' => 'required'
        ]);

        // $show = 0;
        // if($request['is_show'] == 1)
        // {
        //     $show = $show + 1;
        // }

        // $opening_advertisement = '';
        // if($request->hasfile('opening_advertisement'))
        // {
        //     $image = $request->file('opening_advertisement');
        //     $opening_advertisement = $image->store('advertisement', 'uploads');
        // }else {
        //     $opening_advertisement = $advertisement->opening_advertisement;
        // }

        $header_advertisement = '';
        if($request->hasfile('header_advertisement'))
        {
            $image = $request->file('header_advertisement');
            $header_advertisement = $image->store('advertisement', 'uploads');
        }else {
            $header_advertisement = $advertisement->header_advertisement;
        }

        $middle_ad_one = '';
        if($request->hasfile('middle_ad_one'))
        {
            $image = $request->file('middle_ad_one');
            $middle_ad_one = $image->store('advertisement', 'uploads');
        }else {
            $middle_ad_one = $advertisement->middle_ad_one;
        }

        $middle_ad_two = '';
        if($request->hasfile('middle_ad_two'))
        {
            $image = $request->file('middle_ad_two');
            $middle_ad_two = $image->store('advertisement', 'uploads');
        }else {
            $middle_ad_two = $advertisement->middle_ad_two;
        }

        $middle_ad_three = '';
        if($request->hasfile('middle_ad_three'))
        {
            $image = $request->file('middle_ad_three');
            $middle_ad_three = $image->store('advertisement', 'uploads');
        }else {
            $middle_ad_three = $advertisement->middle_ad_three;
        }

        $middle_ad_four = '';
        if($request->hasfile('middle_ad_four'))
        {
            $image = $request->file('middle_ad_four');
            $middle_ad_four = $image->store('advertisement', 'uploads');
        }else {
            $middle_ad_four = $advertisement->middle_ad_four;
        }

        $main_advertisement = '';
        if($request->hasfile('main_advertisement'))
        {
            $image = $request->file('main_advertisement');
            $main_advertisement = $image->store('advertisement', 'uploads');
        }else {
            $main_advertisement = $advertisement->main_advertisement;
        }

        $advertisement->update([
            'header_advertisement' => $header_advertisement,
            'header_advertisement_url' => $request['header_advertisement_url'],

            'middle_ad_one' => $middle_ad_one,
            'middle_ad_one_url' => $request['middle_ad_one_url'],

            'middle_ad_two' => $middle_ad_two,
            'middle_ad_two_url' => $request['middle_ad_two_url'],

            'middle_ad_three' => $middle_ad_three,
            'middle_ad_three_url' => $request['middle_ad_three_url'],

            'middle_ad_four' => $middle_ad_four,
            'middle_ad_four_url' => $request['middle_ad_four_url'],

            'main_advertisement' => $main_advertisement,
            'main_advertisement_url' => $request['main_advertisement_url']
        ]);

        return redirect()->back()->with('success', 'Advertisement information is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        //
    }
}
