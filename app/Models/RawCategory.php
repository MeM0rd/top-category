<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RawCategory
 *
 * @property int $category
 * @property int $sub_category
 * @property string $date
 * @property int $position
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCategory($value)
 * @method static Builder|Category whereSubCategory($value)
 * @method static Builder|Category whereDate($value)
 * @method static Builder|Category wherePosition($value)
 */
class RawCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'sub_category',
        'date',
        'position',
    ];

    public $timestamps = false;
}
