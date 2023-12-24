<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class QrCodesModel extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'qr_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'type',
        'is_static',
        'name',
        'data',
        'visits'
    ];
}
