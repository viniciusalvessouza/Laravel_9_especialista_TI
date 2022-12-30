@extends('layouts.app')

@section('title','Novo Usuario')

@section('content')

    <h1>
        Novo Usuário
        <a href="{{route('users.index')}}">Voltar </a>
    </h1>
    
    {{--
        esse daqui eh para testar erros no cadastro, 
            no caso eu uso pra saber se meu request de inserir usuarios aceitou ou nao
        a variavel errors eh criada pelo Laravel, eu nao criei ela, soh uso    
    --}}

    @include('users.includes.validations-form')

    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
        @include('users._partials.form')
    </form>


@endsection