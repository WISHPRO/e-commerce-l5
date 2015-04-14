<?php namespace App\Antony\DomainLogic\Modules\User;

use App\Antony\DomainLogic\Modules\DAL\EloquentDataAccessRepository;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

class UserRepository extends EloquentDataAccessRepository
{
    /**
     * @var Hasher
     */
    private $hasher;

    /**
     * @param User $user
     * @param Hasher $hasher
     */
    public function __construct(User $user, Hasher $hasher)
    {
        parent::__construct($user);

        $this->hasher = $hasher;
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

        $data['password'] = $this->hasher->make($data['password']);

        $user = parent::add($data);

        return $user;
    }

    /**
     * Generate a user's email confirmation code
     *
     * @return string
     */
    public function generateConfirmationCode()
    {
        return h(str_random(30));
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
     * @param $data
     * @param bool $createNew
     *
     * @return mixed|null
     */
    public function findByEmailOrCreateNew($data, $createNew = true)
    {

        $email = $data->email;

        $user = parent::getFirstBy('email', '=', $email);

        if (!$createNew) {
            if (is_null($user)) {
                return null;
            }
            return $user;

        } else {

            if (is_null($user)) {
                // attempt to create an account for the user
                return $this->createUsingAPIdata($data);
            }
            return $user;

        }

    }

    /**
     * @param $data
     *
     * @return static
     */
    private function createUsingAPIdata($data)
    {
        $userData = [
            'first_name' => $data->getName(),
            'email' => $data->getEmail(),
            'avatar' => $data->getAvatar()
        ];

        $user = parent::add($userData);

        // disable account activation
        $user->confirmed = true;

        $user->confirmation_code = null;

        $user->save();

        return $user;
    }
}