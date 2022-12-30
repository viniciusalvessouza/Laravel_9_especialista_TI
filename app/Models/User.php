<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //aceita os dois tipos, string ou null
    public function getUsers(string|null $search = '')
    {
         //nesse where sai uma query passada por parametros 
            //tenho que rever pois acho q o comando para retornar a query é outro
        //$users = $this->model->where('name','LIKE',"%{$request->search}%")->get();
        
        //usando funcao callback dessa forma da pra ser mais esperto, ...
            // organizado e engenhoso

        $users = $this->where(function ($query) use ($search){
            if($search)
            {
                $query->where('email',$search);
                $query->orWhere('name','LIKE',"%{$search}%");
            }
        })->with('comments')->paginate(15);
        //->simplePaginate(1);
        
        //get();

        return $users;
    }

    public function comments()
    {
        //os dois ultimos parametros sao opcionais pois sao nomes padrao, mas coloquei pra lembrar deles
        //has many, um usuario tem muitos comentarios
        return $this->hasMany(Comment::class,'user_id','id');
    }
}
