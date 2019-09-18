<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            "options" => Setting::where('category', 'website_setting')->get()
        );

        return view('settings.mainSetting', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->options)) :
            foreach ($request->options as $opt_name => $opt_value) {
                $where    = array('setting_name' => $opt_name);
                $status[] = Setting::updateOrCreate($where,[
                    'setting_value' => $opt_value,
                    'category'      => 'website_setting'
                ]);
            }
        else:
            $status = false;
        endif;

        return !empty($status) ? 
            redirect()->route('setting.index')->with('success', 'Success To Update Setting!'): 
            redirect()->route('setting.index')->with('error', 'Failed To Update Setting!');
        
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
        //
    }

    /**
     * get value of setting by their name.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function getSetting($name)
    {
        $setting = Setting::where('setting_name', $name)->first();

        return !empty($setting) ? $setting->setting_value : '-';
    }
}
