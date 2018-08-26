<?php

namespace App\Infrastructure\Schools;

use App\DomainModelLayer\Schools\School;
//use App\Helpers\Mapper;

use Analogue;
use Carbon\Carbon;
use DB;


class SchoolRepository
{

    public function addSchool(School $school){
        $schoolMapper = Analogue::mapper(School::class);
        $schoolMapper->store($school);


        
        //DB::table('schools')->insert(["created_at" => Carbon::now(),"updated_at"=>Carbon::now(),'name'=>$school->getName()]);
    }
    public function getAllSchools(){
         $schoolMapper = Analogue::mapper(School::class);
         //return [{"id":null,"name":null},{"id":null,"name":null}];
         //return ['id'=>'0','name'=>'asn'];

         return $schoolMapper->all();


    }


     public function beginDatabaseTransaction()
    {
        DB::beginTransaction();
    }

    public function commitDatabaseTransaction()
    {
        DB::commit();
    }

    public function rollBackDatabaseTransaction()
    {
        DB::rollBack();
    }

  

}