@extends('layouts.app')
@section('title', 'Editar Cliente '.$cliente->nome)
@section('content')
<div class="container">
    <h1>Editar Cliente - {{$cliente->nome}}</h1>
    @if(Session::has('mensagem'))
        <div class="alert alert-success">
            {{Session::get('mensagem')}}
        </div>
    @endif
    {{Form::open(['route' => ['clientes.update', $cliente->id], 'method' => 'PUT','enctype'=>'multipart/form-data'])}}
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{$cliente->nome}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$cliente->email}}" placeholder="nome@examplo.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="{{$cliente->telefone}}" placeholder="(99) 99999-9999">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" value="{{$cliente->cidade}}">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Foto</label>
            <input class="form-control" type="file" id="foto" name="foto">
        </div>
        {{Form::submit('Salvar', ['class' => 'btn btn-success'])}}
        {!!Form::button('Cancelar', ['onclick' => 'javascript:history.go(-1)', 'class' => 'btn btn-danger'])!!}
    {{Form::close()}}
</div>
@endsection