<?php namespace App\Antony\DomainLogic\Modules\User;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\User;

class UserRepository extends EloquentDataAccessRepository
{

    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);

        $this->user = $user;
    }

    /**
     * @param $data
     *
     * @return static
     */
    public function add($data)
    {
        $this->model->creating(function ($user) {
            $user->confirmation_code = $this->generateConfirmationCode();
        });

        $user = parent::add($data);

        return $user;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return parent::all();
    }

    /**
     * @param $id
     * @param array $relationships
     *
     * @param bool $throwExceptionIfNotFound
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|mixed|null|static
     */
    public function find($id, $relationships = [], $throwExceptionIfNotFound = true)
    {
        return parent::find($id, $relationships, $throwExceptionIfNotFound);
    }

    /**
     * Generate a user's email confirmation code
     *
     * @return string
     */
    public function generateConfirmationCode()
    {
        return hash('sha256', str_random(30));
    }
}