<?php
declare(strict_types=1);

namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ComumComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ComumComponent Test Case
 */
class ComumComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Controller\Component\ComumComponent
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
        $registry = new ComponentRegistry();
        $this->Comum = new ComumComponent($registry);
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
