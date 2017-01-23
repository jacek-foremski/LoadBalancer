<?php
declare(strict_types = 1);

namespace LoadBalancer\Tests\LoadBalancer;

use LoadBalancer\Host\HostInterface;
use LoadBalancer\LoadBalancer;
use LoadBalancer\Request\Request;
use LoadBalancer\Tests\Fixtures\FooLoadBalancingAlgorithm;
use PHPUnit\Framework\TestCase;

class LoadBalancerTest extends TestCase
{
    /**
     * @var LoadBalancer
     */
    private $loadBalancer;

    /**
     * @var PHPUnit\Framework\MockObject\MockObject
     */
    private $host;

    /**
     * @var PHPUnit\Framework\MockObject\MockObject
     */
    private $request;

    /**
     * @var PHPUnit\Framework\MockObject\MockObject[]
     */
    private $hosts;

    /**
     * @expectedException \LoadBalancer\Exception\InvalidArgumentException
     */
    public function testFailIfClassDoesntExist()
    {
        $loadBalancingAlgorithmClass = 'LoadBalancer\Asdfghjkl';
        new LoadBalancer($this->hosts, $loadBalancingAlgorithmClass);
    }

    /**
     * @expectedException \LoadBalancer\Exception\InvalidArgumentException
     */
    public function testFailIfNotLoadBalancingAlgorithmClass()
    {
        $loadBalancingAlgorithmClass = \stdClass::class;
        new LoadBalancer($this->hosts, $loadBalancingAlgorithmClass);
    }

    public function testHandleRequest()
    {
        $this->host->expects($this->once())
            ->method('handleRequest')
            ->with($this->identicalTo($this->request));

        $this->loadBalancer->handleRequest($this->request);
    }

    protected function setUp()
    {
        $this->host = $this->getMockBuilder(HostInterface::class)->getMock();
        $this->request = $this->getMockBuilder(Request::class)->getMock();
        $this->hosts = array($this->host);
        $loadBalancingAlgorithmClass = FooLoadBalancingAlgorithm::class;
        $this->loadBalancer = new LoadBalancer($this->hosts, $loadBalancingAlgorithmClass);
    }
}
