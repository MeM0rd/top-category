<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\House
 *
 * @property int $category_id
 * @property string $date
 * @property int $position
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCategoryId($value)
 * @method static Builder|Category whereDate($value)
 * @method static Builder|Category wherePosition($value)
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'date',
        'position'
    ];

    public $timestamps = false;
}
