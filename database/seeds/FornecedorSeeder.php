<?php

use Illuminate\Database\Seeder;
use App\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //modelo 1 de criacao - instanciando o objeto
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Fornecedor 100';
        $fornecedor->site = 'fornecedor100.com.br';
        $fornecedor->uf = 'CE';
        $fornecedor->email = 'contanto@fornecedor100.com.br';
        $fornecedor->save();

        // modelo 2 de criacao - usando o metodo create (atencao para o atributo fillable da classe)
        Fornecedor::create([
            'nome'=>'fornecedor200',
            'site' => 'fornecedor200',
            'uf' => 'RS',
            'email' => 'contato@fornecedor200.com.br'
        ]);

        // modelo 3 - usando o metodo DB insert
        DB::table('fornecedores')->insert([
            'nome'=>'fornecedor300',
            'site' => 'fornecedor300',
            'uf' => 'RJ',
            'email' => 'contato@fornecedor300.com.br'
        ]);

    }
}
