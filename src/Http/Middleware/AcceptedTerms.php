<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AcceptedTerms
{
    public function handle(Request $request, Closure $next)
    {
        /*
        if (
            auth()->check() &&
            ! auth()->user()->hasAcceptedTerms() &&
            ! in_array($request->path(), config('terms.excluded_paths'))
        ) {
            session(['url.intended' => $request->url()]);
            return redirect()->route('terms.show');
        }
        */

        return $next($request);
    }
}
