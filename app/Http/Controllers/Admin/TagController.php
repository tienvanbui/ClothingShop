<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->setModel(Tag::class);
        $this->resourceName = 'tags';
        $this->views = [
            'index' => 'admin.tag.index',
            'create' => 'admin.tag.create'
        ];
        $this->middleware(['permission:Tag_list'], ['only' => ['index']]);
        $this->middleware(['permission:Tag_create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Tag_show'], ['only' => ['show']]);
        $this->middleware(['permission:Tag_update'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:Tag_delete'], ['only' => ['destroy']]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'tag_name' => 'required|string|bail'
        ]);
        $tag = new Tag();
        $tag->fill($request->all());
        $tag->save();
        return redirect()->route('tag.index')->withToastSuccess('Tạo mới thành công!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'tag_name' => 'required|string|bail'
        ]);
        Tag::where('id', $tag->id)->update([
            'tag_name' => $request->tag_name
        ]);
        return redirect()->route('tag.index')->withToastSuccess('Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tag.index')->withToastSuccess('Xóa thành công!');
    }
}
