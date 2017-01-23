<?php
declare(strict_types = 1);

namespace LoadBalancer\Exception;

class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface
{
    public function __construct($expectedType)
    {
        parent::__construct(sprintf('Expected argument of type "%s"', $expectedType));
    }
}