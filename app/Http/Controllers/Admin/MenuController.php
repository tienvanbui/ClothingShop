<?php

namespace App\Http\Controllers\Admin;

use App\Components\RecusiveMenu;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->resourceName = 'menus';
        $this->model = 'Menu';
        $this->validateRule = [
            'name' => 'max:20|required|string|bail',
        ];
        $this->views = [
            'index' => 'admin.menu.index',
        ];
        $this->model = Menu::class;
        $this->getEventValueName = "MenuListCached";
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::all();
        $menuRecusive = new RecusiveMenu($menu);
        $htmlOption = $menuRecusive->menuRecusive($parentID = '');
        return view('admin.menu.create')->with('htmlOption', $htmlOption);
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
            Menu::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]);
            return redirect()->route('menu.index')->withToastSuccess('Menu Created Successfully!');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $menus = Menu::all();
        $recusive = new RecusiveMenu($menus);
        $htmlOption = $recusive->menuRecusive($menu->parent_id);
        return view('admin.menu.edit', [
            'menu' => $menu,
            'htmlOption' => $htmlOption
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        if ($this->startValidationProcess($request)) {
            $menu->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]);
            return redirect()->route('menu.index')->withToastSuccess('Menu Updated Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        $menu->menus()->delete();
        return redirect()->route('menu.index')->withToastSuccess('Menu Deleted Successfully!');
    }
}
