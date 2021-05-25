<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\CheckTestBehavior;
use Cake\ORM\Table;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\CheckTestBehavior Test Case
 */
class CheckTestBehaviorTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Behavior\CheckTestBehavior
     */
    protected $CheckTest;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $table = new Table();
        $this->CheckTest = new CheckTestBehavior($table);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->CheckTest);

        parent::tearDown();
    }
}
