<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class UserController extends Controller
{
    function index(Request $request){
        
        try{
            if($request->cookie('token')==''){
                return redirect('/login');
            }
            
            $url = LoginController::API_URL().'/api/users/getAll';
            $header = array('Authorization'=> $request->cookie('token'));
            
            $client = new Client();
            
            $response = $client->request('GET',$url, ['headers'=>$header]);
            
            $users = json_decode($response->getBody()->getContents(), 200);
            
            $emails = array();
            
            foreach($users as $user){
                array_push($emails, $user['email']);
            }
            
            
            return view('users_menu', ['users'=>$users, 'emails'=>$emails]);
            
        }
        catch (RequestException $e){
            
            $response = $e->getResponse()->getStatusCode();
            
            return $e;
        }
    }
    
    function store(Request $request){
        
        try{
            
            
            $url = LoginController::API_URL().'/api/users/newUser';
            $header = array('Authorization'=> $request->cookie('token'));
            
            $client = new Client();
            
            $email = $request->input('email_user');
            $password = $request->input('password_user');
            $con_password = $request->input('confirm_password_user');
            $givenName = $request->input('name_user');
            $lastName = $request->input('lastname_user');
            $role = $request->admin_user;
            
            if($role=="si_admin"){
                $role = 1;
            }else{
                $role = 0;
            }
            
            $body = ['email'=> $email, 'password'=>$password, 'givenName'=>$givenName, 'familyName'=>$lastName, 'role'=>$role];
            
            $response = $client->request('POST',$url, ['form_params'=>$body, 'headers'=>$header]);
            
            $users = json_decode($response->getBody()->getContents(), 200);
            
            
            return redirect('/users');
            
        }
        catch (RequestException $e){
            
            $response = $e->getResponse()->getStatusCode();
            
            return $e;
        }
        
    }
    
    function update(Request $request){
        
        try{
            
            $id = $request->input('id_user_edit');
            
            $url = LoginController::API_URL().'/api/users/updateByAdmin/'.$id;
            $header = array('Authorization'=> $request->cookie('token'));
            
            $client = new Client();
            
            $email = $request->input('email_user_edit');
            $givenName = $request->input('name_user_edit');
            $lastName = $request->input('lastname_user_edit');
            $role = $request->admin_edit_user;
            
            
            
            if($role=="si_admin_edit"){
                $role = 1;
            }else{
                $role = 0;
            }
            
            $body = ['email'=> $email, 'givenName'=>$givenName, 'familyName'=>$lastName, 'role'=>$role];
            
            $response = $client->request('POST',$url, ['form_params'=>$body, 'headers'=>$header]);
            
            $users = json_decode($response->getBody()->getContents(), 200);
            
            
            return redirect('/users');
            
        }
        catch (RequestException $e){
            
            $response = $e->getResponse()->getStatusCode();
            
            return $e;
        }
        
    }
    
    function deleteUser(Request $request, $idUser){
        try{
            
            $url = LoginController::API_URL().'/api/users/destroy/'.$idUser;
            
            $header = array('Authorization'=> $request->cookie('token'));
            
            $client = new Client();
            
            
            $response = $client->request('DELETE',$url, ['headers'=>$header]);
            
            return;
            
        }
        catch (RequestException $e){
            
            $response = $e->getResponse()->getStatusCode();
            
            return $e;
        }
    }
    
    
}