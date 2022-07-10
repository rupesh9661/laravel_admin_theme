<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Module;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;




class DesingnationRouteMasterController extends Controller
{
    public function RouteMaster(Request $request)
    {
        // dd($usercheck);

        $users =DB::table('users')
        ->leftjoin('designation' , 'users.designation_id' , '=' , 'designation.id')
        ->select(DB::raw("CONCAT_WS(' ',designation.name,users.name) as full_name"), 'users.*')
        ->get();

        $master_routes = DB::table('master_routes_url')->get();

        // dd($master_routes);

        return view('DesingnationRouteMaster.index', [
            'user' => $users,
            'master_routes' => $master_routes


        ]);
    }

    public function store(Request $request)
    {

        // dd($request);
        DB::beginTransaction();
        $user_id = $request->user_id;
        if (!empty($user_id)) {
            $myarrFinal = [];

            $deleteData = DB::table('designation_master_routes_url')
                ->where('user_id', $user_id)
                ->delete();
            $modules = $request->url_name;
            foreach($modules as $value_key=>$module) {
                // dd($module , $request);
                if(!empty($request->persmission[$module])){
                    $myarrFinal[] = [
                    'user_id' => $request->user_id,
                    'url_id' => $module,
                    'persmission' =>  1,
                    'created_at'=> date('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->id,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => Auth::user()->id
                ];
            }
             
            }
            $data_insert = DB::table('designation_master_routes_url')->insert($myarrFinal);
            if ($data_insert) {
                DB::commit();
            } else {
                DB::rollback();
            }
        }
        $module_id = $request->module_id;
        if (!empty($module_id)) {
            DB::table('designation_master_routes_url')
            ->where('url_id', $module_id)
            ->delete();
            $users = User::all();
            $insert_data = [];
            foreach ($users as $key => $user) {
                if(!empty($request->user_permission[$user->id])){
                    $insert_data[] = [
                        'user_id' => $user->id,
                        'url_id' => $module_id,
                        'persmission' =>1,
                        'created_at'=> date('Y-m-d H:i:s'),
                        'created_by' => Auth::user()->id,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => Auth::user()->id
                    ];
                }
              
            }
            // dd($insert_data);
            $result = DB::table('designation_master_routes_url')->insert($insert_data);
            if ($result) {
                DB::commit();
            } else {
                DB::rollback();
            }
        }
        return redirect('DesingnationRouteMaster')->with('success', 'Successfully Inserted');
    }

    public function RouteMasterAjax(Request $request, $id)
    {


        $usercheck = DB::table('designation_master_routes_url')
            ->select('user_id', 'persmission', 'url_id')
            ->where('user_id', $id)
            // ->groupBy('user_id')
            ->get();
        // dd($usercheck);
        return response()->json(['data' => $usercheck]);
    }


    public function ModuleUserAssigning(Request $request, $user_id)
    {

        $datacheck = DB::table('users')
            ->select('id', 'name')
            ->get();
        return response()->json(['data_module' => $datacheck]);
    }

    public function getUsers($module_id){
        $data= DB::table('designation_master_routes_url')->where('url_id' , $module_id)->where('persmission' , 1)->get();
     
        return response()->json(['data' => $data]);
    }
}
