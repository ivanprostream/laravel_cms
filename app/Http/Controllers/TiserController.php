<?php

namespace App\Http\Controllers;

use App\Models\Tiser;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class TiserController extends Controller
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
            $child_pages = Tiser::where("name", "like", "%$keyword%")->where('parent', 0)->orderBy('sort', 'asc')->get();
        } else {
            $child_pages = Tiser::where('parent', 0)->orderBy('sort', 'asc')->get();
        }

        return view('admin.tiser.index', compact('child_pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tiser.create');
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

        $tiser = new Tiser;
        $tiser->name = $requestData['name'];
        $tiser->parent = 0;
        $tiser->save();

        return redirect('admin/tiser')->with('flash_message', 'Список картинок с текстом добавлен');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tiser::where('parent', $id)->delete();

        $tiser = Tiser::findOrFail($id);

        $image_path = './public/content/images/'.$tiser->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        Tiser::destroy($id);

        return redirect('admin/tiser')->with('flash_message', 'Список удален');
    }

    /**
     * List tisers
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tisers($id)
    {
        $tiser_main = Tiser::findOrFail($id);
        $tiser_list = Tiser::where('parent', $id)->orderBy('sort', 'asc')->get();
        $sort = '/admin/tiser/sort';
        return view('admin.tiser.tisers', compact('tiser_main', 'tiser_list', 'sort'));
    }

    /**
     * Slide create
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tiser_create(Request $request, $id)
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

        $tiser = new Tiser;
        $tiser->name = $requestData['name'];
        $tiser->description = $requestData['description'];
        $tiser->link = $requestData['link'];
        $tiser->parent = $id;
        $tiser->show = 1;
        if ($request->hasFile('image')) {
            checkImageDirectory("images");
            $tiser->image = uploadFile($request, 'image', public_path('content/images'));
        }
        $tiser->save();

        return redirect('admin/tiser/tisers/'.$id)->with('flash_message', 'Картинка с текстом добавлена');
    }

    

    /**
     * Tiser delete
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tiser_delete(Request $request, $id)
    {
        $tiser = Tiser::findOrFail($id);
        $parent = $tiser->parent;

        $image_path = './public/content/images/'.$tiser->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        Tiser::destroy($id);

        return redirect('admin/tiser/tisers/'.$parent)->with('flash_message', 'Картинка с текстом удалена');
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
                $page = Tiser::findOrFail($id[1]);
                $page->sort = $key;
                $page->save();

            }
        }
    }
}
