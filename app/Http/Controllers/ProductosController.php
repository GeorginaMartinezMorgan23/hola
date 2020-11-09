<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tratamiento;
use App\Producto;


class ProductosController extends Controller
{
    public function datos($id){
       $productos=Producto::all();
       $tratamientos=Tratamiento::findorfail($id);
      return view('productos')->with ('productos',$productos)->with('tratamientos',$tratamientos);
      }
      //public function datos($id){
      //  $productos = Producto::findOrFail($id);
      //  return view('productos',compact('productos'));
   // }




//public function nuevo(){
       
  //  return view('productosnuevo');
//}

public function nuevo($id){
   $tratamientos = Tratamiento::findOrFail($id);
      return view('productosnuevo')->with('tratamientos',$tratamientos); 
}




public function guardar(Request $request,$id){
            
    $request->validate([
        'nombre'                    =>  'required',
        'permitedescuento'          =>  'required',
        'monto'                     =>  'required',
       
    ]);

    // formulario
    $nuevo = new Producto();
    $nuevo->nombre=$request->input('nombre');
    $nuevo->permitedescuento=     $request->input('permitedescuento');
    $nuevo->monto=     $request->input('monto');
    $nuevo->tratamiento_id = $id;
    $creado = $nuevo->save();
    //Asegurarse que fue creado
    if ($creado){
        return redirect()->back()->with('mensaje','El nuevo Producto fue creado exitosamente');
    }else{ 
    }
}
//funcion para eliminar
    // recibe el id del que se va eliminar
    public function destroy($id){
        Producto::destroy($id);
       // Cita::where('paciente_id','=',$id)->delete();
        return redirect()->back()->with('mensaje','Producto borrado satisfactoriamente');
    }


    public function editar($id){
     
        $productos=Producto::findOrFail($id);
        return view('editarproducto')->with('productos',$productos);
    
    }

    public function update(Request $request,$id){
        $request->validate([
            'nombre'                     =>  'required',
            'permitedescuento'           =>  'required',
            'monto'                      =>  'required',
        ]);
    
        $productos=Producto::findOrFail($id);
        //formulario
        $productos->nombre=           $request->input('nombre');
        $productos->permitedescuento= $request->input('permitedescuento');
        $productos->monto=            $request->input('monto');
    
        $actualizado = $productos->save();
        //Asegurarse que fue creado
        if ($actualizado){
            return redirect()->back()->with('mensaje','¡¡El Producto Fué Modificado Exitosamente!!');
        }else{ 
        }
    
    }





}
