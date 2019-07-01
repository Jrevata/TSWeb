<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Cookie;

class LoginController extends Controller
{
    
    public static function API_URL(){
        $url = "https://agile-projects-jrevata.c9users.io";
        return $url;
    }
    
    function login(Request $request){
       try{
            
            
           
            $email = $request->input('email');
            $password = $request->input('password');
            $url = self::API_URL()."/api/login";
            $data = ['email' => $email,'password' => $password];
            
            $client = new Client();
            
            $response = $client->request('POST', $url, ['form_params' => $data]);
            
            $result = json_decode($response->getBody()->getContents(), 200);
            
            if($result['user']['role'] == 0){
                return view('login', ['isAdmin'=>'No']); 
            }
            
            $cookie = cookie('token', 'Bearer '.$result['token'], 60);
            $cookie_user = cookie('user_id', $result['user']['idusers'], 60);
            
            $cookies = [$cookie, $cookie_user];
            
            return response(redirect('/home'))->cookie($cookie)->cookie($cookie_user);
        }
        catch (RequestException $e){
            $response = $e->getResponse()->getStatusCode();
            
            if($response == 401){
                
                return view('login', ['isLogin'=>'No']);
                
            }
            return $response;
        }
       
       
    }
    
    function confirmToken(Request $request){
        
       if($request->cookie('token')==''){
            return view('login', ['isLogin', 'Si']);   
       }else{
           return redirect('/home');
       }
        
       
        
    }
    
    function logout(Request $request){
        
        try{
           
            
            $url = self::API_URL()."/api/logout";
            
            $client = new Client();
            $header = array('Authorization'=> $request->cookie('token'));
            
            $response = $client->request('POST', $url, ['headers' => $header]);
            
            $result = json_decode($response->getBody()->getContents(), 200);
            
            $cookie = cookie('token', '', 60);
            $cookie_user = cookie('user_id', '', 60);
            
            
            
            return response("Logout complete")->cookie($cookie)->cookie($cookie_user);
        }
        catch (RequestException $e){
            $response = $e->getResponse()->getStatusCode();
            
           
            return $response;
            
        }
        
    }
    
    
}
