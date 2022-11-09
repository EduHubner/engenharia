@extends('layouts.app')
@section('title', 'Cliente '.$construcao->id)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Construção de {{$construcao->cliente->nome}}</h1></div>

                <div class="card-body">

                    <h2><b>ID: {{$construcao->id}}</b></h2>
                    <h2>Preço: R${{$construcao->preco}}</h2>
                    <h3>Situação: {{$construcao->situacao}}</h3>                    
                    <h3>Finalidade: {{$construcao->finalidade}}</h3>
                    <h4>Cliente: {{$construcao->cliente->nome}}</h4>                    
                    Área: {{$construcao->areaTerreno}}m²
                    <br>
                    Corpo de Bombeiros: {{$construcao->aprovacaoBombeiros}}
                    <br>
                    Celesc: {{$construcao->aprovacaoCelesc}}
                    <br>
                    Alvará de Construção: {{$construcao->alvaraDeConstrucao}}
                    <br>
                    Pago: {{$construcao->pago}}
                    <br>
                    Data de início: {{$construcao->dataInicio}}
                    <br>
                    Data prevista para finalizaçao: {{$construcao->dataFim}}
                    <br>
                    Detalhes: {{$construcao->detalhes}}
                    <br>
                    @auth
                        {{Form::open(['route' => ['construcoes.destroy',$construcao->id],'method' => 'DELETE'])}}                            
                            <a href="{{url('construcoes/'.$construcao->id.'/edit')}}" class="btn btn-success">Alterar</a>
                            {{Form::submit('Excluir',['class'=>'btn btn-danger','onclick'=>'return confirm("Confirma exclusão?")'])}}
                            <a href="{{url('construcoes/')}}" class="btn btn-secondary">Voltar</a>
                        {{Form::close()}}
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
