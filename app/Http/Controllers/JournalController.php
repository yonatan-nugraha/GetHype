<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class JournalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function showList() 
    {
    	return view('journals.index', [
    	]);
    }

    public function showDetail() 
    {
    	return view('journals.show', [
    	]);
    }
}
