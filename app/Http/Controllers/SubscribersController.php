<?php

namespace App\Http\Controllers;

use App\Models\Subscribers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unread_subscribers = Subscribers::where('is_read', 0)->get();
        foreach ($unread_subscribers as $unread) {
            $unread->update(['is_read' => 1]);
        }
        $subscribers = Subscribers::latest()->paginate(10);
        return view('backend.contact_mails.subscribers', compact('subscribers'));
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
        $existing_subscriber = Subscribers::where('email', $request['email'])->first();
        if ($existing_subscriber) {
            return redirect()->back()->with('success', 'You have already subscribed.');
        }
        $new_subscriber = Subscribers::create([
            'email' => $request['email'],
            'is_read' => 0
        ]);

        $data['email'] = $request['email'];
        Mail::send('emails.subscriberMail', $data, function($message)use($data)
        {
            $message->to($data["email"])
                    ->subject("Subscribed Confirmation");
        });

        $new_subscriber->save();
        return redirect()->back()->with('success', 'Thank you for your mail. We will get back to you soon.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscribers  $subscribers
     * @return \Illuminate\Http\Response
     */
    public function show(Subscribers $subscribers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscribers  $subscribers
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscribers $subscribers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscribers  $subscribers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscribers $subscribers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscribers  $subscribers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscribers $subscribers)
    {
        //
    }
}
