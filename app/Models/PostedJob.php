<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PostedJob
 *
 * @package App\Models
 */
class PostedJob extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'posted_job_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'job_id',
        'job_title',
        'created_at',
        'updated_at',
    ];
}
