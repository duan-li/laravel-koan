<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Duan
 * Date: 19/8/18
 * Time: 8:48 PM
 */

namespace Tests\Utility;


use App\Models\User;
use Illuminate\Support\Manager;

class FakerModelManager extends Manager
{
    protected $params = [];

    /**
     * @return \App\Models\User
     */
    public function createUserDriver(): User
    {
        return factory(\App\Models\User::class)->create($this->params);
    }

    /**
     * Get the default driver name.
     *
     * @return null
     */
    public function getDefaultDriver()
    {
        return null;
    }

    /**
     * @param array $params
     * @return \Tests\Utility\FakerModelManager
     */
    public function with(array $params): self
    {
        $this->params = $params;

        return $this;
    }
}