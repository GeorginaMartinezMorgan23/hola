<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cita;
use App\Paciente;


class CitaController extends Controller
{
    public function crear(){
        return view('darcita');

    }

    public function calendar(Request $request){
        $query=trim($request->get('/darcita'));
         $citas=Cita::get('id');
        return view('FullCalendar');

    }

    public function calendario(Request $request){
         $query=trim($request->get('/darcita'));
         $citas=Cita::get('id');

        return view('Calendario',['citas'=>$citas,'/darcita'=>$query]);

    }


    public function index(Request $request){
        if($request){
            $query= trim($request->get('buscarpor'));
            $pacientes =Paciente::where('nombres','LIKE','%'. $query .'%')->orderBy('id','asc')->get();
            return view('Buscarpaciente',['pacientes' => $pacientes ,' buscarpor '=> $query] );

        }
        
        }
        


    public function datos()
    {
        if(request()->ajax()) 
        {
 
         $pacientes = (!empty($_GET["id"])) ? ($_GET["id"]) : ('');
         $citas = (!empty($_GET["nombres"])) ? ($_GET["nombres"]) : ('');
 
         $data = Paciente::whereDate('id', '>=', $pacientes)->whereDate('id',   '<=', $citas)->get(['id']);
         return calendar::json($data);
        }
        return view('Calendario');
    }

    public function create(Request $request)
    {  
        $insertArr = [ 'title' => $request->title,
                       'start' => $request->start,
                       'end' => $request->end
                    ];
        $event = Citas::insert($insertArr);   
        return calendar::json($event);
    }
     
 
    public function update(Request $request)
    {   
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);
 
        return Response::json($event);
    } 
 
 
    public function destroy(Request $request)
    {
        $event = Event::where('id',$request->id)->delete();
   
        return Response::json($event);
    } 

    
    public function mostrar(Request $request){
        if($request){
            $query= trim($request->get('buscarpor'));
            $pacientes =Paciente::where('nombres','LIKE','%'. $query .'%')->orderBy('id','asc')->get();
            return view('Buscarpaciente',['pacientes' => $pacientes ,' buscarpor '=> $query] );

        }
        
        }
        

      //funcion para gurdar el formulario cita
      public  function guardar(Request $request){

        $request->validate([
            'especialidad_id'=>'required',
            'odontologo_id'=>'required',
            'duracionCita'=>'required',
            'hora'=>'required',
            'fecha'=>'required',
            'paciente_id'=>'required',
            'comentarios'=>'required',
            'stard' =>'required',
    
        ]);

        // formulario
        $nuevacita = new Cita();
        $nuevacita->especialidad_id= $request->input('especialidad_id');
        $nuevacita->odontologo_id=$request->input('odontologo_id');
        $nuevacita->duracionCita=$request->input('duracionCita');
        $nuevacita->hora=$request->input('hora');
        $nuevacita->fecha=$request->input('fecha');
        $nuevacita->stard=$request->input('stard');
       $nuevacita->paciente_id=$request->input('paciente_id');
        $nuevacita->comentarios=$request->input('comentarios');    

        $creado = $nuevacita->save();
        //Asegurarse que fue creado
        if ($creado){
            return redirect()->route("citadiaria")
                ->with('mensaje','La cita fue creado exitosamente');

        }else{
            //Retornar con un mensaje de error
        } 
}




}
