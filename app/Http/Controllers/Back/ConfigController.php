<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Support\Str;


class ConfigController extends Controller
{
    public function index(){
        $config = Config::find(1);
        return view('back.config.index', compact('config'));
    }

    public function update(Request $request){

        $config = Config::find(1);
        $config->title = $request->title;
        $config->active = $request->active;
        $config->facebook = $request->facebook;
        $config->twitter = $request->twitter;
        $config->linkedn = $request->linkedn;
        $config->youtube = $request->youtube;
        $config->github = $request->github;
        $config->instagram = $request->instagram;

        if ($request->hasFile('logo'))
        {
            $logo_image_name = Str::slug($request->title).'_logo.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'), $logo_image_name);
            $config->logo = 'uploads/'.$logo_image_name;
        }

        if ($request->hasFile('favicon'))
        {
            $favicon_image_name  = Str::slug($request->title).'_favicon.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads'), $favicon_image_name);
            $config->favicon = 'uploads/'.$favicon_image_name;
        }

        $config->save();
        return redirect()->back()->with('message','Site ayarları güncellendi!');


    }
}
