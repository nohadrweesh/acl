<?php
/**
 * Created by PhpStorm.
 * User: RVM-13
 * Date: 1/9/2017
 * Time: 5:10 PM
 */

namespace App\ApplicationLayer\Schools\CustomMappers;


use App\ApplicationLayer\Schools\Dtos\SchoolDto;
use App\DomainModelLayer\Schools\School;

class SchoolDtoMapper
{

    public static function RequestMapper($request){
        $schoolDto = new SchoolDto();
        $schoolDto->name = $request['name'];
        
        return $schoolDto;
    }

    

    public static function CustomerMapper(School $school){
        $schoolDto = new SchoolDto();
        
        $schoolDto->name = $school->getName();
        $schoolDto->id = $school->getId();
        
        return $schoolDto;
    }
}
