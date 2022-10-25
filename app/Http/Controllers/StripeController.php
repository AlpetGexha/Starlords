<?php

namespace App\Http\Controllers;

use App\Jobs\sendMailToUserJob;
use App\Jobs\sendTicketJob;
use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Charge;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function form()
    {
        return view('stripe.form');
    }

    public function makePayment(Request $r)
    {
        $event = Event::where('id', $r->event)->first();
        // $data_before_event = Carbon::parse($event->date)->subDays(3);
        // if (Carbon::now()->gt($data_before_event))
        //     $data_before_event = null;
        // else
        //     $data_before_event = Carbon::parse($event->date)->addDays(3);


        DB::transaction(function () use ($r, $event) {
            $final_price = $event->price * $r->quantity;

            Stripe::setApiKey(env('STRIPE_SECRET'));
            // for ($i = 0; $i < $r->quantity; $i++) {
            $stripe = Charge::create([
                'source' => $r->stripeToken,
                'amount' => $final_price * 100,
                'currency' => "eur"
            ]);
            $ticket = Ticket::create([
                'email' => $r->email ? $r->email : auth()->user()->email,
                'user_id' => auth()->id(),
                'event_id' => $event->id,
                'profile_id' => $event->profile_id,
                'stripe_id' => $stripe->id,
                'stripe_token' => $r->stripeToken,
                'date_expire' => $event->end_date,
                'refund_date_expire' => null,
                'price' => $final_price,
                'status' => 'paid',
                'quantity' => $r->quantity
            ]);
        });

        return auth()->check()
            ? to_route('event.myticket')
            : to_route('homepage')->with('success', 'Payment successful!');
    }
}
// filter by organizaiton
