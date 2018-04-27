<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Email;
use App\Offer;
use App\Reguser;

class ActionController extends Controller{

    public function error(){
        return view('404');
    }
    public function update(){
        return view('update');
    }
}