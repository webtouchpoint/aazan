<?php

namespace App\Http\Controllers;

use App\News;
use App\EBook;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function showEBooks()
    {
    	$ebooks =  EBook::latest()
            ->isLive()
    		->get();

    	return view('pages.ebooks', compact('ebooks'));
    }

    public function showNews()
    {
        $allNews =  News::latest()
            ->isLive()
            ->get();

        return view('pages.news', compact('allNews'));
    }

    public function showVideos()
    {
    	$videos =  Video::latest()
            ->isLive()
    		->get();

    	return view('pages.videos', compact('videos'));
    }

    public function showAboutPage() 
    {
        return view('pages.about');
    }

    public function showContactPage() 
    {
        return view('pages.contact');
    }

    public function sendContactMail(Request $request)
    {

        $v = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|regex:/[0-9]{10}/',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if ($v->fails())
        {
            return redirect('/contact')
                ->withInput()
                ->withErrors($v->errors());
        }

        Mail::to('nababmd786@gmail.com')->send(new \App\Mail\Contact($request));

        flash('You message has been sent successfully.');

        return redirect('/contact');
    }
}
