<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Listing
 *
 * @property string         $address
 * @property int            $price
 * @property string         $source
 * @property array          $media
 * @property array          $sink
 * @property bool           $ignore
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read string $address_street
 * @property-read string $link
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
        'media' => 'collection',
        'sink' => 'array',
    ];

    public function getLinkAttribute(): string
    {
        switch ($this->source) {
            case 'corcoran':
                return sprintf('https://www.corcoran.com/nyc-real-estate/for-rent/fake/fake/%s', $this->sink['listingId']);

            default:
                return '';
        }
    }

    public function getAddressAttribute(): string
    {
        return (string) Str::of($this->attributes['address'])->title();
    }

    public function getAddressStreetAttribute(): string
    {
        return (string) Str::of($this->attributes['address'])
            ->before('brooklyn')
            ->trim()
            ->beforeLast(',')
            ->title();
    }

    public function setAddressAttribute(string $value): void
    {
        $this->attributes['address'] = Str::lower($value);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutIgnored(Builder $query): Builder
    {
        return $query->where('ignore', false);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $address
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAddress(Builder $query, string $address): Builder
    {
        return $query->where('address', Str::lower($address));
    }
}
