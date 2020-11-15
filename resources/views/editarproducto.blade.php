@extends('Plantilla.Plantilla')
@section('titulo','Edicion del producto')
@section('contenido')
<!DOCTYPE html>
<html lang="en">
<head>
<style>
#padre{
    width:auto;
    font:1em Tahoma;
    margin: 5rem;
    padding: 2rem;
    border: 2px solid #ccc;
}   #titulo{
    text-align:center;
}
</style>
</head>
<body>
    
    <div  class="container" id="padre">
    <h3 id="titulo">Edición del producto</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('mensaje'))
        <div class="alert alert-success">
            {{session('mensaje')}}
        </div>
    @endif
    <form method="post" action="{{route('producto.update',['id'=> $productos-> id])}} ">

    @csrf
    @method('put')
     <!-- Nombre-->
                
     <div class="form-group" id="divcate">
                    <label for="nombre" class="control-label">Nombre del Producto:</label>
                    <input type="text"  class="form-control-file" placeholder="Ingrese nombre producto" name="nombre" id="nombre"   value="{{ $productos->nombre }}"> 
                    </div>
                   
                    <!-- Permite Descuento-->
                    <div class="form-group" id="div2">
                    <label for="detalle" class="control-label">Permite Descuento:</label>
                    <input type="text"  class="form-control-file" name="permitedescuento" id="permitedescuento" placeholder="Ingrese si o no" value="{{ $productos->permitedescuento }}">
                    </div>
                 
                   <!-- Precio Final-->
                   <div class="form-group" id="div2">
                    <label for="detalle" class="control-label">Precio Final:</label>
                    <input type="text"  class="form-control-file" name="monto" id="monto" placeholder="Ingrese valor "value="{{ $productos->monto}}">
                    </div>
                 
                   
                    
                   
                    <div class="form-group" id="div6">
                    <button style="background-color:purple"type="button" onclick="location.href='/tratamiento'"class="btn btn-secondary" data-dismiss="modal">Atrás</button>
                    <input type="reset" class="btn btn-danger">
                    <button id="botonContinuar"type="submit"class="btn btn-primary" data-toggle="modal" >
                        Actualizar
                    </button>
                    
                   
                    </div>

    
    
    </form>

    
    
    
    </div><!-- fin div padre -->
</body>
</html>
@endsection