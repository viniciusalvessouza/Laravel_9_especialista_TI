@extends('layouts.app')
@section('title',"Comentarios do usario {$user->name}")

@section('content')
    
    <h1> 
        Comentarios do usuario  ----- {{$user->name}}
        <a href="{{route('comments.create',$user->id)}}">+ </a> <br>
        <a href="{{route('users.index')}}">Voltar </a>
    </h1>

    <form action="{{route('comments.index',$user->id)}}" method="get">
        <input type="text" name="search" placeholder="Pesquisar">
        <button>Pesquisar</button>
    </form>


        <table>
            <thead>
            <tr> <th> Comentario</th> <th>Visibilidade</th> </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td> {{$comment->body}} </td>
                        <td> {{$comment->visible ? 'SIM': 'NAO'}} </td>
                        <td> <a href={{route('comment.edit',[$user->id,$comment->id])}}>editar </a> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    

@endsection     
