@extends('layouts.app')

@section('title',"Novo Comentário Para o Usuário {$user->name}")

@section('content')

<h1>
    Novo Comentário Para o Usuário {{$user->name}}
    <a href="{{route('comments.index',$user->id)}}">Voltar </a>
</h1>

{{--
    esse daqui eh para testar erros no cadastro, 
        no caso eu uso pra saber se meu request de inserir usuarios aceitou ou nao
    a variavel errors eh criada pelo Laravel, eu nao criei ela, soh uso    
--}}

    @include('users.includes.validations-form')

<form action="{{route('comments.store',$user->id)}}" method="POST">
    @include('users.comments._partials.form')
</form>

@endsection