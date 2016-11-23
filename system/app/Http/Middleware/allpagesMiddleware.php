<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class allpagesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            $fav_deals = \App\Model\FavDeal::find(Auth::user()->name);
            $my_fav_deal = array_map('intval', explode(',', $fav_deals->fav_deal));


            $my_fav_deals = \App\Model\ShareDeal::where('is_active','=',1)->where(function($query) use ($my_fav_deal){               
                 $query->whereIn('id', ($my_fav_deal));
            })->get();


            $my_fav_deals_total = \App\Model\ShareDeal::where('is_active','=',1)->where(function($query) use ($my_fav_deal){   

                 $query->whereIn('id', ($my_fav_deal));
            })->get(['original_price'])->sum('original_price');



            view()->share(['my_fav_deals' => $my_fav_deals, 'my_fav_deals_total' => $my_fav_deals_total]);

        }

        return $next($request);
    }
}
