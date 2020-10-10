<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Listing
 *
 * @property string $address
 * @property int    $price
 * @property string $source
 * @property array  $media
 * @property array  $sink
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
        'sink' => 'array',
    ];

    public function setAddressAttribute(string $value)
    {
        $this->attributes['address'] = Str::lower($value);
    }

    public function scopeAddress($query, string $address)
    {
        return $query->where('address', Str::lower($address));
    }
}
