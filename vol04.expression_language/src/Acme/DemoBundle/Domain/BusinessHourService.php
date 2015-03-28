<?php
namespace Acme\DemoBundle\Domain;

class BusinessHourService
{
    public function __construct()
    {
        $this->businessHours = [];
    }

    public function add(BusinessHour $businessHour)
    {
        $this->businessHours[$businessHour->getName()]
            = $businessHour;
    }

    public function current()
    {
        $time = new \DateTime();

        foreach ($this->businessHours as $businessHour) {
            if ($businessHour->contains($time)) {
                return $businessHour->getName();
            }
        }

        return null;
    }
}