<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class View extends Model
{
    protected $table = 'views';
    protected $fillable = ['apartment_id','view_token_ip'];

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}
