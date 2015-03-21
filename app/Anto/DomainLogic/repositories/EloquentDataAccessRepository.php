<?php namespace app\Anto\domainLogic\repositories;

use app\Anto\domainLogic\contracts\DatabaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class EloquentDataAccessRepository implements DatabaseRepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     *
     * @param Model $model
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
    public function update($data, $id)
    {
        return $this->model->find($id)->update($data);
    }


    /**
     * @param array $ids
     *
     * @return bool|int
     */
    public function delete($ids = [])
    {
        if (is_array($ids) and count($ids) == 1) {
            return $this->model->destroy($ids) == 1;
        }

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
            return $this->with($relationships)->paginate($pages);
        }

        return $this->model->paginate($pages);
    }

    /**
     * @param array $relationships
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function with(array $relationships)
    {
        return $this->model->with($relationships);
    }

    /**
     * @param $relation
     * @param array $relationships
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     *
     */
    public function has($relation, array $relationships = [])
    {
        $entity = $this->with($relationships);

        return $entity->has($relation)->get();
    }

    /**
     * @param array $relations
     *
     * @param callable $func
     *
     * @param array $params
     *
     * @return mixed
     */
    public function whereHas($relations, callable $func, $params = [])
    {
        if (empty($params)) {
            return $this->model->whereHas($relations, $func)->get();
        }
        return $this->model->whereHas($relations, $func, $params)->get();
    }

    /**
     * Find a single entity by key value
     *
     * @param string $key
     * @param null $operator
     * @param string $value
     * @param array $relationships
     *
     * @return mixed|null
     */
    public function getFirstBy($key, $operator = null, $value, array $relationships = [])
    {
        if (empty($relationships)) {
            return $this->model->where($key, $operator, $value)->get()->first();
        }
        return $this->with($relationships)->where($key, $operator, $value)->get()->first();
    }

    /**
     * Find many entities by key value
     *
     * @param string $key
     * @param null $operator
     * @param string $value
     * @param array $relationships
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getManyBy($key, $operator = null, $value, array $relationships = [])
    {
        if (empty($relationships)) {
            return $this->model->where($key, $operator, $value)->get();
        }
        return $this->with($relationships)->where($key, $operator, $value)->get();
    }

    /**
     * @param $id
     * @param $data
     *
     * @return EloquentDataAccessRepository|Model
     */
    public function addIfNotExist($id, $data)
    {
        if (empty($id)) {
            return $this->add($data);
        }
        if ($this->find($id) == null) {
            return $this->add($data);
        }

        return $this->model;
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

    /**
     * @param $id
     * @param array $relationships
     *
     * @param bool $throwExceptionIfNotFound
     *
     * @return Model|\Illuminate\Support\Collection|null|static
     */
    public function find($id, $relationships = [], $throwExceptionIfNotFound = true)
    {
        if (!$throwExceptionIfNotFound) {
            if (empty($relationships)) {
                return $this->model->find($id);
            }

            return $this->with($relationships)->find($id);

        } else {

            if (empty($relationships)) {
                return $this->model->findOrFail($id);
            }

            return $this->with($relationships)->findOrFail($id);
        }

    }

    /**
     * @param $key
     * @param $operator
     * @param $value
     *
     * @return mixed
     */
    public function where($key, $operator, $value)
    {
        return $this->model->where($key, $operator, $value)->get();
    }

    /**
     * @param $query
     * @param array $bindings
     *
     * @return mixed|void
     */
    public function raw($query, $bindings = [])
    {

    }

    /**
     * @param array $rows
     *
     * @return mixed
     */
    public function count(array $rows)
    {
        // TODO: Implement count() method.
    }
}