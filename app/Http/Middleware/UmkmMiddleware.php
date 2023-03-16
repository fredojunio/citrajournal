<?php

namespace App\Http\Middleware;

use App\Models\Umkm;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UmkmMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $umkms = Umkm::where('user_id', Auth::user()->id);
            if (!empty($umkms[0])) {
                return $next($request);
            }

            return redirect()->to('umkm.index');
        }

        return redirect()->to('login');
    }
}
