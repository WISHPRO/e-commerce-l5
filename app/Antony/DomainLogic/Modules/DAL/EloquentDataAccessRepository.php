<?php namespace App\Antony\DomainLogic\Modules\DAL;

use App\Antony\DomainLogic\Contracts\Database\DataAccessLayerContract;
use Closure;
use Eloquent;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentDataAccessRepository implements DataAccessLayerContract
{

    /**
     * An Eloquent model maps to a table in the database
     *
     * @var Eloquent
     */
    protected $model;

    /**
     * @param Eloquent $model
     */
    public function __construct(Eloquent $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all attributes in a table
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Updates a table
     *
     * @param $data
     * @param $id
     *
     * @return bool|int
     */
    public function update($data, $id)
    {
        return $this->find($id)->update($data);
    }

    /**
     * find a model
     *
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
     * Retrieve a model, with its relationships
     *
     * @param array $relationships
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function with(array $relationships)
    {
        return $this->model->with($relationships);
    }

    /**
     * Deletes an id or id's from a table
     *
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
     * Retrieve paginated data from a table
     *
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
     * Retrieve a model, and relationships if they are present
     *
     * @param $relations
     * @param bool $paginate
     * @param int $pages
     *
     * @return mixed
     */
    public function has($relations, $paginate = false, $pages = 10)
    {
        if ($paginate) {
            return $this->model->has($relations)->paginate($pages);
        }
        return $this->model->has($relations)->get();
    }

    /**
     * Retrieve a model, and its relationships only if they are present
     *
     * @param array $relations
     *
     * @param callable $func
     *
     * @return mixed
     */
    public function whereHas($relations, Closure $func)
    {
        return $this->model->whereHas($relations, $func)->get();
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
            return $this->where($key, $operator, $value)->first();
        }
        return $this->with($relationships)->where($key, $operator, $value)->get()->first();
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
            return $this->where($key, $operator, $value);
        }
        return $this->with($relationships)->where($key, $operator, $value)->get();
    }

    /**
     * Add data, if it does not exist in the db
     *
     * @param $id
     * @param $data
     *
     * @return EloquentDataAccessRepository|Model
     */
    public function addIfNotExist($id, $data)
    {
        // check the id
        if (empty($id)) {
            return $this->add($data);
        }

        // attempt to find it in the db
        $existingData = $this->find($id, [], false);

        if (is_null($existingData)) {

            return $this->add($data);
        }

        return $existingData;
    }

    /**
     * Add data to the db
     *
     * @param $data
     *
     * @return static
     */
    public function add($data)
    {
        return $this->model->create($data);
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