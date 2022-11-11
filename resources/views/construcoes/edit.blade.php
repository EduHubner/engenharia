@extends('layouts.app')
@section('title', 'Editar Construção')
@section('content')
<div class="container">
    <h1>Editar Construção</h1>
    @if(Session::has('mensagem'))
        <div class="alert alert-success">
            {{Session::get('mensagem')}}
        </div>
    @endif
    {{Form::open(['route' => ['construcoes.update', $construcao->id], 'method' => 'PUT','enctype'=>'multipart/form-data'])}}
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Preço</label>
            <input type="text" class="form-control" id="preco" name="preco" value="{{$construcao->preco}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Área</label>
            <input type="text" class="form-control" id="areaTerreno" name="areaTerreno" value="{{$construcao->areaTerreno}}" placeholder="em m²">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Data de início</label>
            {{Form::date('dataInicio',$construcao->dataInicio,['class'=>'form-control'])}}
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Data prevista de finalizaçao</label>
            {{Form::date('dataInicio',$construcao->dataFim,['class'=>'form-control'])}}
        </div>

        @switch($construcao->finalidade)
            @case('Residencial')
                @php
                    $res = 'selected';
                    $com = null;
                    $ind = null;
                @endphp
                @break
            @case('Comercial')
                @php
                    $res = null;
                    $com = 'selected';
                    $ind = null;
                @endphp
                @break
            @case('Industrial')
                @php
                    $res = null;
                    $com = null;
                    $ind = 'selected';
                @endphp
                @break
            @default
        @endswitch

        <label for="exampleFormControlInput1" class="form-label">Finalidade</label>
        <select class="form-select" aria-label="Default select example" name="finalidade" id="finalidade">
            <option>Finalidade</option>
            <option value="Residencial" {{$res}}>Residencial</option>
            <option value="Comercial" {{$com}}>Comercial</option>
            <option value="Industrial" {{$ind}}>Industrial</option>
        </select>

        @switch($construcao->alvaraDeConstrucao)
            @case(null)
                @php
                    $aprovA = null;
                    $naoAprovA = 'selected';
                @endphp
                @break
            @case('Não aprovado')
                @php
                    $aprovA = null;
                    $naoAprovA = 'selected';
                @endphp
                @break
            @case('Aprovado')
                @php
                    $aprovA = 'selected';
                    $naoAprovA = null;
                @endphp
                @break
            @default
        @endswitch

        <label for="exampleFormControlInput1" class="form-label">Alvará de Construção</label>
        <select class="form-select" aria-label="Default select example" id="alvaraDeConstrucao" name="alvaraDeConstrucao">
            <option>Alvará de Construção</option>
            <option value="Não aprovado" {{$naoAprovA}}>Não aprovado</option>
            <option value="Aprovado" {{$aprovA}}>Aprovado</option>
        </select>

        @switch($construcao->aprovacaoBombeiros)
            @case(null)
                @php
                    $aprovB = null;
                    $naoAprovB = 'selected';
                @endphp
                @break
            @case('Não aprovado')
                @php
                    $aprovB = null;
                    $naoAprovB = 'selected';
                @endphp
                @break
            @case('Aprovado')
                @php
                    $aprovB = 'selected';
                    $naoAprovB = null;
                @endphp
                @break
            @default
        @endswitch

        <label for="exampleFormControlInput1" class="form-label">Corpo de Bombeiros</label>
        <select class="form-select" aria-label="Default select example" id="aprovacaoBombeiros" name="aprovacaoBombeiros">
            <option>Corpo de Bombeiros</option>
            <option value="Não aprovado" {{$naoAprovB}}>Não aprovado</option>
            <option value="Aprovado" {{$aprovB}}>Aprovado</option>
        </select>

        @switch($construcao->aprovacaoCelesc)
            @case(null)
                @php
                    $aprovC = null;
                    $naoAprovC = 'selected';
                @endphp
                @break
            @case('Não aprovado')
                @php
                    $aprovC = null;
                    $naoAprovC = 'selected';
                @endphp
                @break
            @case('Aprovado')
                @php
                    $aprovC = 'selected';
                    $naoAprovC = null;
                @endphp
                @break
            @default
        @endswitch

        <label for="exampleFormControlInput1" class="form-label">Celesc</label>
        <select class="form-select" aria-label="Default select example" id="aprovacaoCelesc" name="aprovacaoCelesc">
            <option>Celesc</option>
            <option value="Não aprovado" {{$naoAprovC}}>Não aprovado</option>
            <option value="Aprovado" {{$aprovC}}>Aprovado</option>
        </select>

        @switch($construcao->pago)
            @case(null)
                @php
                    $sim = null;
                    $nao = 'selected';
                @endphp
                @break
            @case('Não')
                @php
                    $sim = null;
                    $nao = 'selected';
                @endphp
                @break
            @case('Sim')
                @php
                    $sim = 'selected';
                    $nao = null;
                @endphp
                @break
            @default
        @endswitch

        <label for="exampleFormControlInput1" class="form-label">Pago</label>
        <select class="form-select" aria-label="Default select example" id="pago" name="pago">
            <option>Pago</option>
            <option value="Não" {{$nao}}>Não</option>
            <option value="Sim" {{$sim}}>Sim</option>
        </select>
        
        {{Form::label('cliente_id', 'Cliente')}}
        {{Form::text('cliente_id',$construcao->cliente->nome,['class'=>'form-control','required','placeholder'=>'Selecione um Cliente','list'=>'listaClientes'])}}
        <datalist id="listaClientes">
            @foreach($clientes as $cliente)
                <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
            @endforeach
        </datalist>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Detalhes</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="detalhes" name="detalhes">{{$construcao->detalhes}}</textarea>
        </div>
        {{Form::submit('Salvar', ['class' => 'btn btn-success'])}}
        {!!Form::button('Cancelar', ['onclick' => 'javascript:history.go(-1)', 'class' => 'btn btn-danger'])!!}
    {{Form::close()}}
</div>
@endsection
