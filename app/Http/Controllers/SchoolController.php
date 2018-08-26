<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApplicationLayer\Schools\Interfaces\ISchoolMainService;

use App\School;


use App\ApplicationLayer\Schools\Dtos\SchoolDto;

use App\Helpers\Mapper;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     
     */
     
     private $schoolService;

    public function __construct(ISchoolMainService $schoolService){


       
        $this->schoolService = $schoolService;
    }
     
    public function index()
    {
        //$schools=School::all();
        // return view('schools/all_schools',compact('schools'));
         //return view('schools/all_schools');

        $result=$this->schoolService->getAllSchools(); //this is a dto 
         //dd($result);
         //return $result;
         return $this->handleResponse($result);//from dto to ResponseObject(special JSON)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('schools/new_school');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
       // $bool=$this->schoolService->AddSchool($request);
        //return ($bool)?"school inserted sucessfully ":"failed to insert ";
        //$school=School::create($request->all());
        //return "Done with ".$school;
        $schoolDto = Mapper::MapRequest(SchoolDto::class,$request->all());
         $result=$this->schoolService->AddSchool($schoolDto); //this is a dto 
         //dd($result);
         //return $result;
         return $this->handleResponse($result);
    }

    
}
