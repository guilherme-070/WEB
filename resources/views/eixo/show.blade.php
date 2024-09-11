@extends('templates.main')

@section('content')

<form action="{{route('eixo.store')}}"method="POST">
    @csrf
    <label class="mt-3">Nome</label>
    <input type="text" name="name" class="form-control" value="{{$eixo->name}}" disabled/>
    <label class="mt-3">Descrição</label>
    <textarea name="description" rows="5" class="form-control mt-1"  disabled>
        {{$eixo->description}}
</textarea>
<ul class="list-group mt-2">
  <li class="list-group-item">CURSOS DE {{$eixo->name}}</li>
  
  @foreach($eixo->curso as $item)
  <li class="list-group-item">{{$item->name}}</li>
  @endforeach
  
</ul>

<a href="{{route('eixo.index')}}" class="btn btn-secundary mt-2">
<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="gray" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
</svg>


</a>
</form>

@endsection