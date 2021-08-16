<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    public function produtoDetalhe(){

        //função nativa, ele vai buscar 1 registro relacionado em produto_detalhe (fk) -> produto_id
        return $this->hasOne('App\ProdutoDetalhe');
    }
}
