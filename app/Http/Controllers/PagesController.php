<?php

namespace App\Http\Controllers;

use App\EBook;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function showEBooks()
    {
    	$ebooks =  EBook::isLive()
    		->get();

    	return view('pages.ebooks', compact('ebooks'));
    }
}