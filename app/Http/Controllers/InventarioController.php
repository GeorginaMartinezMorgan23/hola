<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Inventario;

class InventarioController extends Controller
{  
    public function vistaprincipal(){
        $this->authorize('view', Inventario::class);//si tiene el permiso de ver:
        $inventarios=Inventario::All();
        return view('inventarios')->with ('inventarios',$inventarios);  
   
}
public function destroy($id){
    //permisos
    $inventarios=Inventario::findOrFail($id);
    $this->authorize('delete', $inventarios);//si tiene el permiso de actualizar:
    
    Inventario::destroy($id);
    return redirect()->back()->with('mensaje','Inventario borrado satisfactoriamente');

}

public function nuevo(){
    $this->authorize('create', Inventario::class); //si tiene el permiso de crear:   
    return view('inventarionuevo');
}



public function guardar(Request $request){
    $this->authorize('create', Inventario::class); //si tiene el permiso de crear sera guardado:        
    $request->validate([
        'producto'         =>  'required',
        'stockseguridad'   =>  'required',
        'stockactual'      =>  'required',
        'monto'      =>  'required',
    ]);

    // formulario
    $nuevo = new Inventario();
    $nuevo->producto=           $request->input('producto');
    $nuevo->stockseguridad=     $request->input('stockseguridad');
    $nuevo->stockactual=        $request->input('stockactual');
    $nuevo->monto=              $request->input('monto');

    $creado = $nuevo->save();
    //Asegurarse que fue creado
    if ($creado){
        return redirect()->back()->with('mensaje','El nuevo Inventario fue creado exitosamente');
    }
}

public function editar($id){   
    $inventarios=Inventario::findOrFail($id);
    $this->authorize('update', $inventarios);//si tiene el permiso de actualizar:

    return view('editarinventario')->with('inventarios',$inventarios);

}

public function update(Request $request,$id){
    $request->validate([
        'producto'        =>'required',
        'stockseguridad'  =>'required',
        'stockactual'     =>'required',
        'monto'           =>'required',
    ]);

    $inventarios=Inventario::findOrFail($id);
    $this->authorize('update', $inventarios);//si tiene el permiso de actualizar:

    //formulario
    $inventarios->producto=       $request->input('producto');
    $inventarios->stockseguridad= $request->input('stockseguridad');
    $inventarios->stockactual=    $request->input('stockactual');
    $inventarios->monto=           $request->input('monto');

    $actualizado = $inventarios->save();
    //Asegurarse que fue creado
    if ($actualizado){
        return redirect()->back()->with('mensaje','????El Inventario Fu?? Modificado Exitosamente!!');
    }else{ 
    }

}





}
