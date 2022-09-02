<?php
namespace Icube\Training\Api\Data;

interface TraineeInterface
{

    /**
     * @return string|null
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);



    /**
     * @return string|null
     */
    public function getDivision();

    /**
     * @param string $name
     * @return $this
     */
    public function setDivision($name);

}
