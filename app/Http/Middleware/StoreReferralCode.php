<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ReferralLink;


class StoreReferralCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        if ($request->has('refer')){
            $referral = ReferralLink::whereCode($request->get('refer'))->first();
            $response->cookie('refer', $referral->id, $referral->lifetime_minutes);
        }

        return $response;
    }
}
