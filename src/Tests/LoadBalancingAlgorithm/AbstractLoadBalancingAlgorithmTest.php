<?php
declare(strict_types = 1);

namespace LoadBalancer\Tests\LoadBalancingAlgorithm;

use LoadBalancer\LoadBalancingAlgorithm\AbstractLoadBalancingAlgorithm;
use LoadBalancer\Tests\Fixtures\FooHost;
use PHPUnit\Framework\TestCase;

class AbstractLoadBalancingAlgorithmTest extends TestCase
{
    /**
     * @expectedException \LoadBalancer\Exception\InvalidArgumentException
     */
    public function testFailIfHostsArrayIsEmpty()
    {
        $hosts = array();
        $this->getMockBuilder(AbstractLoadBalancingAlgorithm::class)
            ->setConstructorArgs(array($hosts))
            ->getMockForAbstractClass();
    }

    /**
     * @expectedException \LoadBalancer\Exception\InvalidArgumentException
     */
    public function testFailIfHostIsNotAnObject()
    {
        $host = 0;
        $hosts = array($host);
        $this->getMockBuilder(AbstractLoadBalancingAlgorithm::class)
            ->setConstructorArgs(array($hosts))
            ->getMockForAbstractClass();
    }

    /**
     * @expectedException \LoadBalancer\Exception\InvalidArgumentException
     */
    public function testFailIfHostIsNotHostClass()
    {
        $host = new \stdClass();
        $hosts = array($host);
        $this->getMockBuilder(AbstractLoadBalancingAlgorithm::class)
            ->setConstructorArgs(array($hosts))
            ->getMockForAbstractClass();
    }

    public function testConstructor()
    {
        $host = new FooHost();
        $hosts = array($host);
        $this->getMockBuilder(AbstractLoadBalancingAlgorithm::class)
            ->setConstructorArgs(array($hosts))
            ->getMockForAbstractClass();

        $this->assertTrue(TRUE);
    }

}
