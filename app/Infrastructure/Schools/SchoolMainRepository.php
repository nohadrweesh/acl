<?php

namespace App\Infrastructure\Schools;


use App\DomainModelLayer\Schools\Repositories\ISchoolMainRepository;
use App\DomainModelLayer\Schools\School;

use Analogue;

class SchoolMainRepository implements ISchoolMainRepository
{
    public function addSchool(School $school){
        $schoolRepository = new SchoolRepository;
        return $schoolRepository->addSchool($school);
    }
    public function getAllSchools(){
        $schoolRepository = new SchoolRepository;
        return $schoolRepository->getAllSchools();
    }



    public function beginDatabaseTransaction()
    {
        $schoolRepository = new SchoolRepository;
        return $schoolRepository->beginDatabaseTransaction();
    }

    public function commitDatabaseTransaction()
    {
        $schoolRepository = new SchoolRepository;
        return $schoolRepository->commitDatabaseTransaction();
    }

    public function rollBackDatabaseTransaction()
    {
        $schoolRepository = new SchoolRepository;
        return $schoolRepository->rollBackDatabaseTransaction();
    }


}