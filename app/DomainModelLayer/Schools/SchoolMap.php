<?php

namespace App\DomainModelLayer\Schools;

use Analogue\ORM\EntityMap;


class SchoolMap extends EntityMap {

    protected $table = 'school';

    public $timestamps = true;
    public $softDeletes = true;
    protected $deletedAtColumn = "school.deleted_at";

   /* public function account(School $school)
    {
        return $this->belongsTo($school, Account::class, 'account_id', 'id');
    }

    public function country(School $school)
    {
        return $this->belongsTo($school, Country::class, 'country_id', 'id');
    }
    public function grades(School $school)
    {
        return $this->hasMany($school, Grade::class, 'school_id', 'id');
    }

    public function classrooms(School $school)
    {
        return $this->hasMany($school, Classroom::class, 'school_id','id');
    }*/

}