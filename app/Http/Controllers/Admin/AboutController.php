<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Traits\uploadFileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    use uploadFileImage;
    public function __construct()
    {
        $this->setModel(About::class);
        $this->resourceName = 'abouts';
        $this->modelName = 'About';
        $this->validateRule = [
            'title' => 'required|string|bail',
            'thumbnail' => 'required|image|bail',
            'description' => 'required|string|bail',
        ];
        $this->views = [
            'index' => 'admin.about.index',
            'create' => 'admin.about.create',
        ];
        $this->middleware('auth');
        $this->middleware(['permission:About_list'], ['only' => ['index']]);
        $this->middleware(['permission:About_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:About_show'], ['only' => ['show']]);
        $this->middleware(['permission:About_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:About_delete'], ['only' => ['destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->startValidationProcess($request)) {
            $dataStore = [
                'title' => $request->title,
                'description' => $request->description,
                'quote' => $request->quote,
            ];
            $checkThumbnailOfAbout = $this->uploadImage('thumbnail', $request);
            if (!empty($checkThumbnailOfAbout)) {
                $dataStore['thumbnail'] = $checkThumbnailOfAbout['filePath'];
            }
            About::create($dataStore);
            return redirect()->route('about.index')->withToastSuccess('About Stored Successfully!');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('admin.about.edit', ['about' => $about]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        if ($this->startValidationProcess($request)) {
            $this->delteOldImageWhenUpdateWithCheckExists($request, 'thumbnail', $about);
            $dataUpdate = [
                'title' => $request->title,
                'description' => $request->description,
                'quote' => $request->quote
            ];
            $checkThumbnailOfAbout = $this->uploadImage('thumbnail', $request);
            if (!empty($checkThumbnailOfAbout)) {
                $dataUpdate['thumbnail'] = $checkThumbnailOfAbout['filePath'];
            }
            $about->update($dataUpdate);
            return redirect()->route('about.index')->withToastSuccess('About Updated Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        if (Storage::exists("/public" . str_replace("/storage", '', $about->thumbnail))) {
            unlink(storage_path("/app" . "/public" . str_replace("/storage", '', $about->thumbnail)));
        }
        $about->delete();
        return redirect()->route('about.index')->withToastSuccess('About Deleted Successfully!');
    }
}
