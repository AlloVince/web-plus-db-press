<?php
namespace Acme\DemoBundle\Domain;

use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class BusinessHour
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var Expression
     */
    private $expression;
    /**
     * @var ExpressionLanguage
     */
    private $expressionLanguage;

    public function __construct(
        $name,
        Expression $expression
    ) {
        $this->name = $name;
        $this->expression = $expression;
        $this->expressionLanguage = new ExpressionLanguage();
    }

    public function contains(\DateTimeInterface $time)
    {
        return $this->expressionLanguage->evaluate(
            $this->expression,
            ['time' => $time->format('H:i')]
        );
    }

    public function getName()
    {
        return $this->name;
    }
}