<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Charge;
use Stripe\Stripe;

class Payment extends Component
{

    public $event;
    public $stripeTokenKey;

    public function mount($event)
    {
        $this->event = $event;
    }

    public function makePayment(Request $r)
    {
        // DB::transaction(function ($r) {
        //     Stripe::setApiKey(env('STRIPE_SECRET'));
        //     $charge = Charge::create([
        //         'source' => $r->stripeToken,
        //         'amount' => 1000,
        //         'currency' => "eur"
        //     ]);

        //     $this->event->tickets()->create([
        //         'user_id' => auth()->id(),
        //         'profile_id' => auth()->user()->profile->id,
        //         'stripe_id' => $charge->id,
        //         'date_expire' => $charge->created,
        //         'refund_date_expire' => $charge->created,
        //         'status' => 'paid'
        //     ]);
        // });
    }

    public function render()
    {
        return view('livewire.payment');
    }
}
