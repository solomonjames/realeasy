<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Listing
 *
 * @property string $address
 * @property int    $price
 * @property array  $media
 * @property bool   $ignore
 */
class Listing extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'integer',
        'ignore' => 'boolean',
        'media' => 'array',
    ];

    public function scopeAddress($query, string $address)
    {
        return $query->where('address', $address);
    }
}
