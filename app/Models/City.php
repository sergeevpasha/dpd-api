<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static updateOrCreate(array $array, array $array)
 * @method static where(string $field, string $symbol, string $queryString)
 * @method static whereRaw(string $string)
 */
class City extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function terminals(): HasMany
    {
        return $this->hasMany(Terminal::class);
    }
}
