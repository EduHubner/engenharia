@extends('layouts.app')
@section('title', 'Cliente '.$cliente->id)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>Cliente - {{$cliente->nome}}</h1></div>

                <div class="card-body">
                    @php
                        $nomeimagem = "";
                        if(file_exists("./imagens/clientes/".md5($cliente->id).".jpg")) {
                            $nomeimagem = "./imagens/clientes/".md5($cliente->id).".jpg";
                        } elseif (file_exists("./imagens/clientes/".md5($cliente->id).".png")) {
                            $nomeimagem = "./imagens/clientes/".md5($cliente->id).".png";
                        } elseif (file_exists("./imagens/clientes/".md5($cliente->id).".gif")) {
                            $nomeimagem =  "./imagens/clientes/".md5($cliente->id).".gif";
                        } elseif (file_exists("./imagens/clientes/".md5($cliente->id).".webp")) {
                            $nomeimagem = "./imagens/clientes/".md5($cliente->id).".webp";
                        } elseif (file_exists("./imagens/clientes/".md5($cliente->id).".jpeg")) {
                            $nomeimagem = "./imagens/clientes/".md5($cliente->id).".jpeg";
                        } else {
                            $nomeimagem = "./imagens/clientes/semfoto.webp";
                        }
                    @endphp

                    {{Html::image(asset($nomeimagem),'Foto de '.$cliente->nome,["class"=>"img-thumbnail"])}}

                    <h2><b>ID: {{$cliente->id}}</b></h2>
                    <h3>E-mail: <a href="mailto:{{$cliente->email}}">{{$cliente->email}}</a></h3>
                    Telefone: {{$cliente->telefone}}
                    <br>
                    Cidade: {{$cliente->cidade}}
                    <br>
                    @auth
                        {{Form::open(['route' => ['clientes.destroy',$cliente->id],'method' => 'DELETE'])}}
                            @if ($nomeimagem !== "./imagens/clientes/semfoto.webp")
                                {{Form::hidden('foto',$nomeimagem)}}
                            @endif
                            <a href="{{url('clientes/'.$cliente->id.'/edit')}}" class="btn btn-success">Alterar</a>
                            {{Form::submit('Excluir',['class'=>'btn btn-danger','onclick'=>'return confirm("Confirma exclusão?")'])}}
                            <a href="{{url('clientes/')}}" class="btn btn-secondary">Voltar</a>
                        {{Form::close()}}
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
