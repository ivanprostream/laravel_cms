<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Models\Page;
use App\Models\PageType;
use App\Models\PageGallery;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $child_pages = Page::where('parent', 0)->orderBy('sort', 'asc')->get();
        $sort = '/admin/pages/sort';
        return view('admin.pages.structure', compact('child_pages', 'sort'));
    }

     /**
     * Sort pages list
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
                $page = Page::findOrFail($id[1]);
                $page->sort = $key;
                $page->save();

            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = PageType::all();
        $allpages = Page::all();
        return view('admin.pages.create', compact('types', 'allpages'));
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
            'url'     => 'required|unique:page,url',
            'title'    => 'max:250',
            'description' => 'max:255',
            'key_words' => 'max:255',
            'image'    => 'image|mimes:jpeg,png,jpg,gif'
        ],
        [
            'name.required'  => 'Поле обязательное для заполнения',
            'url.required'  => 'Поле обязательное для заполнения',
            'url.unique'    => 'Такой URL уже есть',
            'description.max' => '225 символов максимальное значение поля',
            'key_words.max' => '225 символов максимальное значение поля',
        ]);

        $requestData = $request->except(['_token']);

        $page = new Page;
        $page->name = $requestData['name'];
        $page->parent = empty($requestData['parent']) ? 0 : $requestData['parent'];
        $page->url = Str::slug($requestData['url'], '_');
        $page->short_text = $requestData['short_text'];
        $page->text = $requestData['text'];
        $page->text_2 = $requestData['text_2'];
        if ($request->hasFile('image')) {
            checkImageDirectory("images");
            $page->image = uploadFile($request, 'image', public_path('content/images'));
        }
        $page->path = $this->createPagePath($page->parent, $page->url);
        $page->title = $requestData['title'];
        $page->description = $requestData['description'];
        $page->key_words = $requestData['key_words'];
        $page->type = $requestData['type'];
        $page->menu = $requestData['menu'];
        $page->script = $requestData['script'];
        $page->save();

        if($page->parent == 0){
            return redirect('admin/structure')->with('flash_message', 'Страница создана');
        }else{
            return redirect()->route('pages.show', $page->parent)->with('flash_message', 'Страница создана');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);
        $child_pages = Page::where('parent', $id)->orderBy('sort', 'asc')->get();
        $sort = '/admin/pages/sort';
        $gallery = PageGallery::where('page', $id)->get();
        return view('admin.pages.show', compact('page', 'child_pages', 'sort', 'gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $page = Page::findOrFail($id);
        $types = PageType::all();
        $allpages = Page::all();
        return view('admin.pages.edit', compact('page', 'types', 'allpages'));
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
            'url'     => 'required|unique:page,url,' . $id . ',id',
            'title'    => 'max:250',
            'description' => 'max:255',
            'key_words' => 'max:255',
            'image'    => 'image|mimes:jpeg,png,jpg,gif'
        ],
        [
            'name.required'  => 'Поле обязательное для заполнения',
            'url.required'  => 'Поле обязательное для заполнения',
            'url.unique'    => 'Такой URL уже есть',
            'description.max' => '225 символов максимальное значение поля',
            'key_words.max' => '225 символов максимальное значение поля',
        ]);

        $requestData = $request->except(['_token']);

        $page = Page::findOrFail($id);
        $page->name = $requestData['name'];
        $page->parent = empty($requestData['parent']) ? 0 : $requestData['parent'];
        $page->url = Str::slug($requestData['url'], '_');
        $page->short_text = $requestData['short_text'];
        $page->text = $requestData['text'];
        $page->text_2 = $requestData['text_2'];
        if ($request->hasFile('image')) {
            checkImageDirectory("images");
            $page->image = uploadFile($request, 'image', public_path('content/images'));
        }
        $page->path = $this->createPagePath($page->parent, $page->url);
        $page->title = $requestData['title'];
        $page->description = $requestData['description'];
        $page->key_words = $requestData['key_words'];
        $page->type = $requestData['type'];
        $page->menu = $requestData['menu'];
        $page->script = $requestData['script'];
        $page->save();

        return redirect('admin/pages')->with('flash_message', 'Страница обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Image gallery page
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gallery($id)
    {
        $page = Page::findOrFail($id);
        $gallery = PageGallery::where('page', $id)->orderBy('sort')->get();
        $sort = '/admin/pages/sort_gallery';
        return view('admin.pages.gallery', compact('gallery', 'id', 'page', 'sort'));
    }

    /**
     * Sort gallery images
     *
     * @return \Illuminate\Http\Response
     */
    public function sort_gallery(Request $request)
    {
        $requestData = $request->all();

        if($requestData['sort']){

            $list = explode("&", $requestData['sort']);

            foreach ($list as $key => $value) {
                $id = explode("=", $value);
                $page = PageGallery::findOrFail($id[1]);
                $page->sort = $key;
                $page->save();

            }
        }
    }

    

    /**
     * Image gallery image create
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gallery_create(Request $request, $id)
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

        $gallery = new PageGallery;
        $gallery->name = $requestData['name'];
        $gallery->page = $id;
        $gallery->show = 1;
        if ($request->hasFile('image')) {
            checkImageDirectory("images");
            $gallery->image = uploadFile($request, 'image', public_path('content/images'));
        }
        $gallery->save();

        return redirect('admin/pages/gallery/'.$id)->with('flash_message', 'Изображение в галерею добавлено');
    }

    /**
     * Image gallery image create
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gallery_delete(Request $request, $id)
    {
        $gallery = PageGallery::findOrFail($id);
        $page = $gallery->page;

        $image_path = './public/content/images/'.$gallery->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        PageGallery::destroy($id);

        return redirect('admin/pages/gallery/'.$page)->with('flash_message', 'Изображение удалено из галереи');
    }


    


    public function createPagePath($parent, $url)
    {
        if(empty($parent))
        {
          return $url;
        }else{
          $page = Page::findOrFail($parent);  
          return $page->path.'/'.$url;
        }
    }

}
