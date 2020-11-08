<?php

namespace App\Http\Controllers;
use App\Paciente;
use App\Documento; 
use Carbon\Carbon;

use Illuminate\Http\Request;

class DocumentosClinicosController extends Controller
{
    public function ver($id){
        $pacientes = Paciente::findOrFail($id);
        return view('documentosclinicos',compact('pacientes'));
    }
    public function nuevo($id){
        $pacientes = Paciente::findOrFail($id);
        return view('formularioDocumentos',compact('pacientes'));
    }
    public function guardar(Request $request,$id){
        
        if($request->hasFile('imagen1')){
            $file = $request->file('imagen1');
            $name = time().$file->getClientOriginalName();
            $file->move(\public_path().'/documento/',$name);
        }
        $imagen1 = new Documento();
        $imagen1->paciente_id=$id;
        $imagen1->fecha = Carbon::now();
        $imagen1 ->imagen1 = $name;
        $imagen1->observaciones=$request->input('observaciones');
        $imagen1->odontologo_id=$request->input('odontologo_id');
        $creado= $imagen1->save();
        if ($creado){
           
         return redirect()->back()->with('mensaje','Archivo guardado exitosamente');

          //return redirect()('/comentarios/{id}');
       } 


    }
}
