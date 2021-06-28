<?php

namespace App\Http\Controllers;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $Module = Module::all()->toArray();
        return array_reverse($Module);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Module = new Module([
            'nom' => $request->input('nom'),
            'id_prof' => $request->input('id_prof'),
            'id_semestre' => $request->input('id_semestre')
        ]);
        $Module->save();

        return response()->json('Module created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Modules = Module::where('id_semestre', $id)->get();
        foreach($Modules as $Module){
            $id_pr = $Module->id_prof;
            $Module->ProfName = User::where('id', $id_pr)->get();
        }
        
        return $Modules;
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
        $Module = Module::find($id);
        $Module->update($request->all());

        return response()->json('Module updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $Module = Module::find($id);
        $Module->delete();

        return response()->json('Module deleted!');
    }
}
