<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\File
 *
 * @property int $id
 * @property string $mime_type
 * @property string $original_name
 * @property string $original_extension
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read string $url
 * @method static Builder|File newModelQuery()
 * @method static Builder|File newQuery()
 * @method static Builder|File query()
 * @method static Builder|File whereCreatedAt($value)
 * @method static Builder|File whereId($value)
 * @method static Builder|File whereMimeType($value)
 * @method static Builder|File whereOriginalExtension($value)
 * @method static Builder|File whereOriginalName($value)
 * @method static Builder|File wherePath($value)
 * @method static Builder|File whereUpdatedAt($value)
 * @mixin Eloquent
 */
class File extends Model
{
    use HasFactory;

    const DEFAULT_URL = '';

    protected $fillable = [
        'mime_type', 'original_name', 'original_extension', 'path'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function url(): Attribute
    {
        return Attribute::make(
            get: function() {
                if (Storage::exists($this->path))
                    return asset('storage/' . $this->path);

                return self::DEFAULT_URL;
            }
        );
    }

    public function getAbsolutePath() : string
    {
        return Storage::disk()->path($this->path);
    }
}
