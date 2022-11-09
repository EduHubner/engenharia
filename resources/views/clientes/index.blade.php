@extends('layouts.app')
@section('title', 'Lista de Clientes')
@section('content')
<div class="container">
    <h1>Lista de Clientes</h1>
    <div class="row">
        <div class="col-sm-3">
            <a class="btn btn-primary" href="{{url('clientes/create')}}">Cadastrar</a>
        </div>
        <div class="col-sm-9">
            <div class="input-group ml-5">
                @if($busca !== null)
                    &nbsp;<a class="btn btn-info" href="{{url('clientes/')}}">Todos</a>&nbsp;
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
            <td>Nome</td>
            <td>E-mail</td>
            <td>Telefone</td>
            <td>Cidade</td>
        </tr>
        @foreach ($clientes as $cliente)
            <tr>
                <td><a href="{{url('clientes/'.$cliente->id)}}">{{$cliente->id}}</a></td>
                <td>{{$cliente->nome}}</td>
                <td>{{$cliente->email}}</td>
                <td>{{$cliente->telefone}}</td>
                <td>{{$cliente->cidade}}</td>
            </tr>
        @endforeach
    </table>
    {{$clientes->links()}}
</div>
@endsection
