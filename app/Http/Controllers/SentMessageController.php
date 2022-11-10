<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SentMessageController extends Controller
{
    public function sentMessage(Request $request)
    {
        // $request->validate([
        //     'mobile'=> 'required|min:11'
        // ]);
        $sid = "AC64d292d901542836678862c5a1909281"; // Your Account SID from www.twilio.com/console
        $token = "3b2b89b30e127e5b4fe0146a3905f53f"; // Your Auth Token from www.twilio.com/console

        $client = new Client($sid, $token);
        $message = $client->messages->create(
        '+88'.$request->mobile, // Text this number
        [
            'from' => '+17155046860', // From a valid Twilio number
            'body' => $request->message
        ]
        );

        if ($message->sid) {
            return redirect()->back()->with('success', "SMS Sent Successfully!");
        }else {
            return redirect()->back()->with('error', "SMS Sent Failed!");
        }
    }
}
