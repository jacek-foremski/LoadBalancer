<?php
declare(strict_types = 1);

namespace LoadBalancer\Tests\LoadBalancingAlgorithm;

use LoadBalancer\Host\HostInterface;
use LoadBalancer\LoadBalancingAlgorithm\LowLoad;
use PHPUnit\Framework\TestCase;

class LowLoadTest extends TestCase
{
    /**
     * @var HostInterface
     */
    private $host1;

    /**
     * @var HostInterface
     */
    private $host2;

    /**
     * @var HostInterface
     */
    private $host3;

    /**
     * @var HostInterface
     */
    private $host4;

    public function testNextHostForOneHost()
    {
        $hosts = array($this->host1);
        $lowLoad = new LowLoad($hosts);

        $this->assertSame($this->host1, $lowLoad->nextHost());
        $this->assertSame($this->host1, $lowLoad->nextHost());
    }

    public function testNextHostForSeveralHosts()
    {
        $hosts = array($this->host1, $this->host2);
        $lowLoad = new LowLoad($hosts);

        $this->assertSame($this->host2, $lowLoad->nextHost());
        $this->assertSame($this->host2, $lowLoad->nextHost());
    }

    public function testNextHostForSeveralHostsWithLoadUnderTreshold()
    {
        $hosts = array($this->host2, $this->host3);
        $lowLoad = new LowLoad($hosts);

        $this->assertSame($this->host2, $lowLoad->nextHost());
    }

    public function testNextHostForSeveralHostsWithLoadAboveTreshold()
    {
        $hosts = array($this->host1, $this->host4);
        $lowLoad = new LowLoad($hosts);

        $this->assertSame($this->host4, $lowLoad->nextHost());
    }

    public function testHostsWithoutCorrectIndices()
    {
        $hosts = array(10 => $this->host1, 'asdfghjkl' => $this->host2);
        $lowLoad = new LowLoad($hosts);

        $this->assertSame($this->host2, $lowLoad->nextHost());
    }

    protected function setUp()
    {
        $this->host1 = $this->getMockBuilder(HostInterface::class)->getMock();
        $this->host1->method('getLoad')->willReturn(0.8);
        $this->host2 = $this->getMockBuilder(HostInterface::class)->getMock();
        $this->host2->method('getLoad')->willReturn(0.2);
        $this->host3 = $this->getMockBuilder(HostInterface::class)->getMock();
        $this->host3->method('getLoad')->willReturn(0.75);
        $this->host4 = $this->getMockBuilder(HostInterface::class)->getMock();
        $this->host4->method('getLoad')->willReturn(0.76);
    }
}
