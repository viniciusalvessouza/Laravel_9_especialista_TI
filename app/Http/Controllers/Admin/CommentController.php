<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCommentRequest;
//assim fica mais interessante de ver, pois estou importando tudo da Models
use App\Models\{
    Comment,
    User
};
use Illuminate\Http\Request;
use PharIo\Manifest\Url;

class CommentController extends Controller
{
    protected $commentModel;
    protected $userModel;
    public function __construct(Comment $comment,User $user)
    {
        $this->commentModel = $comment;
        $this->userModel = $user;
    }

    public function index(Request $request, $userId)
    {
        
        if(!$user = $this->userModel->find($userId)){
            return redirect()->back();
        };

        //esse metodo eu fiz para pesquisar nos comentarios
        //esse daqui ficou um pouco diferente do userController, pq o user->comments() ...
            //retorna a propria model dos comments (eu que fiz isso seguindo as aulas)
        $comments = $user->comments()
                            ->where('body','LIKE',"%{$request->search}%")
                            ->get();

        return view('users.comments.index',compact('user','comments'));
    }

    public function create($userId)
    {
        if(!$user = $this->userModel->find($userId)){
            return redirect()->back();
        };

        return view('users.comments.create',compact('user'));
    }

    public function store(StoreUpdateCommentRequest $request, $userId)
    {
        if(!$user = $this->userModel->find($userId)){
            return redirect()->back();
        };
        
        $data = $request->all();
        //esse tratamento dos dados, fica aonde?
            //se eu tratar aqui ok, mas se eu for usar isso com frequencia, apnde eu deixo?
        //nesse caso eu vou tratar aqui, mas fica a duvida
        if(isset($data['visible']))
            $data['visible'] = TRUE;
        else 
            $data['visible'] = FALSE;


        $user->comments()->create($data);
        
        return redirect()->route('comments.index',$userId); 
    }

    public function edit($userId, $commentId)
    {
    
        if(!$comment = $this->commentModel->find($commentId)){
            return redirect()->back();
        };

        $user = $comment->user;

        return view('users.comments.edit',compact('comment','user') );
        //return " Comments edit {$commentId}";

    }

    public function update(StoreUpdateCommentRequest $request,$userId, $commentId)
    {
        if(!$comment = $this->commentModel->find($commentId)){
            return redirect()->back();
        };
        
        $data = $request->all();
        //esse tratamento dos dados, fica aonde?
            //se eu tratar aqui ok, mas se eu for usar isso com frequencia, apnde eu deixo?
        //nesse caso eu vou tratar aqui, mas fica a duvida
        if(isset($data['visible']))
            $data['visible'] = TRUE;
        else 
            $data['visible'] = FALSE;


        $comment->update([
            'body'=> $data['body'],
            'visible'=> $data['visible']
        ]);
        
        return redirect()->route('comments.index',$comment->user_id); 
        //return 'atualizado?'.$commentId;
    }


    //nao sei bem se deveria usar private ou protected aqui, fiz para evitar ficar repetindo esse if
    //Nao sei se em que nivel as controllers podem ficar grandes, ...
        //mas nao sei se eh um problema por isso aqui, em vez de em um request ou outro lugar
    //Nem estou usando mas deixei aqui para pensar no assunto kkk
    protected function validateUser(int $userId)
    {
        if(!$user = $this->userModel->find($userId)){
            return null;
        };

        //return redirect()->back();
        return $user;
    }
}
