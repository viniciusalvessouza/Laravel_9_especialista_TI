<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {   
        //O LOCAL DAS QUERYS EH NOS MODELS OU NOS REPOSITORY, AQUI NAO

        //nesse where sai uma query passada por parametros
        //$users = User::where('name','LIKE',"%{$request->search}%")->get();
        
        //usando funcao callback dessa forma da pra ser mais esperto, ...
            // organizado e engenhoso

        $search = $request->search;
        $users = User::where(function ($query) use ($search){
            if($search)
            {
                $query->where('email',$search);
                $query->orWhere('name','LIKE',"%{$search}%");
            }

            //dd($search);
        })->get();


        //retorna a query
        //$users = User::where('name','LIKE',"%{$request->name}%")->toSql();
        
        //$users = User::get();
        //dd($users);

        if(!$users)
            return redirect()->route('users.index');
        
        return view('users.index',compact('users')); 
    }
    public function show($id)
    {

        //dessa forma de cima eu especifico a condicao
        //$user =User::where( 'id','=',$id)->get()->first();
        
        $user =User::where( 'id',$id)->get()->first();

        // outra forma possivel
        //aqui eu testo o user find para o caso de entrar em um find que nao existe
        if(!$user = User::find($id))
            return redirect()->route('users.index');

        return view('users.show',compact('user'));

        //return $user;

        //dd($user);   
    }

    public function create()
    {
        
        //  como eu estava pensando
            // return view('formulario.index');

        //como o cara do  video fez, o que eh o mais obvio e correto
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request)
    {
        //dd('Cadastrando o usuario');
        //dd($request->all());

        // dd($request->only([
        //     'name', 'email', 'password'
        // ]));

        //essa coisa do user vai ser mudada em algum momento
        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->save();
        
        //ou

        //para criar um usuario
        //User::create($request->all());
        
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        
        //dessa forma eu posso retornar a pagina do usuario criado
        //$user = User::create($data);
        //return redirect()->route('index.show',$user->id);

        User::create($data);
        
        return redirect()->route('users.index');
        
    }

    public function edit($id)
    {

        if(!$user = User::find($id))
            return redirect()->route('users.index');

        return view ('users.edit',compact('user'));
    }

    public function update(StoreUpdateUserFormRequest $request,$id)
    {

        if(!$user = User::find($id))
            return redirect()->route('users.index');

        // $data = $request->all();
        $data = $request->only((['name','email']));
        if($request->password)
            $data['password'] = bcrypt($request);

        $user->update($data);
        //dd($request->all());

        return redirect()->route('users.index');
    }
    
    public function delete($id)
    {
        if(!$user = User::find($id))
            return redirect()->route('users.index');

        $user->delete();

        return redirect()->route('users.index');
    }
}
