<?php

namespace App\ApplicationLayer\Schools\Interfaces;
use App\ApplicationLayer\Schools\Dtos\SchoolDto;
use Illuminate\Http\Request;



interface ISchoolMainService
{
 
    public function AddSchool(SchoolDto $schoolDto);
    public function getAllSchools();    
    

}
