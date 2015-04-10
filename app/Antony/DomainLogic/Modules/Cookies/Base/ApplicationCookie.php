<?php namespace App\Antony\DomainLogic\Modules\cookies\Base;

use App\Antony\DomainLogic\contracts\cookies\CookieRepositoryInterface;
use Cookie;
use Illuminate\Cookie\CookieJar;

class ApplicationCookie implements CookieRepositoryInterface
{

    public $cookie;

    public $name = '';

    public $timespan = 0;

    public $domain = null;

    public $path = null;

    public $secure = false;

    public $http = true;

    public $data = [];

    /**
     * @param CookieJar $jar
     */
    public function __construct(CookieJar $jar)
    {
        $this->cookie = $jar;
    }

    /**
     * {@inheritdoc}
     */
    public function create($data)
    {
        return $this->cookie->make($this->name, $data, $this->timespan, $this->path, $this->domain, $this->secure, $this->http);
    }


    /**
     * {@inheritdoc}
     */
    public function destroy()
    {
        $this->cookie->forget($this->name);
    }

    /**
     * {@inheritdoc}
     */
    public function exists()
    {
        return !empty($this->fetch());
    }

    /**
     * {@inheritdoc}
     */
    public function fetch()
    {
        $this->data = Cookie::get($this->name);

        return $this;
    }

    /**
     * @param null $attribute
     *
     * @return array|null
     */
    public function get($attribute = null)
    {
        if (empty($this->data)) {

            return null;
        }

        $array = $this->fetch()->data;

        if (is_null($attribute)) {

            return $this->data;
        } else {

            if (is_array($this->data)) {

                return array_get($array, key($array))->$attribute;

            } elseif (is_object($this->data)) {

                return $this->data->$attribute;

            } else {

                return $this->data;
            }
        }

    }
}