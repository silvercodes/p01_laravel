<?php

namespace App\Models;

use Database\Factories\SubCategoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\SubCategory
 *
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Category $category
 * @property-read Collection<int, Product> $products
 * @property-read int|null $products_count
 * @method static SubCategoryFactory factory($count = null, $state = [])
 * @method static Builder|SubCategory newModelQuery()
 * @method static Builder|SubCategory newQuery()
 * @method static Builder|SubCategory query()
 * @method static Builder|SubCategory whereCategoryId($value)
 * @method static Builder|SubCategory whereCreatedAt($value)
 * @method static Builder|SubCategory whereId($value)
 * @method static Builder|SubCategory whereTitle($value)
 * @method static Builder|SubCategory whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
