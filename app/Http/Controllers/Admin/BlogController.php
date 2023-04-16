<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\uploadFileImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Tag;
use Illuminate\Validation\Rule;

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
            'blog_name' => 'required|max:255|bail',
            'blog_content' => 'required|bail',
            'thumbnail' => 'required|bail',
            'tags' => ['required', Rule::exists('tags', 'id')],
        ];
        $this->messageValidate = [
            'blog_name.required' => 'Tiêu đề tin tức không được trống.',
            'blog_name.max' => 'Tiêu đề tin tức tối đa 255 ký tự',
            'blog_content.required' => 'Nội dung tin tức không được trống.',
            'thumbnail.required' => 'Ảnh tin tức không được trống.',
            'tags.required' => 'Danh mục tin tức không được để trống.',
        ];
        $this->middleware('auth');
        $this->middleware(['permission:Blog_list'], ['only' => ['index']]);
        $this->middleware(['permission:Blog_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Blog_show'], ['only' => ['show']]);
        $this->middleware(['permission:Blog_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Blog_delete'], ['only' => ['destroy']]);
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
        $validator = $this->validate($request, $this->validateRule, $this->messageValidate);
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
            return redirect()->route('blog.index')->withToastSuccess('Tạo mới thành công!');
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

        $validator = $this->validate($request, $this->validateRule, $this->messageValidate);
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
            return redirect()->route('blog.index')->withToastSuccess('Cập nhật thành công!');
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
        return redirect()->route('blog.index')->withToastSuccess('Xóa thành công!');
    }
}
