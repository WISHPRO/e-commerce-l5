<?php namespace app\Antony\DomainLogic\Contracts\Security;

interface AuthStatus {

    const SUCCESS = 'auth.success';

    const NOT_ACTIVATED = 'account.not.activated';

    const FAILED = 'auth.invalid';

}