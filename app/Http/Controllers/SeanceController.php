<?php

namespace App\Http\Controllers;
use App\Models\Seance;
use App\Models\Module;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $Seance = Seance::all()->toArray();
        return array_reverse($Seance);   
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
         $Seance= new Seance([
            'jour' => $request->input('jour'),
            'temps' => $request->input('temps'),
            'id_module' => $request->input('id_module'),
            'id_semestre' => $request->input('id_semestre'),
            'salle' => $request->input('salle'),

        ]);
        $Seance->save();

        return response()->json('Seance created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $Seances = Seance::where('id_semestre', $id)->get();
        foreach($Seances as $Seance){
            $id = $Seance->id_module;
            $Seance->ModuleName = Module::where('id', $id)->get();
            $Sorted = collect($Seances)->sortBy($Seance->jour)->values();
        }
        return $Sorted;
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
       $Seance = Seance::find($id);
        $Seance->update($request->all());

        return response()->json('Seance updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $Seance = Seance::find($id);
        $Seance->delete();

        return response()->json('Seance deleted!');
    }
}
