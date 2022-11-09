@extends('layouts.app')
@section('title', 'Lista de Construções')
@section('content')
<div class="container">
    <h1>Lista de Construções</h1>
    <div class="row">
        <div class="col-sm-3">
            <a class="btn btn-primary" href="{{url('construcoes/create')}}">Começar Construção</a>
        </div>
        <div class="col-sm-9">
            <div class="input-group ml-5">
                @if($busca !== null)
                    &nbsp;<a class="btn btn-info" href="{{url('construcoes/')}}">Todos</a>&nbsp;
                @endif
                {{Form::text('busca',$busca,['class'=>'form-control','required','placeholder'=>'buscar'])}}
                &nbsp;
                <span class="input-group-btn">
                    {{Form::submit('Buscar',['class'=>'btn btn-secondary'])}}
                </span>
            </div>
        </div>
    </div>
    <br>    
    <table class="table table-striped">
        <tr>
            <td>ID</td>
            <td>Situação</td>
            <td>Preço</td>
            <td>Área</td>
            <td>Finalidade</td>
            <td>Cliente</td>
            <td>Pago</td>
        </tr>
        @foreach ($construcoes as $construcao)
            <tr>
                <td><a href="{{url('construcoes/'.$construcao->id)}}">{{$construcao->id}}</a></td>
                <td>{{$construcao->situacao}}</td>
                <td>R${{$construcao->preco}}</td>
                <td>{{$construcao->areaTerreno}}m²</td>
                <td>{{$construcao->finalidade}}</td>
                <td>{{$construcao->cliente->nome}}
                <td>{{$construcao->pago}}</td>
            </tr>
        @endforeach
    </table>
    {{$construcoes->links()}}
</div>
@endsection
