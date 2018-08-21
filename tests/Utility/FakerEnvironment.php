<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: Duan
 * Date: 19/8/18
 * Time: 6:51 PM
 */

namespace Tests\Utility;

/**
 * Class FakerFactory
 * @package Tests\Unit\Utility
 *
 * @property \App\Models\User $user
 */
class FakerEnvironment
{
    public $variables;
    protected $manager;

    public function __construct()
    {
        $this->variables = [];
        $this->manager = new FakerModelManager(app());
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        if (isset($this->variables[$name])) {
            return $this->variables[$name];
        }

        $var = $this->manager->driver($name);
        if ($var !== null) {
            $this->variables[$name] = $var;
        }

        return $this->variables[$name] ?? null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->variables[$name]);
    }

    /**
     * @param string $name
     * @param array $params
     * @return \Tests\Utility\FakerEnvironment
     */
    public function make(string $name, array $params = []): self
    {
        $var = $this->manager
            ->with($params)
            ->driver($name);

        if ($var !== null) {
            $this->variables[$name] = $var;
        }

        return $this;
    }
}