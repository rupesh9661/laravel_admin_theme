<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ExportExcel;
use Illuminate\Support\Facades\Crypt;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page= 50;
        $name= $request->name;
        $enabled= $request->status;
      
       $data= DB::table('designation')->where('status' , 1);
     
    if(!empty($name)){
        $data->where('name','LIKE', '%'.$name.'%');
    }
    if(!empty($enabled)){
        $data->where('enabled',1);
    }

    if($enabled == 0 && $enabled !=null){
        $data->where('enabled',0);
    }
    $designation= $data->paginate($page);
    if(!empty($request->export_to_pdf)){
        $pdf = PDF::loadView('Designation.designation_index_pdf', [
            'designation' => $designation
        ]);
        // $customPaper = array(0, 0, 1000, 1000);
        // $pdf->setPaper($customPaper);
        $pdf_name= "Designation.pdf";
        return $pdf->download($pdf_name);
    }

    if(!empty($request->export_to_excel)){
        $file_name="Designation";
        $thead=[
            "S. No.",
            "ID",
            "Designation Name",
            "Description",             
        ];
        ExportExcel::export_dynamically($thead ,$designation , $file_name);
    }
    
    else{
       return view('Designation.index' , ['designation'=>$designation]);
    }
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Designation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $last_id= DB::table('designation')->select('id')->orderBy('id' , 'desc')->first();
    if(!empty($last_id)){
        $char_id="DESG".($last_id->id+1);
    }else{
        $char_id="DESG1";
    }        
        $designation = DB::table('designation')->insert([
            'char_id'=>$char_id,
            'name'=>$request->name,
            'enabled'=>$request->enabled,
            'description'=>$request->description,
            'status'=>1,
            'created_at'=> date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => Auth::user()->id
        ]);
        return redirect('Designation')->with('success','Inserted Successfully');
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
        $decrypt_id = Crypt::deCrypt($id);
        $designation = DB::table('designation')->find($decrypt_id);
        return view(
            'Designation.edit',
            [
                'designation'=>$designation,
               
            ]
        );
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
        $designation = DB::table('designation')->where('id',$id)->update([
            'name'=>$request->name,
            'enabled'=>$request->enabled,
            'description'=>$request->description,
            'created_at'=> date('Y-m-d H:i:s'),
            'created_by' => Auth::user()->id,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => Auth::user()->id
        ]);
        return redirect('Designation')->with('success','updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $details = DB::table('designation')->find($id);
        //     DB::table('synergy_logs_designation')->insert([
        //     'id'=>$details->id,
        //     'char_id'=>$details->char_id,
        //     'name'=>$details->name,
        //     'enabled'=>$details->enabled,
        //     'description'=>$details->description,
        //     'status'=>$details->status,
        //     'created_at'=> $details->created_at,
        //     'created_by' => $details->created_by,
        //     'updated_at' => $details->updated_at,
        //     'updated_by' => $details->updated_by,

        //     'deleted_at' => date('Y-m-d H:i:s'),
        //     'deleted_by' => Auth::user()->id,
        //     'uid_status'=>'D'
        // ]);
        DB::table('designation')->where('id' , $id)->delete();
        return redirect('Designation')->with('success','Deleted Successfully');
    }
    
    
          public function getpdf($id){
        // dd($id);
        $decrypt_id= Crypt::deCrypt($id);
        $designation= DB::table('designation')->find($decrypt_id);
      
        // $acc_head= DB::table('accounting_head')->where('status' , 1)->get();

        return view('Designation.designationpdf' , ['designation'=>$designation]);

    }
}
