<?php

namespace App\Http\Controllers;

use App\Models\Cta;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class CtaController extends Controller
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
            $child_pages = Cta::where("name", "like", "%$keyword%")->get();
        } else {
            $child_pages = Cta::all();
        }

        return view('admin.cta.index', compact('child_pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cta.create');
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

        $cta = new Cta;
        $cta->name = $requestData['name'];
        $cta->description = $requestData['description'];
        $cta->link = $requestData['link'];
        $cta->show = 1;
        if ($request->hasFile('image')) {
            checkImageDirectory("images");
            $cta->image = uploadFile($request, 'image', public_path('content/images'));
        }
        $cta->save();

        return redirect('admin/cta')->with('flash_message', 'Блок Call to action добавлен');
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
        $cta = Cta::findOrFail($id);
        return view('admin.cta.edit', compact('cta'));
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

        $cta = Cta::findOrFail($id);
        $cta->name = $requestData['name'];
        $cta->description = $requestData['description'];
        $cta->link = $requestData['link'];
        $cta->show = 1;
        if ($request->hasFile('image')) {
            checkImageDirectory("images");
            $cta->image = uploadFile($request, 'image', public_path('content/images'));
        }
        $cta->save();

        return redirect('admin/cta')->with('flash_message', 'Блок Call to action добавлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cta = Cta::findOrFail($id);

        $image_path = './public/content/images/'.$cta->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        Cta::destroy($id);

        return redirect('admin/cta')->with('flash_message', 'Call to action удален');
    }
}
