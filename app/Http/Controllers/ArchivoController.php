<?php

namespace App\Http\Controllers;
use App\Paciente;
use App\Archivo; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;


use Illuminate\Http\Request;

class ArchivoController extends Controller
{
    public function ver($id){
        if(Gate::denies('isAdmin') || Gate::denies('isOdontologo')){

        $pacientes = Paciente::findOrFail($id);
        return view('imagenesYarchivos',compact('pacientes'));
        
        }else{
            abort(403);
        }
    }

    public function nuevo($id){
        $this->authorize('create', Archivo::class);
        $pacientes = Paciente::findOrFail($id);
        return view('formularioImagenesYarchivos',compact('pacientes'));
    }

    

    public function guardar(Request $request,$id){
        $this->authorize('create', Archivo::class);
        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $name = time().$file->getClientOriginalName();
            $file->move(\public_path().'/images/',$name);
        }
        $imagen = new Archivo();
        $imagen->paciente_id=$id;
        $imagen->fecha = Carbon::now();
        $imagen ->imagen = $name;
        $imagen->observaciones=$request->input('observaciones');
        $imagen->odontologo_id=$request->input('odontologo_id');
        $creado= $imagen->save();
        if ($creado){
           
         return redirect()->back()->with('mensaje','Archivo guardado exitosamente');

          //return redirect()('/comentarios/{id}');
       } 
    }




    public function borrar($id){
        if(Gate::denies('isAdmin') || Gate::denies('isOdontologo')){
        
        Archivo::destroy($id);
        return redirect()->back()->with('mensaje','archivo borrado satisfactoriamente');

    }else{
        abort(403);
    }
    }

    public function editar($id){  
   
        $imagen=Archivo::findOrFail($id);
        //$this->authorize('update', $mediopagos); si tiene el permiso de editar:
        return view('editararchivo')->with('editararchivo',$imagen);
    
    }

    public function update(Request $request,$id){
 

        $request->validate([
            'imagen'        =>'required',
            'observaciones'        =>'required',
            'fecha'        =>'required',
            'odontologo_id'        =>'required',
           
        ]);
    
        $imagen=Imagen::findOrFail($id);
        //$this->authorize('update', $mediopagos); //si tiene el permiso de editar:
        //formulario
        $imagen->imagen=       $request->input('imagen');
        $imagen->observacion=       $request->input('observacion');
        $imagen->fecha=       $request->input('fecha');
        $imagen->odontologo_id=       $request->input('odontologo_id');
    
        $actualizado = $imagen->save();
        //Asegurarse que fue creado
        if ($actualizado){
            return redirect()->back()->with('mensaje','¡¡El archivo Fué Modificado Exitosamente!!');
        }else{ 
        }
    
    
    }





}