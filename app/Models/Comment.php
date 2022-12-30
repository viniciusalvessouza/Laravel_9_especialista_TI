<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\User;

class Comment extends Model
{
    use HasFactory;
    //se eu quisesse dar um nome pra tabela diferente
    //protected $table ='comentarios';

    //colunas que podem ser preenchidas
    protected $fillable =[
        'body',
        'visible'
    ];

    //forco a conversao do tipo de entrada (pelo que entendi)
    protected $casts =[
        'visible' => 'boolean'
    ];

    public function User()
    {
        // belongsTos = os comentarios soh tem 1 usuario
        return $this->belongsTo(User::class);
    }
}
