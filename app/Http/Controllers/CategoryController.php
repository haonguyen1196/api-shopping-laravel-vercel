<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;

    public function getCategories ($parentId) 
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);

        return $htmlOption;
    }

    public function __construct (Category $category) 
    {
        $this->category = $category;
    }

    public function index () 
    {
        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }
    public function create () 
    {
        $htmlOption = $this->getCategories($parentId = '');

        return view('admin.category.add', compact( 'htmlOption' ) );
    }

    public function store (AddCategoryRequest $request) 
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name, '-'),
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function edit ($id) 
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategories($category->parent_id);
        return view('admin.category.edit', compact('htmlOption', 'category'));
    }

    public function update ($id,CategoryRequest $request) 
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name, '-'),
        ]);

        return redirect()->route('admin.categories.index');
    }

    public function delete ($id) 
    { 
        $this->category->find($id)->delete();
        return redirect()->route('admin.categories.index');
    } 

   

}
