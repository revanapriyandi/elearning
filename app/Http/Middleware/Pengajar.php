<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Pengajar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->isPengajar() && !auth()->user()->isAdmin()) {
            return redirect()->back()->with('warning', 'Anda tidak memiliki akses ke halaman tersebut');
        }
        return $next($request);
    }
}
