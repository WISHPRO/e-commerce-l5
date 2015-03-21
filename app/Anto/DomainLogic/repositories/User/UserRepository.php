<?php namespace app\Anto\DomainLogic\repositories\User;

use app\Anto\domainLogic\repositories\EloquentDataAccessRepository;
use app\Models\User;

class UserRepository extends EloquentDataAccessRepository
{
    /**
     * @param User $user
     *
     * @internal param CacheInterface $cache
     */
    public function __construct(User $user)
    {
        parent::__construct($user);

    }

    /**
     * @param $data
     *
     * @return static
     */
    public function add($data)
    {
        return parent::add($data);
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
        return str_random(40);
    }
}