<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Note;
use App\Models\Module;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = '';
         $Note = Note::all();

        return $Note;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $Note= new Note([
            'valeur' => $request->input('valeur'),
            'id_etudiant' => $request->input('id_etudiant'),
            'id_module' => $request->input('id_module'),
        ]);
        $Note->save();

        return response()->json('Note created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Notes = Note::where('id_module', $id)->get();
        foreach($Notes as $Note){
            $idetu = $Note->id_etudiant;
            $Note->EtudiantName = User::where('id', $idetu)->get();
        }
        return $Notes;
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
         $Note = Note::find($id);
        $Note->update($request->all());

        return response()->json('Note updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $Note = Note::find($id);
        $Note->delete();

        return response()->json('Note deleted!');
    }
}
