<?php
namespace Example;

class Sample
{
    public function hello($condition)
    {
        $result=3;
        $result = $this->helloInternal($result, $condition);
        $result *= 2;

        return $result;
    }

    private function helloInternal($result, $condition)
    {
        if ($condition==1) {
            return $result+3;
        }

        return $result + 4;
    }
}
