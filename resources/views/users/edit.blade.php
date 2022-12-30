@extends('layouts.app')

@section('title','Editar Usuário {{$user->name}}')

@section('content')

    <h1>
        Editar Usuário {{$user->name}} 
        <a href="{{route('users.index')}}">Voltar </a>
    </h1>
    
    {{--
        esse daqui eh para testar erros no cadastro, 
            no caso eu uso pra saber se meu request de inserir usuarios aceitou ou nao
        a variavel errors eh criada pelo Laravel, eu nao criei ela, soh uso    
    --}}

   @include('users.includes.validations-form')

    <form action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
        {{--Nao sei se esse arroba eh a melhor forma de fazer isso,
            achei gambiarra, mas ta no video--}}
        @method('PUT')
        
        @include('users._partials.form')
    </form>


@endsection