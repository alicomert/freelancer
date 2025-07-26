<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserEducation extends Model
{
    protected $table = 'user_educations';
    
    protected $fillable = [
        'user_id',
        'education_name',
        'institution',
        'start_year',
        'end_year',
        'document_link',
        'link_access',
        'sort_order'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
