<?php

namespace App\Http\Controllers;

use App\Models\master_routes_url;
use Illuminate\Http\Request;

class master_routes_urlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dd("hell");
        //
        $master_route  = master_routes_url::all();
        // dd($master_route);
        return view('master_routes_url.index',[
            'master_route'=>$master_route,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master_routes_url.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         
        $request->validate([  
            'url_name'=>'required',  
            'url'=>'required',  
           
        ]);  
  
        $post = new master_routes_url;  
        $post->url_name =  $request->get('url_name');  
        $post->url = $request->get('url');  
        $post->status = 1;  
        $post->save();  
        
        return redirect('master_routes_url')->with('success','Inserted Successfully');   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\master_routes_url  $master_routes_url
     * @return \Illuminate\Http\Response
     */
    public function show(master_routes_url $master_routes_url)
    {
        //
        $master_route  = master_routes_url::all();
        // dd($master_route);
        return view('master_routes_url.index',[
            'master_route'=>$master_route,
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\master_routes_url  $master_routes_url
     * @return \Illuminate\Http\Response
     */
    public function edit(master_routes_url $master_routes_url)
    {
        // dd($master_routes_url);
        
        $master_route  = $master_routes_url;
        return view('master_routes_url.edit',[
            'value'=>$master_route,
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\master_routes_url  $master_routes_url
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, master_routes_url $master_routes_url)
    {
        $id = $master_routes_url->id;

        $request->validate([  
            'url_name'=>'required',  
            'url'=>'required',  
           
        ]);  
  
        $update = master_routes_url::find($id);
        $update->url_name =  $request->get('url_name');  
        $update->url = $request->get('url');  
        $update->status = 1;  
        $update->save();  
        
        return redirect('master_routes_url')->with('success','Updated Succesfully');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\master_routes_url  $master_routes_url
     * @return \Illuminate\Http\Response
     */
    public function destroy(master_routes_url $master_routes_url)
    {
        $id = $master_routes_url->id;
        $del = master_routes_url::find($id);
        $del->delete();
         return redirect('master_routes_url')->with('success','Deleted Successfully');        
    }
}
