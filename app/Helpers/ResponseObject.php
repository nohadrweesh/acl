<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class ResponseObject
{
	public $Object;
	public $error_source = [];
	public $errorMessage = [];
	public $message = [];
	public $status_code;
}	
