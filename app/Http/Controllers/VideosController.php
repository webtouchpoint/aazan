<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
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
        $videos = Video::all();

        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create', [
            'video' => new Video,
            'allTags' => Tag::where('type', 'video')->get()
        ]);
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

        $video = Video::create($validatedData);

        if ($request->has('tags')) {
            $video->syncTags($request->tags);
        }

        flash('Video has been saved!');

        return redirect()
            ->route('videos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $allTags = Tag::where('type', 'video')->get();

        return view('admin.videos.edit', compact('video', 'allTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $validatedData = $this->validateData($request);

        $video->update($validatedData);
        
        if ($request->has('tags')) {
            $video->syncTags($request->tags);
        }

        flash('Video has been updated!');

        return redirect()
            ->route('videos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
    protected function validateData($request)
    {
        return $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
            'youtube_id' => 'required'
        ]);
    }
}
