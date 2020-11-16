<?php

namespace App\Http\Controllers;

use App\Helpers\SettingHelper;

use App\Models\SettingType;
use App\Models\Setting;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting_types = SettingType::where('show', 1)->get();
        return view('admin.settings.index', compact('setting_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setting_types = SettingType::where('show', 1)->get();
        return view('admin.settings.create', compact('setting_types'));
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
            'type'   => 'required',
            'name'   => 'required|unique:setting',
            'value'  => 'required',
        ],
        [
            'type.required'  => 'Поле обязательное для заполнения',
            'name.required'  => 'Поле обязательное для заполнения',
            'name.unique'    => 'Такая настройка уже существует',
            'value.required' => 'Поле обязательное для заполнения',
        ]);

        $requestData = $request->all();
        
        $setting = Setting::create($requestData);

        return redirect('admin/settings')->with('flash_message', 'Настройка добавлена');
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
        $setting_types = SettingType::where('show', 1)->get();
        $setting = Setting::findOrFail($id);

        return view('admin.settings.edit', compact('setting', 'setting_types'));
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
            'type'   => 'required',
            'name'   => 'required|unique:setting',
            'value'  => 'required',
        ],
        [
            'type.required'  => 'Поле обязательное для заполнения',
            'name.required'  => 'Поле обязательное для заполнения',
            'name.unique'    => 'Такая настройка уже существует',
            'value.required' => 'Поле обязательное для заполнения',
        ]);

        $requestData = $request->all();
        
        $setting = Setting::findOrFail($id);
        $setting->update($requestData);

        return redirect('admin/settings')->with('flash_message', 'Настройка обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Setting::destroy($id);

        return redirect('admin/settings')->with('flash_message', 'Настройка удалена');
    }
}
