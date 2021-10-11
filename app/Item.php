<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $table = 'produtos';
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    public function itemDetalhe()
    {
        return $this->hasOne('App\ItemDetalhe', 'produto_id', 'id');
    }

    public function fornecedor()
    {
        //BUSCA O VALOR NA TABELA FORNECEDOR, ELOQUENT ORM 1 PARA N
        return $this->belongsTo('App\Fornecedor');
    }

    public function pedidos() {
        return $this->belongsToMany('App\Pedido', 'pedidos_produtos', 'produto_id', 'pedido_id');
        /*
         * Parametros do belongsToMany
         * 3- Representa o nome da FK da tabela mapeada pelo model na tabela de relacionamento (produto_id)
         * 4- Representa o nome da FK da tebela mapeada pelo model utilizada no relacionamento que estamos implementando
         */
    }
}
