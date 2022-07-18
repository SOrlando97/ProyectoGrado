@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('Usuarios.index')}}">Listado de usuarios</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tipos de Productos</li>
        </ol>
      </nav>

<div class="div-primerboton">
    <new_tipo_prod style="width: 180px"></new_tipo_prod>
</div>

<div class="row">
    @foreach($tipoproducto as $tipoproducto)      

    <div class="col m-2 mb-5">
        <a  href="#">
            <div class="cardProducts">
                <div class="card-body">
                    <h5 class="card-title text-center text-capitalize text-dark">
                        <strong>{{$tipoproducto->descripcion}}</strong>
                    </h5>
                    <div class="imgPro2"></div>
                    <div class="">
                        <p class="d-flex align-items-center">
                            @csrf  
                    <mod_tipo_prod tipo-producto={{$tipoproducto->id}}></mod_tipo_prod>
                @csrf  
                    <elim_tipo_prod tipo-producto = {{$tipoproducto->id}}></elim_tipo_prod>
                        </p>    
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
    </div>
</div>
@endsection