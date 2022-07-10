<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *  schema="code_client",
 *  title="client",
 * 	@OA\Property(
 * 		property="id",
 * 		type="bigint"
 * 	),
 * 	@OA\Property(
 * 		property="name",
 * 		type="string"
 * 	),
 * 	@OA\Property(
 * 		property="cpf",
 * 		type="string"
 * 	),
 * 	@OA\Property(
 * 		property="mail",
 * 		type="string"
 * 	),
 * 	@OA\Property(
 * 		property="phone",
 * 		type="string"
 * 	),
 * 	@OA\Property(
 * 		property="address",
 * 		type="string"
 * 	),
 * 	@OA\Property(
 * 		property="created_at",
 * 		type="timestamp"
 * 	),
 * 	@OA\Property(
 * 		property="updated_at",
 * 		type="timestamp"
 * 	)
 * )
 */
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
