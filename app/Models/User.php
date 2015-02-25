<?php namespace app\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'county',
        'home_address',
        'town',
        'employee_id',
        'password_confirmation',
        'photo'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token' ];

    private $deleteMyself = false;

    /**
     * @return string
     */
    public function getUserName()
    {
        return beautify( $this->first_name . " " . $this->last_name );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany( 'App\Models\Role', 'assigned_roles' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany( 'App\Models\Review' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function county()
    {
        return $this->belongsTo( 'App\Models\County' );
    }

    public function shopping_carts()
    {
        return $this->hasMany( 'App\Models\Cart' );
    }

    /**
     * @return boolean
     */
    public function isDeleteMyself()
    {
        return $this->deleteMyself;
    }

}
