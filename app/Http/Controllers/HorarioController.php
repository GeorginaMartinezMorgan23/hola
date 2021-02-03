<?php

namespace App\Http\Controllers;

use App\Horario;
use App\Dias;
use App\Odontologo;
use Illuminate\Http\Request;


class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
           $dias= Dias::All(); 
        $odontologos = Odontologo::findOrFail($id);
        return view('CrearHorario')->with('odontologos',$odontologos)->with('dias',$dias);
     
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $horario = new Horario();
        $odontologo=Odontologo::findOrFail($id);

        //formulario
       
        $horario->odontologo_id= $id;
        $horario->HoraInicio= $request->input('hoinii');
        //$horario->HoraInicio= $request->input('hoini');
        $horario->HoraFinal= $request->input('hofin');
        $horario->Descanso= $request->input('descanso');
        $horario->DescansoInicial= $request->input('descaini');
        $horario->DescansoFinal= $request->input('descfin');

        $create = $horario->save();
       

         if ($create){
            return redirect('/pantallainicio/odontologo')->with('mensaje', 'El Odontologo fue creado exitosamente!');
        }else{
            //retornar con un msj de error
        } 


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function edit(Horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horario $horario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Horario $horario)
    {
        //
    }
}