<?php

use Illuminate\Database\Seeder;
use App\SiteContato;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
        //modelo 1 de criacao - instanciando o objeto
        $contato = new SiteContato();
        $contato->nome = 'Sitema SG';
        $contato->telefone = '(11)3333-3333';
        $contato->email = 'contato@sg.com.br';
        $contato->motivo_contato = 1;
        $contato->mensagem = 'Seja bem-vindo ao sistema Super Gestão';
        $contato->save();
         */

        factory(SiteContato::class, 100)->create();
    }
}
