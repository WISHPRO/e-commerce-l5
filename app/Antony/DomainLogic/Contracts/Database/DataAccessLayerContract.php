<?php namespace App\Antony\DomainLogic\Contracts\Database;

interface DataAccessLayerContract
{

    /**
     * @param array $relationships
     *
     * @return mixed
     */
    public function with(array $relationships);

    /**
     * @param array $relationships
     * @param null $query
     * @param int $pages
     *
     * @return mixed
     */
    public function paginate($relationships = [], $query = null, $pages = 10);

    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $data
     *
     * @return mixed
     */
    public function add($data);

    /**
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    public function addIfNotExist($id, $data);

    /**
     * @param $id
     * @param array $relationships
     *
     * @param bool $throwExceptionIfNotFound
     *
     * @return mixed
     */
    public function find($id, $relationships = [], $throwExceptionIfNotFound = true);

    /**
     * @param $key
     * @param $operator
     * @param $value
     *
     * @return mixed
     */
    public function where($key, $operator, $value);

    /**
     * @param $data
     * @param $id
     *
     * @return mixed
     */
    public function update($data, $id);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function delete($ids = []);

    /**
     * @param array $rows
     *
     * @return mixed
     */
    public function count(array $rows);

    /**
     * @param $query
     * @param array $bindings
     *
     * @return mixed
     */
    public function raw($query, $bindings = []);

}