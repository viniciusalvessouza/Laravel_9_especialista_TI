<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

//assim fica mais interessante de ver, pois estou importando tudo da Models
use App\Models\{
    Comment,
    User
};
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentModel;
    protected $userModel;
    public function __construct(Comment $comment,User $user)
    {
        $this->commentModel = $comment;
        $this->userModel = $user;
    }

    public function index($userId)
    {
        
        
        if(!$user = $this->userModel->find($userId)){
            return redirect()->back();
        };
        //esse metodo eu fiz para pesquisar nos comentarios
        $comments = $user->comments()->get();

        return view('users.comments.index',compact('user','comments'));
    }
}
