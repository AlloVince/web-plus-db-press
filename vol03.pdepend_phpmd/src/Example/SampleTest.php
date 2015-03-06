<?php
namespace Example;

/**
 * @SuppressWarnings(PHPMD)
 */
final class SampleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Sample
     */
     private $SUT;

     protected function setUp()
     {
         $this->SUT=new Sample();
     }

     /**
      * @test
      */
      public function 输出结果测试()
      {
          $this->assertThat($this->SUT->hello(1),
              $this->equalTo(12)
          );
          $this->assertThat($this->SUT->hello(2),
              $this->equalTo(14)
          );
      }
 }
