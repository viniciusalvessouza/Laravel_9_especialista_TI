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

    @if($errors->any())
		<ul class=’errors’>
			@foreach($errors->all() as $error)
				<li class=’error’> {{$error}} </li>
			@endforeach
		</ul>
	@endif

    <form action="{{route('users.update',$user->id)}}" method="post">
        {{--Nao sei se esse arroba eh a melhor forma de fazer isso,
            achei gambiarra, mas ta no video--}}
        @method('PUT')
        
        @csrf
        
        <label for="name">Nome: </label>  <input type='text' id='name' name='name' placeholder='Nome' value="{{$user->name}}"> <br>

        <label for="email">Email: </label><input type='email' id='email' name='email' placeholder='E-mail' value="{{$user->email}}"> <br>

        <label for="password">Senha: </label><input type='password' id='password' name='password' placeholder='Senha'> <br>

        <input type="submit" value='enviar'>    
    </form>


@endsection