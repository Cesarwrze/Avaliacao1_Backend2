<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuarioId',
        'produtos',
        'precoTotal',
        'formaPagamento',
        'status',
        'dataVenda'
    ];

    public function produtosRelacionados() {
        return $this->belongsToMany(Produto::class, 'vendaProduto', 'vendaId', 'produtoId')->withPivot('quantidade', 'precoUnitario');
    }

}
