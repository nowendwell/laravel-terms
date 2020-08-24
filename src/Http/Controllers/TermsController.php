<?php

namespace Nowendwell\LaravelTerms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nowendwell\LaravelTerms\Models\Term;
use Nowendwell\LaravelTerms\Events\AgreedToTerms;

class TermsController extends Controller
{
    public function show()
    {
        return view('terms::show', [
            'terms' => Term::latest('id')->first(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'terms' => 'required',
        ]);

        $term = Term::latest('id')->first();
        $request->user()->terms()->attach($term->id);

        event(new AgreedToTerms($request->user(), $term));

        return redirect()->route('home');
    }
}
