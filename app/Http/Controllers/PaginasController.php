<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginasController extends Controller
{
    //


	public function vista(){

		return view('welcome');
	}
	
	public function quienesSomos(){

		return view('quienesSomos');
	}
	
	
	public function dondeEstamos(){

		return view('dondeEstamos');
	}
	

	public function foro(){

		return view('foro');
	}

	public function contacto(){

		return view('contacto');
	}

	public function mostrar(){
		$alumnos=["ana","pepe","luis"];
		//$alumnos=[];
		return view('mostrar',compact("alumnos"));
	}







}
