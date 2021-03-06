<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gasto;
use Illuminate\Support\Facades\Gate;

class GastoController extends Controller
{
    public function ver(){
        $this->authorize('view', Gasto::class);//si tiene el permiso de ver:
            $gastos=Gasto::Paginate(15);
            $monto =Gasto::sum('monto');
            return view('gastos')->with('gastos',$gastos)->with('monto',$monto);
       
    }
    public function guardargasto(Request $request){
        
        $this->authorize('create', Gasto::class); //si tiene el permiso de crear sera guardado:  
                $request->validate([
                    'categoria'     =>  'required',
                    'detalle'       =>  'required',
                    'monto'         =>  'required|numeric|min:0|max:100000000000000000',
                    'fechafactura'  =>  'required|date',
                    'fechapago'     =>  'required|date',
                ]);

                // formulario
                $nuevogasto = new Gasto();
                $nuevogasto->categoria=    $request->input('categoria');
                $nuevogasto->detalle=      $request->input('detalle');
                $nuevogasto->monto=        $request->input('monto');
                $nuevogasto->fechafactura= $request->input('fechafactura');
                $nuevogasto->fechapago=    $request->input('fechapago');

                $creado = $nuevogasto->save();
                //Asegurarse que fue creado
                if ($creado){
                    return redirect()->back()->with('mensaje','El nuevo Gasto fué creado exitosamente');
                }else{ 
                }
           
    }
    public function borrargasto($id){
        $gastos = Gasto::findOrFail($id);
        $this->authorize('delete',$gastos);//si tiene el permiso de borrar:
        Gasto::destroy($id);
        return redirect()->back()->with('mensaje','Gasto borrado satisfactoriamente');
    }

    /* funcion para poder editar un gasto */
    public function editar($id){
        $gastos=Gasto::findOrFail($id);
        $this->authorize('update', $gastos);//si tiene el permiso de actualizar:
        return view('editargasto')->with('gastos',$gastos);
    }
    public function update(Request $request,$id){
        $request->validate([
            'categoria'     =>  'required',
            'detalle'       =>  'required',
            'monto'         =>  'required|numeric|min:0|max:100000000000000000',
            'fechafactura'  =>  'required|date',
            'fechapago'     =>  'required|date',
        ]);

        $gastos=Gasto::findOrFail($id);
        $this->authorize('update', $gastos);//si tiene el permiso de actualizar:
        //formulario
        $gastos->categoria=    $request->input('categoria');
        $gastos->detalle=      $request->input('detalle');
        $gastos->monto=        $request->input('monto');
        $gastos->fechafactura= $request->input('fechafactura');
        $gastos->fechapago=    $request->input('fechapago');

        $actualizado = $gastos->save();
        //Asegurarse que fue creado
        if ($actualizado){
            return redirect()->back()->with('mensaje','¡¡El  Gasto Fué Modificado Exitosamente!!');
        }else{ 
        }
    

    }
    
}
