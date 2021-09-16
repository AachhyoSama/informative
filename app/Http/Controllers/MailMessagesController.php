<?php

namespace App\Http\Controllers;

use App\Models\MailMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unread_messages = MailMessages::where('is_read', 0)->get();
        foreach ($unread_messages as $unread) {
            $unread->update(['is_read' => 1]);
        }
        $messages = MailMessages::latest()->paginate(10);
        return view('backend.contact_mails.index', compact('messages'));
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
        $new_mail = MailMessages::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'contact_no' => $request['contact_no'],
            'subject' => $request['subject'],
            'message' => $request['message'],
            'is_read' => 0,
        ]);

        $data['email'] = $request['email'];
        $data['name'] = $request['name'];

        Mail::send('emails.customerMail', $data, function($message)use($data)
        {
            $message->to($data["email"])
                    ->subject("Message Received.");
        });

        $new_mail->save();

        return redirect()->back()->with('success', 'Thank you for your mail. We will get back to you soon.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MailMessages  $mailMessages
     * @return \Illuminate\Http\Response
     */
    public function show(MailMessages $mailMessages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MailMessages  $mailMessages
     * @return \Illuminate\Http\Response
     */
    public function edit(MailMessages $mailMessages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MailMessages  $mailMessages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MailMessages $mailMessages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MailMessages  $mailMessages
     * @return \Illuminate\Http\Response
     */
    public function destroy(MailMessages $mailMessages)
    {
        //
    }
}
