<?php

namespace App\Http\Controllers;

use App\EBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EBooksController extends Controller
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
        $ebooks = EBook::all();

        return view('admin.ebooks.index', compact('ebooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ebooks.create');
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
            $path = $request->filename->store('public/ebooks');
        }

        if ($request->file('filename')->isValid()) {
            
            $validatedData = array_merge($validatedData, ['filename' => $request->filename->hashName()]);

            EBook::create($validatedData);

            flash('EBook has been saved!');

            return redirect(route('ebooks.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EBook  $eBook
     * @return \Illuminate\Http\Response
     */
    public function show(EBook $eBook)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EBook  $eBook
     * @return \Illuminate\Http\Response
     */
    public function edit(EBook $eBook)
    {
        return view('admin.ebooks.edit', compact('eBook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EBook  $eBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EBook $eBook)
    {
        if ($request->hasFile('filename')) {
            $validatedData = $this->validateData($request);

            $path = $request->filename->store('public/ebooks');
            

            if ($request->file('filename')->isValid()) {
                
                $validatedData = array_merge($validatedData, ['filename' => $request->filename->hashName()]);

                $eBook->update($validatedData);

                flash('EBook has been updated!');

                return redirect(route('ebooks.index'));
            }
        }

        $validatedData =  $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'description' => 'required',
        ]);


        $eBook->update($validatedData);

        flash('EBook has been updated!');

        return redirect(route('ebooks.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EBook  $eBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(EBook $eBook)
    {
        if($eBook->filename) {
            Storage::delete('public/ebooks/'.$eBook->filename);
        }
                
        $eBook->delete();

        flash('The EBook has been deleted!');

        return redirect(route('ebooks.index'));
    }

    public function deleteFile(EBook $eBook)
    {
        if($eBook->filename) {
            Storage::delete('public/ebooks/'.$eBook->filename);
            $eBook->filename = '';
            $eBook->save();
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
