@extends('templates.main')

@section('content')

<p class= "alert alert-secondary mt-3  text-body">
  <b>{{$curso->name}}</b> {{$curso->abreviatura}}
</p>


<div class="card mt-3">
  <h5 class="card-header">
    <b>{{$curso->name}}</b> {{$curso->abreviatura}}</h5>
  <div class="card-body">

    <h5 class="card-title">Informações do curso</h5>

    <p class="card-text">
      <b>Duração: </b> {{$curso->duracao}} ano(s)
    </p>

    <p class="card-text">
      <b>Eixo: </b> {{$curso->eixo->name}} 
    </p>

    <a href="{{route('curso.index')}}" class="btn btn-primary">Voltar

    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="white" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
      <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
    </svg>

    
    </a>
  </div>
</div>



</a>
</form>

@endsection