<?php

namespace App\Listeners;

use App\Events\UserReferred;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class RewardUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserReferred  $event
     * @return void
     */
    public function handle(UserReferred $event)
    {
        $referral = \App\Models\ReferralLink::find($event->referralId);
        if (!is_null($referral)) {
            \App\Models\ReferralRelationship::create(['referral_link_id' => $referral->id, 'user_id' => $event->user->id]);

        }
    }
}
