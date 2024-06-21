<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TransactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction withoutTrashed()
 * @property string|null $title
 * @property float $amount
 * @property int $author_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTitle($value)
 * @property mixed $password
 * @property-read \App\Models\User $author
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    public const AMOUNT_LENGTH_DECIMAL_NUMBER = 2;

    /**
     * @var array<int, string> $fillable
     */
    protected $fillable = [
        'title',
        'income',
        'cost',
        'amount',
        'author_id',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'income' => 'float',
            'cost' => 'float',
            'amount' => 'float',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function amount(): Attribute
    {
        return Attribute::make(
            get: static fn (float $value): float => self::priceFormatter($value),
            set: static fn (float $value): float => self::priceFormatter($value)
        );
    }

    public function cost(): Attribute
    {
        return Attribute::make(
            get: static fn (float $value): float => self::priceFormatter($value ? 0.0 - $value : $value),
        );
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    private static function priceFormatter(float $value): float
    {
        return (float) number_format($value, self::AMOUNT_LENGTH_DECIMAL_NUMBER);
    }
}
