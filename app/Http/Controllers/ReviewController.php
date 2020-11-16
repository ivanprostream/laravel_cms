<?php

namespace App\Http\Controllers;

use App\Models\Review;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ReviewController extends Controller
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
            $child_pages = Review::where("name", "like", "%$keyword%")->get();
        } else {
            $child_pages = Review::all();
        }

        return view('admin.review.index', compact('child_pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.review.create');
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

        $review = new Review;
        $review->name = $requestData['name'];
        $review->review = $requestData['review'];
        $review->link = $requestData['link'];
        $review->show = 1;
        if ($request->hasFile('image')) {
            checkImageDirectory("images");
            $review->image = uploadFile($request, 'image', public_path('content/images'));
        }
        $review->save();

        return redirect('admin/review')->with('flash_message', 'Отзыв добавлен');
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
        $review = Review::findOrFail($id);
        return view('admin.review.edit', compact('review'));
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

        $review = Review::findOrFail($id);
        $review->name = $requestData['name'];
        $review->review = $requestData['review'];
        $review->link = $requestData['link'];
        $review->show = 1;
        if ($request->hasFile('image')) {
            checkImageDirectory("images");
            $review->image = uploadFile($request, 'image', public_path('content/images'));
        }
        $review->save();

        return redirect('admin/review')->with('flash_message', 'Блок Call to action добавлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        $image_path = './public/content/images/'.$review->image;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        Review::destroy($id);

        return redirect('admin/review')->with('flash_message', 'Отзыв удален');
    }
}
