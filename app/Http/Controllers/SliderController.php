<?php

namespace App\Http\Controllers;

use App\Models\Slider;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $child_pages = Slider::where("name", "like", "%$keyword%")->where('parent', 0)->orderBy('sort', 'asc')->get();
        } else {
            $child_pages = Slider::where('parent', 0)->orderBy('sort', 'asc')->get();
        }

        return view('admin.slider.index', compact('child_pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required|max:150'
        ],
        [
            'name.required'  => 'Поле обязательное для заполнения'
        ]);

        $requestData = $request->except(['_token']);

        $slider = new Slider;
        $slider->name = $requestData['name'];
        $slider->parent = 0;
        $slider->save();

        return redirect('admin/slider')->with('flash_message', 'Слайдер создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * List slides for main slider
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sliders($id)
    {
        $slider = Slider::findOrFail($id);
        $slider_slides = Slider::where('parent', $id)->orderBy('sort', 'asc')->get();
        $sort = '/admin/slider/sort';
        return view('admin.slider.sliders', compact('slider', 'slider_slides', 'sort'));
    }

    /**
     * Slide create
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function slide_create(Request $request, $id)
    {
        $this->validate($request, [
            'name'    => 'max:150',
            'image'   => 'required|image|mimes:jpeg,png,jpg,gif'
        ],
        [
            'name.required'  => 'Поле обязательное для заполнения',
            'image.required' => 'Добавьте изображение',
        ]);

        $requestData = $request->except(['_token']);

        $slide = new Slider;
        $slide->name = $requestData['name'];
        $slide->description = $requestData['description'];
        $slide->link = $requestData['link'];
        $slide->parent = $id;
        $slide->show = 1;
        if ($request->hasFile('image')) {
            checkImageDirectory("images");
            $slide->image = uploadFile($request, 'image', public_path('content/images'));
        }
        $slide->save();

        return redirect('admin/slider/sliders/'.$id)->with('flash_message', 'Слайд в слайдер добавлен');
    }

    

    /**
     * Slide delete
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function slide_delete(Request $request, $id)
    {
        $slide = Slider::findOrFail($id);
        $parent = $slide->parent;

        $image_path = './public/content/images/'.$slide->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        Slider::destroy($id);

        return redirect('admin/slider/sliders/'.$parent)->with('flash_message', 'Слайд удален');
    }

    /**
     * Sort slides list
     *
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request)
    {
        $requestData = $request->all();

        if($requestData['sort']){

            $list = explode("&", $requestData['sort']);

            foreach ($list as $key => $value) {
                $id = explode("=", $value);
                $page = Slider::findOrFail($id[1]);
                $page->sort = $key;
                $page->save();

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Slider::destroy($id);
        
        App\Models\Slider::where('parent', $id)->delete();

    }
}
