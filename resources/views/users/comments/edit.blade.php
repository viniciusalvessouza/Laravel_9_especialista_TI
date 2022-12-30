@extends('layouts.app')

@section('title','Editar comentario do usuario {{$user->name}}')

@section('content')

    <h1>
        Editar Comentario do Usuário - {{$user->name}}  <br>
        <a href="{{route('comments.index',$user->id)}}">Voltar </a>
    </h1>
    
    {{--
        esse daqui eh para testar erros no cadastro, 
            no caso eu uso pra saber se meu request de inserir usuarios aceitou ou nao
        a variavel errors eh criada pelo Laravel, eu nao criei ela, soh uso    
    --}}

   @include('users.includes.validations-form')
   
   <form action="{{route('comment.update',[$user->id,$comment->id])}}" method="post">
        {{--Nao sei se esse arroba eh a melhor forma de fazer isso,
            achei gambiarra, mas ta no video--}}
        @method('PUT')

        @include('users.comments._partials.form')
    
    </form>

@endsection