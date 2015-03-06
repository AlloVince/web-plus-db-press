<?php
namespace Example\Annotation;

/**
* @Annotation
* @Target({"METHOD"})
* @Attributes({
* @Attribute("name", type="string")
* })
*/
class Cat
{
    protected $name;

    public function __construct($parameters)
    {
        $this->name = $parameters['name'];
    }

    public function getName()
    {
        return $this->name;
    }
}
