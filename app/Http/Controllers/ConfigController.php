<?php

namespace App\Http\Controllers;

use App\Config;
use App\Layout;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function getLayoutConfig(){
        $config = Layout::all();
        return view('admin.layout_config')->with('config', $config);
    }

    public function updateLayoutConfig(Request $request){
        $home = Layout::find(1);
        $listings = Layout::find(2);
        $agents = Layout::find(3);
        $contact = Layout::find(4);

        $home->layout_name = $request->home_layout;
        $listings->layout_name = $request->listing_layout;
        $agents->layout_name = $request->agents_layout;
        $contact->layout_name = $request->contact_layout;


        if($home->save() && $listings->save() && $agents->save() && $contact->save()){
            return redirect('/admin/config/layout')->with('layout_update', 'Layout Configuration Updated');
        }
    }

    public function getTemplateConfig(){
        return view('admin.template_config');
    }

    public function updateTemplateConfig(Request $request){
        if ($this->updateConfig($request->all())) {
            session()->flash('template_update', 'Template Config Updated');
            return redirect('/admin/config/template');
        }
    }

    public function updateConfig($config)
    {
        foreach ($this->getConfigProps() as $prop) {
            Config::where('name', '=', $prop)->update([
                'value' => $config[$prop]
            ]);
        }

        return true;
    }

    public function getConfigProps(){
        return Config::all()->pluck('name');
    }
}
