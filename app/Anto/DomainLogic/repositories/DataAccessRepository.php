<?php namespace app\Anto\domainLogic\repositories;

use app\Anto\domainLogic\interfaces\DatabaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class DataAccessRepository implements DatabaseRepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param $data
     * @param $id
     *
     * @return bool|int
     */
    public function modify($data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * @param array $ids
     *
     * @return int
     */
    public function delete($ids = [])
    {
        return $this->model->destroy($ids);
    }

    /**
     * @param array $relationships
     * @param null $query
     * @param int $pages
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function paginate($relationships = [], $query = null, $pages = 10)
    {
        if (!empty($relationships)) {
            return $this->plus($relationships)->paginate($pages);
        }

        return null;
    }

    public function plus(array $relationships)
    {
        return $this->model->with($relationships);
    }

    /**
     * @param       $relation
     * @param array $relations
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function has($relation, array $relationships = [])
    {
        $entity = $this->plus($relationships);

        return $entity->has($relation)->get();
    }

    public function whereHas(array $relations)
    {
        return $this->model->whereHas($relations)->get();
    }

    /**
     * Find a single entity by key value
     *
     * @param string $key
     * @param string $value
     * @param array $relationships
     */
    public function getFirstBy($key, $operator = null, $value, array $relationships)
    {
        return $this->plus($relationships)->where($key, $operator, $value)->get()->first();
    }

    /**
     * Find many entities by key value
     *
     * @param string $key
     * @param string $value
     * @param array $relationships
     */
    public function getManyBy($key, $operator = null, $value, array $relationships = [])
    {
        if (empty($relationships)) {
            return $this->model->where($key, $operator, $value)->get();
        }
        return $this->plus($relationships)->where($key, $operator, $value)->get();
    }

    public function addIfNotExist($id, $data)
    {
        if ($this->find($id) == null) {
            return $this->add($data);
        }

        return $this->model;
    }

    /**
     * @param $id
     * @param array $relationships
     *
     * @return Model|\Illuminate\Support\Collection|null|static
     */
    public function find($id, $relationships = [])
    {
        if (empty($relationships)) {
            return $this->model->find($id);
        }

        return $this->plus($relationships)->find($id);
    }

    /**
     * @param $data
     *
     * @return static
     */
    public function add($data)
    {
        return $this->model->create($data);
    }

    public function where($key, $operator, $value)
    {
        return $this->model->where($key, $operator, $value)->get();
    }

    /**
     * @param $query
     * @param array $bindings
     */
    public function raw($query, $bindings = [])
    {

    }
}