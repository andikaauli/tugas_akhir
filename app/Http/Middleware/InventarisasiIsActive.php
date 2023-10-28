<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InventarisasiIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $active = true)
    {
        if (filter_var($active, FILTER_VALIDATE_BOOLEAN)) {
            if (empty(session('active_inventarisasi'))) {
                abort(403, 'Belum Ada Inventarisasi Yang Aktif');
            }
        } else {
            if (session('active_inventarisasi')) {
                return redirect(route('client.active-inventarisasi'));
                abort(403, 'Inventarisasi Sedang Aktif');
            }
        }
        return $next($request);
    }
}
