<?php namespace app\Antony\DomainLogic\Modules\DAL\Base;

use App\Antony\DomainLogic\Contracts\Database\DataAccessLayerContract;
use app\Antony\DomainLogic\Contracts\Database\DataActionResult;
use app\Antony\DomainLogic\Contracts\Redirects\AppRedirector;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use InvalidArgumentException;

abstract class DataAccessLayer implements DataActionResult, AppRedirector
{

    /**
     * The repository
     *
     * @var DataAccessLayerContract
     */
    protected $repository;

    /**
     * status results of a CRUD operation. Not really the data
     *
     * @var string
     */
    protected $result;

    /**
     * Object name that will be displayed in the redirect msg
     *
     * @var string
     */
    protected $objectName;

    /**
     * @param DataAccessLayerContract $layer
     */
    public function __construct(DataAccessLayerContract $layer)
    {

        $this->repository = $layer;
    }

    /**
     * Provides a commonly used implementation for a creation operation
     *
     * @param $data
     *
     * @return $this
     */
    public function create($data)
    {
        if ($this->repository->add($data) !== null) {

            $this->setResult(static::CREATE_SUCCESS);

            return $this;
        } else {
            $this->setResult(static::CREATE_FAILED);

            return $this;
        }

    }

    /**
     * Ok, this presents a commonly used implementation of a SELECT procedure
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    abstract public function get();

    /**
     * Provides a commonly used implementation for an edit operation
     *
     * @param $id
     * @param $data
     *
     * @return $this
     */
    public function edit($id, $data)
    {

        if (!$this->repository->update($data, $id)) {

            $this->setResult(static::UPDATE_FAILED);

            return $this;
        } else {
            $this->setResult(static::UPDATE_SUCCEEDED);

            return $this;
        }

    }

    /**
     * Provides a commonly used implementation for a find by ID operation
     *
     * @param $id
     *
     * @return mixed
     */
    public function retrieve($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Provides a commonly used implementation for a delete operation
     *
     * @param $id
     *
     * @return $this
     */
    public function delete($id)
    {
        if ($this->repository->delete([$id])) {

            $this->setResult(static::DELETE_SUCCESS);

            return $this;
        } else {
            $this->setResult(static::DELETE_FAILED);

            return $this;
        }

    }

    /**
     * Handles redirects after a crud operation has been completed
     *
     * @param $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handleRedirect($request)
    {
        $this->validate_args($request);

        switch ($this->getResult()) {

            case static::CREATE_FAILED: {
                if ($request->ajax()) {
                    return response()->json(['message' => "An error occurred. The {$this->getObjectName()} could not be added to the database"], 422);
                } else {
                    flash()->error("An error occurred. The {$this->getObjectName()} could not be added to the database");

                    return redirect()->back()->withInput($request->all());
                }
            }
            case static::CREATE_SUCCESS: {
                if ($request->ajax()) {
                    return response()->json(['message' => "{$this->getObjectName()} was successfully created"]);
                } else {

                    flash("{$this->getObjectName()} successfully created");

                    return redirect()->back();
                }
            }
            case static::UPDATE_FAILED: {
                if ($request->ajax()) {
                    return response()->json(['message' => "An error occurred. The {$this->getObjectName()} was not updated"], 422);
                } else {

                    flash()->error("An error occurred. The {$this->getObjectName()} was not updated");

                    return redirect()->back()->withInput($request->all());
                }
            }
            case static::UPDATE_SUCCEEDED: {
                if ($request->ajax()) {
                    return response()->json(['message' => "{$this->getObjectName()} was successfully updated"]);
                } else {

                    flash("{$this->getObjectName()} was successfully updated");

                    return redirect()->back();
                }
            }
            case static::DELETE_FAILED: {
                if ($request->ajax()) {
                    return response()->json(['message' => "An error occurred. The {$this->getObjectName()} was not deleted"], 422);
                } else {

                    flash()->error("An error occurred. The {$this->getObjectName()} was not deleted");

                    return redirect()->back();
                }
            }
            case static::DELETE_SUCCESS: {
                if ($request->ajax()) {
                    return response()->json(['message' => "{$this->getObjectName()} was successfully deleted"]);
                } else {

                    flash("{$this->getObjectName()} was successfully deleted");

                    return redirect()->back();
                }
            }
            case static::ACCESS_DENIED: {
                if ($request->ajax()) {
                    return response()->json(['message' => "You are not allowed to perform that action"], 401);
                } else {

                    flash()->error("You are not allowed to perform that action");

                    return redirect()->back();
                }
            }
        }

        return redirect()->back();
    }

    /**
     * @param $request
     */
    protected function validate_args($request)
    {
        if (!$request instanceof Request) {
            throw new InvalidArgumentException('You need to provide a request class to this method');
        }
        if (is_null($this->objectName)) {
            throw new InvalidArgumentException('You need to set an object name first');
        }
        if (is_null($this->getResult())) {
            throw new InvalidArgumentException('You need to perform a CRUD operation first');
        }
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    protected function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * Retrieves the name of the set object
     *
     * @return mixed
     */
    public function getObjectName()
    {
        return str_singular($this->objectName);
    }

    /**
     * Sets the name of the model class that will be used in the redirect messages
     *
     * @param $name
     */
    public function setObjectName($name)
    {
        $this->objectName = str_singular($name);
    }

    /**
     * Paginates a collection
     *
     * a little help from http://laravelsnippets.com/snippets/custom-data-pagination
     *
     * @param Collection $data
     * @param $perPage
     * @param null $page
     * @param Request $request
     *
     * @return LengthAwarePaginator
     */
    public function paginateCollection(Collection $data, $perPage, $page = null, Request $request)
    {
        $pg = $request->get('page');

        $page = $page ? (int)$page * 1 : (isset($pg) ? (int)$request->get('page') * 1 : 1);
        $offset = ($page * $perPage) - $perPage;
        // 'path' => Paginator::resolveCurrentPath(),

        return new LengthAwarePaginator($data->splice($offset, $perPage), $data->count(), $perPage, Paginator::resolveCurrentPage(1), ['path' => Paginator::resolveCurrentPath(),]);
    }
}