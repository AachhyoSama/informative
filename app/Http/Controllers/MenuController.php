<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    protected $menu;
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_items = Menu::orderBy('position', 'asc')->paginate(10);
        return view('backend.menu.index', compact('menu_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu_categories = MenuCategory::latest()->get();
        $parent_menus = Menu::where('parent_id', null)->get();
        return view('backend.menu.create', compact('menu_categories', 'parent_menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu_count = Menu::all()->count();

        $this->validate($request, [
            'name'    => 'required|array',
            'name.*'  => 'required|string',
            'menu_category' => 'required',
            'main_child' => 'required',
            'parent_id' => '',
            'show_in' => '',

            'meta_title'  => '',
            'meta_keywords'  => '',
            'meta_description'  => '',
            'og_image' => 'mimes:png,jpg,jpeg',
        ]);

        $parent_id = NULL;
        $show_in = 1;
        if($request['main_child'] == 1)
        {
            $parent_id = $request['parent_id'];
        }
        else if($request['main_child'] == 0)
        {
            $show_in = $request['show_in'];
        }

        $og_image = '';
        if($request->hasfile('og_image'))
        {
            $image = $request->file('og_image');
            $og_image = $image->store('og_image', 'uploads');
        }

        $new_menu = Menu::create([
            'name' => $request['name'],
            'slug' => Str::slug($request->name['en']),
            'position' => $menu_count + 1,
            'category_slug' => $request['menu_category'],
            'main_child' => $request['main_child'],
            'parent_id' => $parent_id,
            'header_footer' => $show_in,
            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'og_image' => $og_image,
        ]);

        $new_menu->save();
        return redirect()->route('menu.index')->with('success', 'Menu information is saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::findorFail($id);
        $menu_categories = MenuCategory::latest()->get();
        $parent_menus = Menu::where('parent_id', null)->get();
        return view('backend.menu.edit', compact('menu', 'menu_categories', 'parent_menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $menu = Menu::findorFail($id);
        $this->validate($request, [
            'name'    => 'required|array',
            'name.*'  => 'required|string',
            'menu_category' => 'required',
            'main_child' => 'required',
            'parent_id' => '',
            'show_in' => '',
            'meta_title'  => '',
            'meta_keywords'  => '',
            'meta_description'  => '',
            'og_image' => 'mimes:png,jpg,jpeg',
        ]);

        $parent_id = NULL;
        $show_in = 1;
        if($request['main_child'] == 1)
        {
            $parent_id = $request['parent_id'];
        }
        else if($request['main_child'] == 0)
        {
            $show_in = $request['show_in'];
        }

        $og_image = '';
        if($request->hasfile('og_image'))
        {
            $image = $request->file('og_image');
            $og_image = $image->store('og_image', 'uploads');
        }
        else
        {
            $og_image = $menu->og_image;
        }

        $menu->update([
            'name' => $request['name'],
            'slug' => Str::slug($request->name['en']),
            'category_slug' => $request['menu_category'],
            'main_child' => $request['main_child'],
            'parent_id' => $parent_id,
            'header_footer' => $show_in,
            'meta_title' => $request['meta_title'],
            'meta_keywords' => $request['meta_keywords'],
            'meta_description' => $request['meta_description'],
            'og_image' => $og_image,
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu information is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $menu = Menu::findorFail($id);
        $child_menus = Menu::where('parent_id', $menu->id)->get();
        if(count($child_menus) > 0)
        {
            return redirect()->back()->with('error', 'This menu contains child menus.');
        }
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu information is deleted successfully.');
    }

    public function updateMenuOrder(Request $request)
    {
        parse_str($request->sort, $arr);
        $order = 1;
        if (isset($arr['menuItem'])) {
            foreach ($arr['menuItem'] as $key => $value) {  //id //parent_id
                $this->menu->where('id', $key)
                    ->update([
                        'position' => $order,
                        'parent_id' => ($value == "null") ? NULL : $value,
                        'main_child' => ($value == "null") ? 0 : 1,
                    ]);
                $order++;
            }
        }

        return true;
    }

    private function update_child($id)
    {
        $menus = Menu::where('parent_id', $id)->get();
        if ($menus->count() > 1) {
            foreach ($menus as $child) {
                Menu::where('id', $child->id)->update(['parent_id' => $child->id]);
                $this->update_child($child->id);
            }
            // $this->forgetMenuCache();
        }
    }
}
