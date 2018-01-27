<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allNews = News::all();

        return view('admin.news.index', compact('allNews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateData($request);

        if ($request->hasFile('filename')) {
            $path = $request->filename->store('public/news');
        }

        if ($request->file('filename')->isValid()) {
            
            $validatedData = array_merge($validatedData, ['filename' => $request->filename->hashName()]);

            News::create($validatedData);

            flash('News has been saved!');

            return redirect()
                ->route('news.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        if ($request->hasFile('filename')) {
            $validatedData = $this->validateData($request);

            $path = $request->filename->store('public/news');
            

            if ($request->file('filename')->isValid()) {
                
                $validatedData = array_merge($validatedData, ['filename' => $request->filename->hashName()]);

                $news->update($validatedData);

                flash('News has been updated!');

                return redirect()
                    ->route('news.index');
            }
        }

        $validatedData =  $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
        ]);


        $news->update($validatedData);

        flash('News has been updated!');

        return redirect()
            ->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if($news->filename) {
            Storage::delete('public/news/'.$news->filename);
        }
                
        $news->delete();

        flash('The news has been deleted!');

        return redirect()
            ->route('news.index');
    }

    protected function validateData($request)
    {
        return $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
            'filename' => 'required|mimes:pdf,jpeg,bmp,png,doc,docx'
        ]);
    }

    public function deleteFile(News $news)
    {
        if($news->filename) {
            Storage::delete('public/news/'.$news->filename);
            $news->filename = '';
            $news->save();
            flash('The file has been deleted!');
        }

        return back();
    }
}
