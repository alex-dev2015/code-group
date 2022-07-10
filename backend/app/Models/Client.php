<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;


    /**
     * Indica os campos que podem ter valor definido via
     * definição de dados em massa
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'cpf',
        'mail',
        'phone',
        'address',
    ];

    /**
     * Define os campos escondidos no momento da serialização
     * 
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
}
