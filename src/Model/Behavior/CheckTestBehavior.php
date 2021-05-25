<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;

/**
 * CheckTest behavior
 */
class CheckTestBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'implementedMethods' => [
            'checkTest' => 'checkTest',
        ],
    ];

    private $model;

    public function __construct(&$model)
    {
        $this->model = &$model;
    }

    public function checkTest() {
        $config_name = $this->model->getConnection()->config()['name'];

        if (($config_name === 'test') || (strpos($config_name, 'test_') !== false)) {
            return true;
        }

        return false;
    }
}
