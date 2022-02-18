<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class View extends Model
{
    protected $table = 'views';

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}
