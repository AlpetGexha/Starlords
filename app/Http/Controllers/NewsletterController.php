<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function __invoke(string $token)
    {
        $user = Newsletter::where('token', $token)->firstOrFail();
        $user->update(['is_subscribed' => true, 'token' => null]);
        return redirect()->route('homepage')->with('success', 'You have successfully subscribed to our newsletter');
    }
}
