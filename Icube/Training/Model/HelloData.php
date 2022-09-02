<?php
namespace Icube\Training\Model;

use \Icube\Training\Api\Data\HelloDataInterface;

class HelloData implements HelloDataInterface
{

    private $name;
    private $division;


    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
    }



    /**
     * @return string|null
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setDivision($name)
    {
        $this->division = $name;
    }

}
