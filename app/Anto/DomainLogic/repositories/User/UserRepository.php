<?php namespace app\Anto\DomainLogic\repositories\User;

use app\Anto\DomainLogic\interfaces\CacheInterface;
use app\Anto\domainLogic\repositories\DataAccessRepository;
use app\Models\User;

class UserRepository extends DataAccessRepository
{
    protected $cache;

    /**
     * @param CacheInterface $cache
     * @param User $user
     */
    public function __construct(CacheInterface $cache, User $user)
    {
        parent::__construct($user);

        $this->cache = $cache;
    }


    /**
     * @return mixed
     */
    public function all()
    {
        $key = md5('all');

        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        $users = $this->model->all();

        $this->cache->put($key, $users);

        return $users;
    }

    /**
     * @param $id
     * @param array $relationships
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|mixed|null|static
     */
    public function find($id, $relationships = [])
    {
        $key = md5('id.' . $id);

        if ($this->cache->has($key)) {
            return $this->cache->get($key);
        }

        if (empty($relationships)) {

            $user = $this->model->find($id);

            $this->cache->put($key, $user);

            return $user;
        }

        $user = $this->plus($relationships)->find($id);

        $this->cache->put($key, $user);

        return $user;
    }
}