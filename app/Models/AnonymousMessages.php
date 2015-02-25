<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class AnonymousMessages extends Model
{
    protected $fillable = [
        'message',
        'subject',
        'user_name',
        'email'
    ];
}