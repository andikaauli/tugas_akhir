<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActiveInventarisasi
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
        if (empty(session('active_inventarisasi'))) {
            $http = new Request();
            $http = $http->create(config('app.api_url') . '/stockopname', 'GET');
            $response = app()->handle($http);
            $response = $response->getContent();

            $stockopname = json_decode($response);

            $stockopname = array_filter($stockopname, function ($item) {
                return !$item->end_date;
            });


            if ($stockopname) {
                $stockopname = current($stockopname);
                session(['active_inventarisasi' => $stockopname->id]);
            }
        };
        return $next($request);
    }
}
