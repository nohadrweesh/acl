<?php
namespace App\DomainModelLayer\Schools;

use App\ApplicationLayer\Schools\Dtos\SchoolDto;

use App\DomainModelLayer\Schools\Country;
use Analogue\ORM\Entity;
use Analogue\ORM\EntityCollection;


class School extends Entity
{
    //region Getters & Setters

    public function __construct(SchoolDto $schoolDto)
    {
        
        $this->name = $schoolDto->name;
        
        
    }

   

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

   
}
