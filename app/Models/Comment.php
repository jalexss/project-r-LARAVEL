<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function receta(): BelongsTo
    {
        return $this->belongsTo(Receta::class);
    }
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
