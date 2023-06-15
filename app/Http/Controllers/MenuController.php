<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Http\Requests\AddMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class MenuController extends Controller
{
    private $menuRecusive;
    private $menu;
    public function __construct (MenuRecusive $menuRecusive, Menu $menu) {
        $this->menuRecusive = $menuRecusive;
        $this->menu = $menu;
    }
    public function index () 
    {
        $menus = $this->menu->paginate(5);
        return view('admin.menus.index', compact('menus'));
    }

    public function create () 
    {
        $optionSelect = $this->menuRecusive->menuRecusiveAdd();
        return view('admin.menus.add', compact('optionSelect'));
    }

    public function store (AddMenuRequest $request) 
    {
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name, '-'),
        ]);
        return redirect()->route('admin.menus.index');
    }

    public function edit ($id) 
    {
        $menuFollowItem = $this->menu->find($id);
        $optionSelect = $this->menuRecusive->menuRecusiveEdit($menuFollowItem->parent_id);
        return view('admin.menus.edit', compact('menuFollowItem', 'optionSelect'));
    }

    public function update ($id, UpdateMenuRequest $request) 
    {
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name. '-')
        ]);
        return redirect()->route('admin.menus.index');
    }

    public function delete ($id) 
    {
        $this->menu->find($id)->delete();
        return redirect()->route('admin.menus.index');
    }
}
