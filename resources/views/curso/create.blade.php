@extends('templates.main')

@section('content')

<form action="{{route('curso.store')}}"method="POST">
    @csrf
    <label class="mt-3">Nome</label>
    <input type="text" name="name" class="form-control"/>
    <label class="mt-3">Abreviatura</label>
    <input type="text" name="abreviatura" class="form-control"/>
    <label class="mt-3">Duração (anos)</label>
    <input type="number" name="duracao" class="form-control"/>
    <label class="mt-3">Eixo</label>
    <select name="eixo">
     <option selected disabled></option>   
    @foreach ($eixos as $item)
        <option value="{{$item->id}}">{{$item->name}}</option>
    @endforeach
    </select>

<input type="submit" value="Salvar" class="btn btn-success mt-2">
</form>

@endsection