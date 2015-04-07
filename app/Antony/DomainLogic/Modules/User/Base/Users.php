<?php namespace app\Antony\DomainLogic\Modules\User\Base;

use app\Antony\DomainLogic\Contracts\Database\DataActionResult;
use app\Antony\DomainLogic\Contracts\Security\UserRegistrationContract;
use app\Antony\DomainLogic\Modules\Authentication\RegisterUser;
use app\Antony\DomainLogic\Modules\DAL\Base\DataAccessLayer;
use App\Antony\DomainLogic\Modules\User\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;

class Users extends DataAccessLayer
{

    protected $objectName = 'users';

    /**
     * @var Authenticatable
     */
    private $authenticatable;


    private $registrationContract;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, Authenticatable $authenticatable, RegisterUser $registrationContract)
    {
        parent::__construct($userRepository);

        $this->authenticatable = $authenticatable;
        $this->registrationContract = $registrationContract;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|null
     */
    public function get()
    {
        return $this->repository->paginate(['county', 'roles'], null, 20);
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function create($data)
    {
        $result = $this->registrationContract->register($data)->sendRegistrationEmail()->getAuthStatus();

        // check the result returned from the register method
        switch ($result) {

            case UserRegistrationContract::ACCOUNT_CREATED: {

                $this->setResult(DataActionResult::CREATE_SUCCESS);

                return $this;
            }
            case UserRegistrationContract::ACCOUNT_NOT_CREATED: {

                $this->setResult(DataActionResult::CREATE_FAILED);

                return $this;
            }
        }
        $this->setResult(DataActionResult::CREATE_FAILED);

        return $this;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function delete($id)
    {
        $auth_id = $this->authenticatable->getAuthIdentifier();

        if (is_null($auth_id)) {

            $this->setResult(DataActionResult::ACCESS_DENIED);

            return $this;
        } else {

            // prevent the currently logged in user from deleting their account. (backend only)
            if ($auth_id === $id) {

                $this->setResult(DataActionResult::ACCESS_DENIED);

                return $this;
            }
            return parent::delete($id);
        }
    }
}