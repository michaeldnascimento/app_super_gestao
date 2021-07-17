<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    // usando trait, metodo para herda mais de uma classe - metodo de remocao suave
    use SoftDeletes;
    //caso o eloquent nao consiga achar o nome do banco, colocando desta forma ele entende que precisa sobrepor o nome do banco
    protected $table = 'fornecedores';
    //para consegui enviar dados usando o tiker em forma de array ex: \App\Fornecedor::create(['nome'=>'Fornecedor qwe', 'site'=>'fornecedorqwre.com.br', 'uf'=>'SP', 'emai'=>'contato@fornecedorqwe.com.br']);
    protected $fillable = ['nome', 'site', 'uf', 'email'];
}
