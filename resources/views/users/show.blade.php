@extends('layouts.app')
@section('title','Listagem do usuario')

@section('content')

    <h1> Listagem do usuário - {{$user->name}} </h1>
    <a href="{{route('users.index')}}""> voltar  </a>
    <ul>
        <li>{{$user->name}}</li>
        <li>{{$user->email}}</li>
        <li>{{$user->created_at}}</li>
    </ul>

    <form action="{{route('users.delete',$user->id)}}" method="POST">
        @method('DELETE')
        @csrf

        <button type="submit"> Deletar </button>
    </form>
    

@endsection