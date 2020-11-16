<?php

namespace App\Http\Controllers;

use App\Models\Infography;

use Illuminate\Http\Request;

class InfographyController extends Controller
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
            $child_pages = Infography::where("name", "like", "%$keyword%")->where('parent', 0)->orderBy('sort', 'asc')->get();
        } else {
            $child_pages = Infography::where('parent', 0)->orderBy('sort', 'asc')->get();
        }

        return view('admin.infography.index', compact('child_pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.infography.create');
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

        $infography = new Infography;
        $infography->name = $requestData['name'];
        $infography->parent = 0;
        $infography->save();

        return redirect('admin/infography')->with('flash_message', 'Список иконок создан');
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
        $res= Infography::where('parent', $id)->delete();
        Infography::destroy($id);

        return redirect('admin/infography')->with('flash_message', 'Список иконок удален');
    }

    /**
     * List icons with text
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function infographes($id)
    {
        $infography_main = Infography::findOrFail($id);
        $infography_list = Infography::where('parent', $id)->orderBy('sort', 'asc')->get();
        $sort = '/admin/infography/sort';
        return view('admin.infography.infographes', compact('infography_main', 'infography_list', 'sort'));
    }

    /**
     * Slide create
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function infography_create(Request $request, $id)
    {
        $this->validate($request, [
            'name'   => 'max:150',
            'icon'   => 'required'
        ],
        [
            'name.required' => 'Поле обязательное для заполнения',
            'icon.required' => 'Добавьте иконку',
        ]);

        $requestData = $request->except(['_token']);

        $infography = new Infography;
        $infography->name = $requestData['name'];
        $infography->icon = $requestData['icon'];
        $infography->description = $requestData['description'];
        $infography->link = $requestData['link'];
        $infography->parent = $id;
        $infography->show = 1;

        $infography->save();

        return redirect('admin/infography/infographes/'.$id)->with('flash_message', 'Иконка добавлена');
    }

    

    /**
     * Slide delete
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function infography_delete(Request $request, $id)
    {
        $infography = Infography::findOrFail($id);
        $parent = $infography->parent;

        Infography::destroy($id);

        return redirect('admin/infography/infographes/'.$parent)->with('flash_message', 'Иконка удалена');
    }

    /**
     * Sort icon list
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
                $page = Infography::findOrFail($id[1]);
                $page->sort = $key;
                $page->save();

            }
        }
    }
}
