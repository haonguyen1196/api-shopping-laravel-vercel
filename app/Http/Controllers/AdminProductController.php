<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminProductController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;

    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;

    public function getCategories ($parentId) 
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }

    public function __construct (Category $category, Product $product, ProductImage $productImage, ProductTag $productTag, Tag $tag) 
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->productTag = $productTag;
        $this->tag = $tag;
    }


    public function index () 
    {
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    public function create () 
    {
        $htmlOption = $this->getCategories($parentId = '');
        return view('admin.product.add', compact('htmlOption'));
    }

    public function store (ProductAddRequest $request) 
    {
        try {
            // using transaction start
            DB::beginTransaction();
            $productDataCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,         
            ];
            $dataUpload = $this->StorageTraitUpload($request, 'feature_image_path', 'product');
            $productDataCreate['feature_image_name'] = $dataUpload['file_name'];
            $productDataCreate['feature_image_path'] = $dataUpload['file_path'];
            $product = $this->product->create($productDataCreate);
    
            // insert data to product_images table
            if ($request->hasFile('image_path')) {
                foreach ($request->file('image_path') as $fileItem) {
                    $dataUploadImageDetail = $this->StorageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataUploadImageDetail['file_path'],
                        'image_name' => $dataUploadImageDetail['file_name'],
                    ]);
                }
            }
            // insert data to tags table
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
                $product->tags()->attach($tagIds);
            }
            // using transaction end
            DB::commit();
            return redirect()->route('admin.product.index');
        } catch (Exception $exception) {
            // using transaction callback when transaction dont success
            DB::rollBack();
            // log error
            Log::error('Message: ' . $exception->getMessage(). 'Line: ' . $exception->getLine());
        }
        
    }

    public function edit($id) 
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategories($product->category_id);
        return view('admin.product.edit', compact('htmlOption', 'product'));
    }

    public function update(UpdateProductRequest $request, $id) 
    {
        try {
            // using transaction start
            DB::beginTransaction();
            $productDataUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,         
            ];
            $dataUpload = $this->StorageTraitUpload($request, 'feature_image_path', 'product');
            if(!empty($dataUpload)) {
                $productDataUpdate['feature_image_name'] = $dataUpload['file_name'];
                $productDataUpdate['feature_image_path'] = $dataUpload['file_path'];
            }
            $product = $this->product->find($id);
            $product->update($productDataUpdate);
    
            // insert data to product_images table
            if ($request->hasFile('image_path')) {
                $product->images()->where('product_id', $id)->delete();
                foreach ($request->file('image_path') as $fileItem) {
                    $dataUploadImageDetail = $this->StorageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataUploadImageDetail['file_path'],
                        'image_name' => $dataUploadImageDetail['file_name'],
                    ]);
                }
            }
            // insert data to tags table
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
                $product->tags()->sync($tagIds);
            }
            // using transaction end
            DB::commit();
            return redirect()->route('admin.product.index');
        } catch (Exception $exception) {
            // using transaction callback when transaction dont success
            DB::rollBack();
            // log error
            Log::error('Message: ' . $exception->getMessage(). 'Line: ' . $exception->getLine());
        }
    }

    public function delete($id) 
    {
        $data = $this->deleteModelTrait($id, $this->product);
        return $data;
    }
}
