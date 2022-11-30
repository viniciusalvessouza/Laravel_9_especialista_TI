        @csrf
        
        <label for="name">Nome: </label>  <input type='text' id='name' name='name' placeholder='Nome' value="{{$user->name ?? old('name')}}"> <br>

        <label for="email">Email: </label><input type='email' id='email' name='email' placeholder='E-mail' value="{{$user->email ?? old('mail')}}"> <br>

        <label for="password">Senha: </label><input type='password' id='password' name='password' placeholder='Senha'> <br>

        <input type="submit" value='enviar'>    