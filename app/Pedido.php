<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    // usando o belongsToMany para relacionar produto com pedidos produtos
    public function produtos()
    {
        //return $this->belongsToMany('App\Produto', 'pedidos_produtos');

        return $this->belongsToMany('App\Item', 'pedidos_produtos', 'pedido_id', 'produto_id')->withPivot('id', 'created_at', 'updated_at');
        /*
         * Relacionamentos belongsToMany
         * 1- Modelo do relacionamento NxN em relação o modelo que estamos implementando
         * 2- É a tabela auxiliar que armazena os reguistros de relacionamento
         * 3- Representa o nome da FK da tabela mapeada pelo modelo na tabela de relacionamento
         * 4- Representa o nome da FK da tabela mapeada pelo model ultilizada no relacionamento que estamos implementando
         * withPivot usando o pivot, trás a coluna desejada
         */
    }
}
