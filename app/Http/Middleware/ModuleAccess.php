<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\DesignationModule;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ModuleAccess extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$auth)
    {
        $permission = 0;
        $user_id = Auth::user()->id;
        // dd($user_id);
        $authUser = Auth::user();
        // if (Auth::user()->id == '1') {
        //     $permission = 1;
        //     return $next($request);
        // }

        $pathInfoDetails = $request->getPathInfo();
        $break_get_details =  explode('/', $pathInfoDetails);
        if (empty($break_get_details)) {
            abort(400);
        }
        // dd($break_get_details);
        $method = $request->getMethod();
        if (empty($break_get_details[1])) {

            $url = !empty($break_get_details[2]) ? $break_get_details[2] : '';
            $second_url = !empty($break_get_details[3]) ? $break_get_details[3] : '';
        } else {
            $url = !empty($break_get_details[1]) ? $break_get_details[1] : '';
            $token = !empty($break_get_details[2]) ? $break_get_details[2] : '';
            $second_url = !empty($break_get_details[3]) ? $break_get_details[3] : '';
            // dd($second_url,$token,$url);
        }

        $get_module_id_details = Module::where('route_name', $url)->orderBy('id', 'ASC')->first();

        if (empty($get_module_id_details->id)) {
            // abort(400);
        } else {

            $moduleId = $get_module_id_details->id;
            if (empty($second_url)) {
                $second_url = $token;
            }

            $designationModule = DesignationModule::where('designation_id', $authUser->designation_id)
                ->where('module_id', $moduleId)
                ->where('view', 1)
                ->first();
            // dd($second_url);
            if ($second_url == 'edit') {
                $check_details = DesignationModule::where('designation_id', $authUser->designation_id)
                    ->where('module_id', $moduleId)
                    ->where('edit', 1)
                    ->first();
                if (empty($check_details->module_id)) {
                    abort(400);
                }
            } elseif ($second_url == 'create') {
                $check_details = DesignationModule::where('designation_id', $authUser->designation_id)
                    ->where('module_id', $moduleId)
                    ->where('add', 1)
                    ->first();
                if (empty($check_details->module_id)) {
                    abort(400);
                }
            } elseif ($method == 'DELETE' || $method == 'delete') {
                $check_details = DesignationModule::where('designation_id', $authUser->designation_id)
                    ->where('module_id', $moduleId)
                    ->where('delete', 1)
                    ->first();
                if (empty($check_details->module_id)) {
                    abort(400);
                }
            }
        }
        // dd($url);
        if (!empty($url)) {
            // $url = $_SERVER['REQUEST_URI'];   
            // dd($url);
            $get_record_check = DB::table('master_routes_url')
                ->where('url', $url)
                ->first();
            // dd($url,$get_record_check);
            if (!empty($get_record_check->id)) {
                $get_another_record_check = DB::table('designation_master_routes_url')
                    ->where('url_id', $get_record_check->id)
                    ->where('user_id', $user_id)
                    ->where('persmission', 1)
                    ->first();
                // dd($get_another_record_check);
                if (!empty($get_another_record_check->id)) {
                    return $next($request);
                } else {
                    abort(400);
                }
            } else {
                if (!empty($second_url) || !empty($token)) {
                    if (empty($second_url)) {
                        $second_url = $token;
                    }
                    $re_url = $url . '/' . $second_url;
                    // dd($re_url);
                    $get_record_check = DB::table('master_routes_url')
                        ->where('url', $re_url)
                        ->first();
                    // dd($url,$get_record_check);
                    if (!empty($get_record_check->id)) {
                        $get_another_record_check = DB::table('designation_master_routes_url')
                            ->where('url_id', $get_record_check->id)
                            ->where('user_id', $user_id)
                            ->where('persmission', 1)
                            ->first();
                        // dd($get_another_record_check);
                        if (!empty($get_another_record_check->id)) {
                            return $next($request);
                        } else {
                            abort(400);
                        }
                    } else {
                        return $next($request);
                    }
                }
                return $next($request);
            }
        } else {
            abort(400);
        }

        // for safety
        if ($permission == 0) {
            abort(400);
        }

        return $next($request);
    }
}
