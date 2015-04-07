<?php namespace app\Antony\DomainLogic\Modules\DAL\Base;

use App\Antony\DomainLogic\Contracts\Database\DataAccessLayerContract;
use app\Antony\DomainLogic\Contracts\Database\DataActionResult;
use Illuminate\Http\Request;
use InvalidArgumentException;

abstract class DataAccessLayer implements DataActionResult
{

    /**
     * @var DataAccessLayerContract
     */
    protected $repository;

    /**
     * @var string
     */
    protected $result;

    /**
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

            $this->setResult(DataActionResult::CREATE_SUCCESS);

            return $this;
        } else {
            $this->setResult(DataActionResult::CREATE_FAILED);

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

            $this->setResult(DataActionResult::UPDATE_FAILED);

            return $this;
        } else {
            $this->setResult(DataActionResult::UPDATE_SUCCEEDED);

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

            $this->setResult(DataActionResult::DELETE_SUCCESS);

            return $this;
        } else {
            $this->setResult(DataActionResult::DELETE_FAILED);

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
        if (!$request instanceof Request) {
            throw new InvalidArgumentException('You need to provide a request class to this method');
        }
        if ($this->objectName === null) {
            throw new InvalidArgumentException('You need to set an object name first');
        }
        if ($this->getResult() === null) {
            throw new InvalidArgumentException('You need to perform a CRUD operation first');
        }
        switch ($this->getResult()) {

            case DataActionResult::CREATE_FAILED: {
                if ($request->ajax()) {
                    return response()->json(['message' => "An error occurred. The {$this->getObjectName()} could not be added to the database"], 422);
                } else {
                    flash()->error("An error occurred. The {$this->getObjectName()} could not be added to the database");

                    return redirect()->back()->withInput($request->all());
                }
            }
            case DataActionResult::CREATE_SUCCESS: {
                if ($request->ajax()) {
                    return response()->json(['message' => "{$this->getObjectName()} was successfully created"]);
                } else {

                    flash("{$this->getObjectName()} successfully created");

                    return redirect()->back();
                }
            }
            case DataActionResult::UPDATE_FAILED: {
                if ($request->ajax()) {
                    return response()->json(['message' => "An error occurred. The {$this->getObjectName()} was not updated"], 422);
                } else {

                    flash()->error("An error occurred. The {$this->getObjectName()} was not updated");

                    return redirect()->back()->withInput($request->all());
                }
            }
            case DataActionResult::UPDATE_SUCCEEDED: {
                if ($request->ajax()) {
                    return response()->json(['message' => "{$this->getObjectName()} was successfully updated"]);
                } else {

                    flash("{$this->getObjectName()} was successfully updated");

                    return redirect()->back();
                }
            }
            case DataActionResult::DELETE_FAILED: {
                if ($request->ajax()) {
                    return response()->json(['message' => "An error occurred. The {$this->getObjectName()} was not deleted"], 422);
                } else {

                    flash()->error("An error occurred. The {$this->getObjectName()} was not deleted");

                    return redirect()->back();
                }
            }
            case DataActionResult::DELETE_SUCCESS: {
                if ($request->ajax()) {
                    return response()->json(['message' => "{$this->getObjectName()} was successfully deleted"]);
                } else {

                    flash("{$this->getObjectName()} was successfully deleted");

                    return redirect()->back();
                }
            }
            case DataActionResult::ACCESS_DENIED: {
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
}