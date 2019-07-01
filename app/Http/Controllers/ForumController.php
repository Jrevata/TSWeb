<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

use Symfony\Component\HttpFoundation\Cookie;

class ForumController extends Controller
{
    
    function index(Request $request, $idProject, $idSprint){
        
        try{
            if($request->cookie('token')==''){
                return redirect('/login');
            }
            
            $url = LoginController::API_URL().'/api/comments/getCommentsBySprint/'.$idSprint;
            $header = array('Authorization'=> $request->cookie('token'));
            
            $client = new Client();
            
            $response = $client->request('GET',$url, ['headers'=>$header]);
            
            $comments = json_decode($response->getBody()->getContents(), 200);
            $reverse_comments = array_reverse($comments);

            $urlImage = LoginController::API_URL().'/images/';
            
            return view('forum_menu', ['comments'=> $reverse_comments, 'idProject'=>$idProject, 'idSprint'=>$idSprint, 'urlImage'=>$urlImage]);
            
        }
        catch (RequestException $e){
            
            $response = $e->getResponse()->getStatusCode();
            
            return $e;
        }
        
    }
    
    function store(Request $request){
        
        try{
            
            $url = LoginController::API_URL().'/api/comments/store';
            $header = array('Authorization'=> $request->cookie('token'));
            
            $idUser = 1;
            $message = $request->message;
            $idSprint = $request->sprints_idsprints;
             
            $body = ['users_idusers'=> $idUser, 'sprints_idsprints'=>$idSprint, 'message'=>$message];
            
            $client = new Client();
            
            $response = $client->request('POST',$url, ['form_params'=>$body, 'headers'=>$header]);
            
            $comment = json_decode($response->getBody()->getContents(), 200);
           

            
            
            return $comment;
            
        }
        catch (RequestException $e){
            
            $response = $e->getResponse()->getStatusCode();
            
            return $e;
        }
        
        
        
    }
    
    
}
