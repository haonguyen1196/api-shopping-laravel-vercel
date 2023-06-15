<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use App\Traits\DeleteModelTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageImageTrait;

class AdminSliderController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;

    private $slider;
    public function __construct(Slider $slider) {
        $this->slider = $slider;
    }
    public function index () 
    {
        $sliders = $this->slider->latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    public function create () 
    {
        return view('admin.slider.add');
    }

    public function store (SliderRequest $request) 
    {
        try {
            $dataInsert = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $dataImageUpload = $this->StorageTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataImageUpload)) {
                $dataInsert['image_name'] = $dataImageUpload['file_name'];
                $dataInsert['image_path'] = $dataImageUpload['file_path'];
            }
            $this->slider->create($dataInsert);
            return redirect()->route('admin.slider.index');
        } catch (Exception $exception) {
            Log::error('message:' . $exception->getMessage() . 'line:' . $exception->getLine());
        }
    }

    public function edit ($id) 
    {
        $slider = $this->slider->find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update ($id, UpdateSliderRequest $request) {
        try {
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->description,
            ];

            $dataImageUpload = $this->StorageTraitUpload($request, 'image_path', 'slider');
            if (!empty($dataImageUpload)) {
                $dataUpdate['image_name'] = $dataImageUpload['file_name'];
                $dataUpdate['image_path'] = $dataImageUpload['file_path'];
            }

            $this->slider->find($id)->update($dataUpdate);

            return redirect()->route('admin.slider.index');
        } catch (Exception $exception) {
            Log::error('message:' . $exception->getMessage() . 'line:' . $exception->getLine());
        }
    }

    public function delete ($id) 
    {
        $data = $this->deleteModelTrait($id, $this->slider);
        return $data;
    }
    
}
