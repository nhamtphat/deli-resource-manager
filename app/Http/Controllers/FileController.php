<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Validator; 
use App\Models\File;
use App\Models\Category;

class FileController extends Controller
{
    private $model;
    public function __construct(File $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = $this->model->all();
        $data = [
            'files' => $files
        ];
        return view('user.files.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $data = [
            'categories' => $categories,
        ];
        return view('user.files.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->hasFile('file')) return 'file not ok';

        $rules = array(
            'file' => 'required|mimes:jpeg,bmp,png,ai,psd,svg,esp,psd,pdf,gif',
            'preview' => 'required|mimes:jpeg,bmp,png,gif',
        );
        $messages = array();
        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        // Filename to store
        $filenameWithExt = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // Upload Image
        $file_name = $request->file('file')->storeAs('public/files',$fileNameToStore);

        
        // Filename to store
        $previewnameWithExt = $request->file('preview')->getClientOriginalName();
        $previewname = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('preview')->getClientOriginalExtension();
        $previewNameToStore = $previewname.'_'.time().'.'.$extension;
        // Upload Image
        $preview_name = $request->file('preview')->storeAs('public/previews',$previewNameToStore);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'preview_img' => $previewNameToStore,
            'download_link' => $fileNameToStore,
            'category_id' => $request->category_id,
        ];
        $file = $this->model->create($data);

        return redirect()->route('files.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = $this->model->findOrFail($id);
        $data = [
            'file' => $file
        ];
        return redirect()->route('files.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = $this->model->findOrFail($id);
        $data = [
            'file' => $file
        ];
        return view('user.files.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $file = $this->model->findOrFail($id);
        $file->update($request->all());
        return redirect()->route('files.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = $this->model->findOrFail($id);
        Storage::delete('public/previews/'.$file->preview_img);
        Storage::delete('public/file/'.$file->download_link);
        $file->delete();
        return redirect()->route('files.index');
    }
}
