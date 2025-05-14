<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Http\Requests\Support\SendSupportRequest;
use App\Mail\SupportMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SupportController extends Controller
{
    // Show Contact form
    public function create()
    {
        return view('pages.support.create');
    }

    public function send(SendSupportRequest $request)
    {
        try {
            Mail::to('mhatrechaitanya123@gmail.com')->send(new SupportMail(
                Auth::user()->email,
                Auth::user()->email,
                $request->subject,
                $request->description
            ));

            // Prepare alert message
            session()->flash('alerts', [
                'success' => ['Your message sent successfully!']
            ]);

            return redirect()->back();
        } catch (\Exception $e) {

            // Log error message
            Log::error("Error sending support message: " . $e->getMessage());

            // Prepare alert message
            session()->flash('alerts', [
                'warning' => ['Something went wrong while sending your messages!']
            ]);

            return redirect()->back();
        }
    }
}
