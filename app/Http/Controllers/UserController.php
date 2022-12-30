<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }
    public function index(Request $request)
    {   
        //chamo o metodo e passo o parametro do request search ou ''
        $users = $this->model
                            ->getUsers(
                                search: $request->search ?? ''
                            ); 

        if(!$users)
            return redirect()->route('users.index');
        
        return view('users.index',compact('users')); 
    }
    public function show($id)
    {

        //dessa forma de cima eu especifico a condicao
        //$user =$this->model->where( 'id','=',$id)->get()->first();
        
        $user =$this->model->where( 'id',$id)->get()->first();

        // outra forma possivel
        //aqui eu testo o user find para o caso de entrar em um find que nao existe
        if(!$user = $this->model->find($id))
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
        //$this->model->create($request->all());
        
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        //dd($request->file('image'));
        //dd($request->image); //forma alternativa
        
        if($request->file('image'))
        {
            //users representa a pasta em que vai armazenar, dentro do local ...
                //que eu defini nas configuracoes
            $data['image'] = $request->file('image')->store('users');

            //pega a extensao fo arquivo
            //$extension =$request->image->getClientoriginalExtension();

            //storeAs permite definir um nome e uma pasta para o arquivo
            //$data['image'] = $request->file('image')->storeAs('users',now().".{$extension}");
        }  
        else{
            $data['image'] = '';
        }
        //dessa forma eu posso retornar a pagina do usuario criado
        //$user = $this->model->create($data);
        //return redirect()->route('index.show',$user->id);

        $this->model->create($data);
        
        return redirect()->route('users.index');
        
    }

    public function edit($id)
    {

        if(!$user = $this->model->find($id))
            return redirect()->route('users.index');

        return view ('users.edit',compact('user'));
    }

    public function update(StoreUpdateUserFormRequest $request,$id)
    {

        if(!$user = $this->model->find($id))
            return redirect()->route('users.index');

        // $data = $request->all();
        $data = $request->only((['name','email']));
        if($request->password)
            $data['password'] = bcrypt($request->password);
        //dd($request->password,$data['password']);
        if($request->image)
        {   
            if($user->imagem)
                if(Storage::exists($user->image))
                {
                    Storage::delete($user->image);
                }
            $data['image'] = $request->image->store('users');
        }

        //dd($data['image']);

        $user->update($data);
        //dd($request->all());

        return redirect()->route('users.index');
    }
    
    public function delete($id)
    {
        if(!$user = $this->model->find($id))
            return redirect()->route('users.index');
        //essa eu fiz por conta para apagar a imagem quando apago o usuario
        $img = '';
        if($user->image)
            $img= $user->image;
            
        $user->delete();
        echo Storage::delete($img);
        
        return redirect()->route('users.index');
    }
}
