<?php namespace App\Antony\DomainLogic\Modules\cookies;

use App\Antony\DomainLogic\contracts\cookies\CookieRepositoryInterface;
use Cookie;
use Illuminate\Cookie\CookieJar;

class ApplicationCookie implements CookieRepositoryInterface
{

    public $cookie = null;

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
     *
     */
    public function queue()
    {
        $this->cookie->queue();
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
        if ($attribute == null) {
            return $this->data;
        } else {
            return is_array($this->data) ? array_get($array, key($array))->$attribute : $this->data;
        }

    }
}