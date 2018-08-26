<?php
/**
 * Created by PhpStorm.
 * User: RVM-13
 * Date: 1/23/2017
 * Time: 3:51 PM
 */

namespace App\DomainModelLayer\Schools\Repositories;


use App\DomainModelLayer\Schools\School;




interface ISchoolMainRepository
{
    public function addSchool(School $school);
    public function getAllSchools();
    public function beginDatabaseTransaction();
    public function commitDatabaseTransaction();
    public function rollBackDatabaseTransaction();
   

}