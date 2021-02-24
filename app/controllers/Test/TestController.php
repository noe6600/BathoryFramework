<?php
namespace App\Controllers\Test;

use App\Controllers\BaseController;
use Database\DB;

class TestController extends BaseController{
	
	public function __construct()
	{
	}

	public function index(){
		echo "Firing test index method";
	}

}