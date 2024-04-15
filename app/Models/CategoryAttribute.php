<?php

namespace App\Models;

use App\Enums\AttributeTypeEnum;
use App\Enums\BooleanEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CategoryAttribute extends Model
{
    use HasFactory;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'is_required',
        'category_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // attributes
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => AttributeTypeEnum::class,
        'is_required' => BooleanEnum::class,
        'created_at' => 'datetime:Y-m-d (H:i a)',
        'updated_at' => 'datetime:Y-m-d (H:i a)',
    ];

    /**
     * Set up the activity logging
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }

    /**
     * Relation with category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
