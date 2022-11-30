@extends('layouts.app')
@section('title',"Comentarios do usario {$user->name}")

@section('content')
    
    <h1> 
        Comentarios do usuario {{$user->name}}
        <a href="{{route('users.create')}}">+ </a> <br>
        <a href="{{route('users.index')}}">Voltar </a>
    </h1>

    <form action="{{route('users.index')}}" method="get">
        <input type="text" name="search" placeholder="Pesquisar">
        <button>Pesquisar</button>
    </form>

    <ul>

        <table>
            <thead>
            <th> <td> Comentario</td> <td>Visibilidade</td> </th>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <th>
                        <td> {{$comment->body}} </td>
                        <td> {{$comment->visible}} </td>
                    </th>
                @endforeach
            </tbody>
        </table>

    </ul>

@endsection     
