<?php

namespace Ribrit\Mars\Http\Requests;

use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * Fonksiyonlara tabi form istekleri
     *
     * @var array
     */
    protected $call = [];

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $factory = $this->container->make(ValidationFactory::class);

        if (method_exists($this, 'validator')) {
            return $this->container->call([$this, 'validator'], compact('factory'));
        }

        return $factory->make(
            $this->callSet(), $this->container->call([$this, 'rules']), $this->messages(), $this->attributes()
        );
    }

    /**
     * Çağrılar için fonksiyonları yükle
     *
     * @return array
     */
    protected function callSet()
    {
        foreach ($this->call as $name => $value) {
            foreach (explode('|',$value) as $function) {
                $this->offsetSet($name, call_user_func($function, $this->get($name)));
            }
        }

        return $this->all();
    }

    /**
     * Rota yetkilerine bağlı olarak kullanıcının ilgi isteği yapmaya yetkisi olup olmadığını kontrol eder
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
