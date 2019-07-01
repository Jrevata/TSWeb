<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class MoodTodayController extends Controller
{
    function index(Request $request, $idProject, $idSprint){
        
        try{
            
            if($request->cookie('token')==''){
                return redirect('/login');
            }
            
            $url = LoginController::API_URL().'/api/projects/getUsersByProject/'.$idProject;
            $header = array('Authorization'=> $request->cookie('token'));
            
            $client = new Client();
            
            $response = $client->request('GET',$url, ['headers'=>$header]);
            
            $users = json_decode($response->getBody()->getContents(), 200);
            
            
            return view('moodtoday_menu', ['users'=>$users, 'idProject'=>$idProject, 'idSprint'=>$idSprint]);
            
        }
        catch (RequestException $e){
            
            $response = $e->getResponse()->getStatusCode();
            
            return $e;
        }
        
        
    }
    
    function getMoodTodays(Request $request, $idSprint, $idUser){
        try{
            
            $url = LoginController::API_URL().'/api/moodtoday/listMoodTodays/'.$idSprint.'/'.$idUser;
            $header = array('Authorization'=> $request->cookie('token'));
            
            $client = new Client();
            
            $response = $client->request('GET',$url, ['headers'=>$header]);
            
            $moodTodays = json_decode($response->getBody()->getContents(), 200);
            
            $reverse = array_reverse($moodTodays);
            
            return $reverse;
            
        }
        catch (RequestException $e){
            
            return $e;
            
        }
    }
}
