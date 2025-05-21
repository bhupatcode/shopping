<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'user_message' => $request->message,
        ];

        // 1. Save to database
        Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'message' => $data['user_message'],
        ]);

        // 2. Send Email
        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->to('carolarental3@gmail.com')
                ->subject('New Contact Message from ' . $data['name']);
        });

        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
