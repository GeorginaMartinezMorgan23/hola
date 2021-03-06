@extends('VistaMenuAgenda')
@section('Titulo','Agenda')
@section('cuerpo')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- modal -->
<!-- bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
<link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" >
  
  <!--  -->
  <!--Estos son  Importante -->
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js"></script>
  <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>

  <!-- este es importante -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />
  <!-- Este Tambien es Importante -->
  <script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>
  <!-- Este tambien es importante -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
  <!-- Fecha -->
  <!-- fecha -->
<script src='{{asset("vendor/moment.min.js")}}'></script>
  <!-- idioma -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es.min.js"></script>
  <!--  -->

  <?php 

  try
  {
  $mbd = new PDO('mysql:host=127.0.0.1;dbname=smilesoftware', "root", "");
  $sth= $mbd->query('select * from citas');
  }
  catch(Exception $e)
  {
  echo "no conectado";
  }

  ?>
<!--  -->

<style>
#calendar {

width: 700px;
padding: 25px 25px 25px 25px;
margin-top:1em;
background: url("/imagenes/fondodecalendario.png");
background-repeat: no-repeat;
background-color: #eafafa; 
background-position: center center;
  background-size: cover;
}

.fc table {
border-collapse: collapse;
border-spacing: 0;
font-size: 1em; /* normalize cross-browser */
}
.fc th {
text-align: center;
background-color:#D1C4E9;
font-size: 1.2em;
}
.fc th,
.fc td {
vertical-align: top;
padding: 0;
}

#app{
color: #ABEBC6;
position:relative;  
margin:2em;

}
#cal{
color: #ff4d4d;
border-color: #b3ffff;
margin-top:6em;

}

</style>


</head>
<body>



@canany(['isAdmin','isSecretaria','isOdontologo'])

<div class=row id="app">
  <div class="col"></div>
  <div>
    <div   id="calendar"> 
        <calendar  :events="events" :editable="true" id="cal"></calendar>
    </div> 
  </div>
  <div class="col"></div>
</div>
<!-- Modal -->
<div class="modal"  id="modalejemplo" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="  background-image: linear-gradient(to left,  #AFEEEE,#00FF99); ">
        <h5 class="modal-title" >Agendar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--  -->
        
    <!-- Esta parte del codigo es para poder ir a traer informacion de la base de datos -->
      <?php
        $mysqli= new mysqli ('127.0.0.1','root','','smilesoftware');
        $mysqli->set_charset("utf8");
      ?>
        <form method="post" action="/darcita">
        @csrf
        <!-- Doctor -->
        <label for="odontologo_id" class="control-label">Doctor y su especialidad:</label>
        <select name="odontologo_id" id="odontologo_id" class="form-control">
        <option disabled selected>Seleccione un Doctor</option>
        <?php
        $getDoctor =$mysqli->query("select * from odontologos order by id");
        while($f=$getDoctor->fetch_object()) {
          echo $f->id;
          echo $f->nombres;
          echo $f->apellidos;
          echo $f->especialidad_id;

          ?>
         
          <option value="<?php echo $f->id; ?>"><?php echo $f->nombres." ".$f->apellidos." |  Especialidad:".$f->especialidad_id;?></option>
          <?php
        } 
        ?>
        </select>
        <hr>
       <!-- Duracion (en duda)-->
       <label for="duracionCita" class="control-label">Duracion de la cita:</label>
        <select name="duracionCita" id="duracionCita" class="form-control">
        <option disabled selected>Seleccione la duracion de la cita</option>
        <option value="10m">10 minutos</option>
        <option value="15m">15 minutos</option>
        <option value="20m">20 minutos</option>
        <option value="30m">30 minutos</option>
        <option value="40">40 minutos</option>
        <option value="50m">50 minutos</option>
        </select>
        <br>
        <label for="hora" class="control-label">Fecha y Hora:</label>
        <input type="date" name="stard" id="stard">
        
        <hr>
        <!-- Paciente_id -->

        <div class="form-group">
        <label for="state_id" class="control-label">Paciente:</label>
        <select name="paciente_id" id="paciente_id" class="form-control">
        <option disabled selected>Seleccione el paciente</option>
        <?php
        $getPaciente =$mysqli->query("select * from pacientes order by id");
        while($f=$getPaciente->fetch_object()) {
        echo $f->nombres;
        echo $f->apellidos;

          ?>
        
          <option value="<?php echo $f->id; ?>"><?php echo $f->nombres." ".$f->apellidos;?></option>
        <?php
        } 
        ?>
        </select>
                        
        </div>
         <div>
         <!-- comentario -->
         <label></label>
         <label for="comentarios" id="comentariolabel"class="control-label">Comentarios:</label>
         <br>
         <input type="text" name="comentarios" id="comentarios"> 
         </div>
        <br>
        <div class="modal-footer">
        <button id="btnAgregar" class="btn btn-success">Agregar</button>
        </form>
      </div>
      </div>
      </div>
      </div>
      </div>
        
        
       
<!--  -->



<script type="text/javascript" id="ve">

Vue.component('calendar', {
template: '<div></div>',
props: {
events: {
type: Array, 
required: true
},

editable: {
type: Boolean,
required: false,
default: false
},

droppable: {
type: Boolean,
required: false,
default: false
},
},

data: function()
{
return {
cal: null
}
},

ready: function()
{



var self = this;
self.cal = $(self.$el);

var args = {
lang: 'de',
header: {
left:   'prev,next today',
center: 'title',
right:  '',

//initialView: 'basicWeek'

},

defaultView:'month',
height: "auto",
allDaySlot: false,
slotEventOverlap: false,
timeFormat: 'HH:mm',
events: self.events,

dayClick: function(date)
{
  $("#modalejemplo").modal();

  $('#stard').val(date.format());


// self.$dispatch('day::clicked', date);
// self.cal.fullCalendar('gotoDate', date.start);
// self.cal.fullCalendar('changeView', 'agendaDay');
},
eventColor: '#F7DC6F',



eventClick: function(event)
{
self.$dispatch('event::clicked', event);
  window.open("{{route('cita.diaria')}}");
console.log(event)
}
}

if (self.editable)
{
args.editable = true;
args.eventResize = function(event)
{
self.$dispatch('event::resized', event);
}

args.eventDrop = function(event)
{
self.$dispatch('event::dropped', event);
}
}

if (self.droppable)
{
args.droppable = true;
args.eventReceive = function(event)
{
self.$dispatch('event::received', event);
}
}

this.cal.fullCalendar(args);

}

})

new Vue({
el: '#app',

data: {    
events: [
<?php
foreach($sth as $fila){
?>
{
title:"<?php echo "Cita  ". $fila["id"]; ?>",
start: "<?php echo $fila["stard"]; ?>",
end: " " 

},
<?php
}
?>
]
},

events: {
'day::clicked': function(date)
{
console.log(date);
}
}
})


</script>




<div style="position:static;"  id='hijo'>
<div >
@yield('cuerpo')
</div>


</div>
@include('darcita')

@endsection
@endcanany
</html>


