@extends('layouts.app')
@section('title', 'Cadastrar Construção')
@section('content')
<div class="container">
    <h1>Cadastro de Construção</h1>
    {{Form::open(['route' => 'construcoes.store', 'method' => 'POST','enctype'=>'multipart/form-data'])}}
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Preço</label>
            <input type="text" class="form-control" id="preco" name="preco">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Área</label>
            <input type="text" class="form-control" id="areaTerreno" name="areaTerreno" placeholder="em m²">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Data de início</label>
            {{Form::text('dataInicio',\Carbon\Carbon::now()->format('d/m/Y H:i:s'),['class'=>'form-control','required','placeholder'=>'Data','rows'=>'8'])}}
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Data prevista de finalizaçao</label>
            {{Form::text('dataFim',\Carbon\Carbon::now()->format('d/m/Y H:i:s'),['class'=>'form-control','required','placeholder'=>'Data','rows'=>'8'])}}
        </div>
        <select class="form-select" aria-label="Default select example" name="finalidade" id="finalidade">
            <option selected>Finalidade</option>
            <option value="Residencial">Residencial</option>
            <option value="Comercial">Comercial</option>
            <option value="Industrial">Industrial</option>
        </select>
        {{Form::label('cliente_id', 'Cliente')}}
        {{Form::text('cliente_id','',['class'=>'form-control','required','placeholder'=>'Selecione um Cliente','list'=>'listaClientes'])}}
        <datalist id="listaClientes">
            @foreach($clientes as $cliente)
                <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
            @endforeach
        </datalist>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Detalhes</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="detalhes" name="detalhes"></textarea>
        </div>
        {{Form::submit('Salvar', ['class' => 'btn btn-success'])}}
        {!!Form::button('Cancelar', ['onclick' => 'javascript:history.go(-1)', 'class' => 'btn btn-danger'])!!}
    {{Form::close()}}
</div>
@endsection
