<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\uploadFileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Tag;
class BlogController extends Controller
{
    use uploadFileImage;
    public function __construct()
    {
        $this->setModel(Blog::class);
        $this->resourceName = 'blogs';
        $this->views = [
            'index' => 'admin.blog.index',
        ];
        $this->validateRule = [
            'blog_name' => 'required|string|unique:blogs,blog_name|bail',
            'blog_content' => 'required|bail',
            'thumbnail' => 'required|bail',
        ];
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.blog.create')->with('tags', $tags);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, $this->validateRule);
        if ($validator) {
            $dataStore = [
                'blog_name' => $request->blog_name,
                'blog_content' => $request->blog_content,
                'user_id' => auth()->user()->id,
                'outdate' => Carbon::now('Asia/Ho_Chi_Minh')->addMonth(1),
            ];
            $checkImgThumbnail = $this->uploadImage('thumbnail',  $request);
            if (!empty($checkImgThumbnail)) {
                $dataStore['thumbnail'] = $checkImgThumbnail['filePath'];
            }

            $blogStored = Blog::Create($dataStore);
            $blogStored->tags()->attach($request->tags);
            return redirect()->route('blog.index')->withToastSuccess('Blog Stored Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('admin.blog.show')->with('blog', $blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $tagAll = Tag::all();
        $blogHasTags = $blog->tags;
        return view('admin.blog.edit')->with([
            'blog' => $blog,
            'tagAll' => $tagAll,
            'BlogHasTag' => $blogHasTags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {

        $validator = $this->validate($request, $this->validateRule);
        if ($validator) {
            $this->delteOldImageWhenUpdateWithCheckExists($request, 'thumbnail', $blog);
            $dataUpdate = [
                'blog_name' => $request->blog_name,
                'blog_content' => $request->blog_content,
                'user_id' => auth()->user()->id,
                'outdate' => Carbon::now()->addMonth(1),
            ];
            $checkImgThumbnail = $this->uploadImage('thumbnail', $request);
            if (!empty($checkImgThumbnail)) {
                $dataUpdate['thumbnail'] = $checkImgThumbnail['filePath'];
            }
            $blog->update($dataUpdate);
            $blog->tags()->sync($request->tags);
            return redirect()->route('blog.index')->withToastSuccess('Blog Updated Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $this->delteOldImageWhenUpdateWithoutCheckExists('thumbnail', $blog);
        $blog->tags()->detach();
        $blog->delete();
        return redirect()->route('blog.index')->withToastSuccess('Blog Deleted successfully!');
    }
}
