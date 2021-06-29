<?php

namespace App\Http\Controllers;
use App\Models\Pfe;
use App\Models\User;
use Illuminate\Http\Request;

class PfeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $pfes = Pfe::all();
       foreach($pfes as $pfe){
           $idp = $pfe->id_prof;
           $ide = $pfe->id_etudiant;
           $pfe->P_Name = User::where('id', $idp)->get();
           $pfe->E_Name = User::where('id', $ide)->get();
       }
       return $pfes;
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
         $Pfe= new Pfe([
            'Sujet' => $request->input('Sujet'),
            // 'note' => $request->input('note'),
         'id_prof' => $request->input('id_prof'),
            'id_etudiant' => $request->input('id_etudiant'),
        ]);
        $Pfe->save();

        return response()->json('Pfe created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pfe = Pfe::where('id_etudiant',$id)->get();
       return $pfe;
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
        $pfe = Pfe::where('id_etudiant',$id);
        $pfe->update($request->all());

        return response()->json('pfe updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pfe = pfe::find($id);
        $pfe->delete();

        return response()->json('Module deleted!');
    }
}
