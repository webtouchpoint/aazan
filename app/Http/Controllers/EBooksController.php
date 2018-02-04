<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Ebook;
use Illuminate\Http\Request;
use App\Services\UploadManager;
use Illuminate\Support\Facades\Storage;

class EbooksController extends Controller
{
    protected $uploadManager;

    public function __construct(UploadManager $uploadManager)
    {
        $this->middleware(['auth', 'admin']);

        $this->uploadManager = $uploadManager;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ebooks = Ebook::all();

        return view('admin.ebooks.index', compact('ebooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ebooks.create', [
            'allTags' => Tag::where('type', 'ebook')->get()
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

        if ($request->file('filename')->isValid()) {
            
            $ebook = Ebook::create($validatedData);

            $this->uploadManager->upload($ebook, $request, 'public/ebooks');

            if ($request->has('tags')) {
                $ebook->syncTags($request->tags);
            }

            flash('Ebook has been saved!');

            return redirect()
                ->route('ebooks.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function show(Ebook $ebook)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Ebook $ebook)
    {
        $allTags = Tag::where('type', 'ebook')->get();

        return view('admin.ebooks.edit', compact('ebook', 'allTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ebook $ebook)
    {
        $validatedData =  $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
        ]);

        $ebook->update($validatedData);

        if ($request->hasFile('filename')) {
            if ($request->file('filename')->isValid()) {
                $this->uploadManager->upload($ebook, $request, 'public/ebooks');
            }
        }

        if ($request->has('tags')) {
            $ebook->syncTags($request->tags);
        }

        flash('Ebook has been updated!');

        return redirect()
            ->route('ebooks.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ebook  $ebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ebook $ebook)
    {
        if($ebook->filename) {
            Storage::delete('public/ebooks/'.$ebook->filename);
        }
                
        $ebook->delete();

        flash('Ebook has been deleted!');

        return redirect()
            ->route('ebooks.index');
    }

    public function deleteFile(Ebook $ebook)
    {
        if($ebook->filename) {
            Storage::delete('public/ebooks/'.$ebook->filename);
            $ebook->filename = '';
            $ebook->save();
            flash('The file has been deleted!');
        }

        return back();
    }

    protected function validateData($request)
    {
        return $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
            'filename' => 'required|mimes:pdf,jpeg,bmp,png'
        ]);
    }
}
