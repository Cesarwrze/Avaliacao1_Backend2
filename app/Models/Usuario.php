<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'cpf',
        'telefone',
        'estado',
        'cidade',
        'rua'
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class, 'usuarioId', 'id');
    }

}
