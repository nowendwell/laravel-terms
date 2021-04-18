<?php

namespace Nowendwell\LaravelTerms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nowendwell\LaravelTerms\Events\AgreedToTerms;
use Nowendwell\LaravelTerms\LaravelTerms;

class TermsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(LaravelTerms $terms)
    {
        return view('terms::show', [
            'terms' => $terms->current(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, LaravelTerms $terms)
    {
        $request->validate([
            'terms' => 'required',
        ]);

        tap($terms->current(), function($term) use ($request) {

            $request->user()->terms()->attach($term);

            event(new AgreedToTerms($request->user(), $term));
        });

        return redirect()->intended();
    }
}
