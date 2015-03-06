<?php
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = require_once './vendor/autoload.php';
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$reader = new AnnotationReader();

$refMethod = new \ReflectionMethod('Example\SampleClass', 'someMethod');
$annotations = $reader->getMethodAnnotations($refMethod);

foreach ($annotations as $annotation) {
    var_dump($annotation);
}
