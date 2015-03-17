<?php namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{

    protected $fillable = ['name', 'alias'];


    public function users()
    {

        return $this->hasMany('App\Models\User');
    }
}