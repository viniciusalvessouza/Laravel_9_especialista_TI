@extends('layouts.app')
@section('title','Listagem dos usuarios')

@section('content')
    
    <h1> 
        Listagem dos usuários
        <a href="{{route('users.create')}}">+ </a>
    </h1>

    <form action="{{route('users.index')}}" method="get">
        <input type="text" name="search" placeholder="Pesquisar">
        <button>Pesquisar</button>
    </form>

    <ul>
    @foreach($users as $user)
        <li>    
            @if($user->image)
                <img src="{{url("storage/{$user->image}")}}" alt="{{$user->image}}">
            
            @else
                <img src="{{url("storage/users/default.jpeg")}}" alt="default.jpeg">
            @endif

            Nome: {{$user->name}} - 
            Email: {{$user->email}}
             |<a href="{{route('users.edit',$user->id )}}">Editar </a>
             |<a href="{{route('users.show',$user->id )}}">Ver detalhes </a>
             |<a href="{{route('comments.index',$user->id )}}">Ver Comentarios |{{$user->comments->count() ?? 0 }} |</a>
        </li>
    @endforeach

    </ul>
        <div style="">
            {{
            $users->appends([
                'search'=> request()->get('search','')
            ])->links()
            }}
        </div>
    <!--
        Usei esse style para melhorar um pouco o formato que estava terrivel
        Ele usa o tailwind como base pra pre configurar (segundo a documentacao)...
            mas nao esta instalado por enquanto
    -->
        <style>
            svg{
                width: 100px;
                height: 100px;
            }
            img{
                width:30px;
                height: 30px;
            }
        </style>
@endsection     



