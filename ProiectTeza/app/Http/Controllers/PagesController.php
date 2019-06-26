<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
   public function index(){
   		$title ="Bun venit la Casa Jasmin!";
   		return view('pages.index')->with('title',$title);
   }

   public function contact(){
   		$title ="Contact";
   		return view('pages.contact')->with('title',$title);
   }

   public function news(){
   		$data = array(
   			'title' => 'Stiri',
            'news' => ['Stire1','Stire2','Stire3']
         );
   		return view('pages.news')->with($data);
   }

   public function gallery(){
         $title ="Galerie";
         return view('pages.gallery')->with('title',$title);
   }

   public function rooms(){
         $title ="Camere";
         return view('pages.rooms')->with('title',$title);
   }

   public function booking(){
         $title ="Cazare";
         return view('pages.booking')->with('title',$title);
   }
}
