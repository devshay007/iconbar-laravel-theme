<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lookup;
use App\Models\Hospital;
use App\Models\User;
class LookupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.lookups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lookups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        if(!empty($request->lookup_key_name) && !empty($request->tbl_data)){
            foreach ($request->tbl_data as $key => $lookup) {
                if($lookup!=''){
                    Lookup::create([
                        'keyname'=>$request->lookup_key_name,
                        'keyvalue'=>$lookup,
                        'stats_flag'=>'N',
                        'hospid'=>Hospital::first()->hospid,
                        'created_by'=>User::first()->id
                    ]);    
                }
            }
            return response()->json(['success'=>true,'message'=>'Lookup added successfully.']);
        }
        return response()->json(['success'=>false,'message'=>'Lookups not saved!.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lookup = Lookup::find($id);
        return response()->json($lookup);
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
        $data['keyname']=$request->lookup_key;
        $data['keyvalue']=$request->lookup_value;

        Lookup::where('lookupid',$request->lookup_id)->update($data);
        return response()->json(['success'=>true,'message'=>'Lookup updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lookup::find($id)->delete();
        return response()->json(['success'=>true,'message'=>'Lookup deleted successfully.']);
    }
}
