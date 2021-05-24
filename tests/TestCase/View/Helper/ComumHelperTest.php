<?php
declare(strict_types=1);

namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ComumHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ComumHelper Test Case
 */
class ComumHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\View\Helper\ComumHelper
     */
    protected $Comum;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Comum = new ComumHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Comum);

        parent::tearDown();
    }
}
