<?php

namespace App\ApplicationLayer\Schools;

use App\DomainModelLayer\Schools\Repositories\ISchoolMainRepository;
use App\ApplicationLayer\Schools\Dtos\SchoolDto;
use App\DomainModelLayer\Schools\School;

use App\ApplicationLayer\Schools\CustomMappers\SchoolDtoMapper;
use Illuminate\Http\Request;
use App\Helpers\Mapper;

use DB;
class SchoolService
{
    //region Properties
   
    private $schoolRepository;

    //endregion

    //region Constructor
    public function __construct(ISchoolMainRepository $schoolRepository){
       
        $this->schoolRepository = $schoolRepository;

    }

    public function AddSchool(SchoolDto $schoolDto){
        $this->schoolRepository->beginDatabaseTransaction();
        
        $school = new School($schoolDto);//In domainModelLayer      
        $this->schoolRepository->AddSchool($school);
        
        $this->schoolRepository->commitDatabaseTransaction();
        //return $school;
        return SchoolDtoMapper::CustomerMapper($school);
    }

    public function getAllSchools(){

        $schools = $this->schoolRepository->getAllSchools();
        $schoolsMapped = Mapper::MapEntityCollection(SchoolDto::class, $schools);
        return $schoolsMapped;

    }

   /* public function AddSchool(Request $request){
        $this->schoolRepository->beginDatabaseTransaction();
        $school = new School($schoolDto);
        
        $this->schoolRepository->AddSchool($school);
        
        $this->schoolRepository->commitDatabaseTransaction();
        return SchoolDtoMapper::CustomerMapper($school);
    }*/


   

}