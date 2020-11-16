<?php

namespace App\Http\Controllers;

use App\Models\Banner;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class BannerController extends Controller
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
            $child_pages = Banner::where("name", "like", "%$keyword%")->get();
        } else {
            $child_pages = Banner::all();
        }

        return view('admin.banner.index', compact('child_pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
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
            'name'    => 'required|max:150',
            'image'   => 'required|image|mimes:jpeg,png,jpg,gif'
        ],
        [
            'name.required'  => 'Поле обязательное для заполнения',
            'image.required' => 'Добавьте изображение',
        ]);

        $requestData = $request->except(['_token']);

        $banner = new Banner;
        $banner->name = $requestData['name'];
        $banner->link = $requestData['link'];
        $banner->show = 1;
        if ($request->hasFile('image')) {
            checkImageDirectory("images");
            $banner->image = uploadFile($request, 'image', public_path('content/images'));
        }
        $banner->save();

        return redirect('admin/banner')->with('flash_message', 'Баннер добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'    => 'required|max:150',
            'image'   => 'image|mimes:jpeg,png,jpg,gif'
        ],
        [
            'name.required'  => 'Поле обязательное для заполнения',
        ]);

        $requestData = $request->except(['_token']);

        $cta = Banner::findOrFail($id);
        $cta->name = $requestData['name'];
        $cta->link = $requestData['link'];
        $cta->show = 1;
        if ($request->hasFile('image')) {
            checkImageDirectory("images");
            $cta->image = uploadFile($request, 'image', public_path('content/images'));
        }
        $cta->save();

        return redirect('admin/banner')->with('flash_message', 'Баннер обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        $image_path = './public/content/images/'.$banner->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        Banner::destroy($id);

        return redirect('admin/banner')->with('flash_message', 'Баннер удален');
    }
}
