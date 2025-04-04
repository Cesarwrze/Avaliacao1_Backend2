<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco',
        'descricao',
        'estoque',
        'categoriaId',
        'empresaId'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoriaId');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresaId');
    }

    public function vendas() {
        return $this->belongsToMany(Venda::class, 'vendaProduto', 'produtoId', 'vendaId')->withPivot('quantidade', 'precoUnitario');
    }

}
