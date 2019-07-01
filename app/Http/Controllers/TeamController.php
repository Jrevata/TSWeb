<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class TeamController extends Controller
{
    
    
    function index(Request $request, $idProject){
        
        try{
            
            if($request->cookie('token')==''){
                return redirect('/login');
            }
            
            $url = LoginController::API_URL().'/api/projects/getUsersByProject/'.$idProject;
            $url2 = LoginController::API_URL().'/api/users/getAll';
            
            
            
            $header = array('Authorization'=> $request->cookie('token'));
            
            $client = new Client();
            $client2 = new Client();
            
            $response = $client->request('GET',$url, ['headers'=>$header]);
            $response2 = $client2->request('GET', $url2, ['headers'=>$header]);
            
            $users = json_decode($response->getBody()->getContents(), 200);
            $allUsers = json_decode($response2->getBody()->getContents(), 200);
            $array_user = array();
            foreach($allUsers as $user){
                
                $bool = true;
                
                foreach($users as $user1){
                    if($user1['idusers'] == $user['idusers']){
                        $bool = false;
                        break;
                    }
                }
                
                if($bool == true){
                    array_push($array_user, $user);
                }
            }
            
            
            return view('team_menu', ['users'=>$users, 'idProject'=>$idProject, 'users_new'=>$array_user]);
            
        }
        catch (RequestException $e){
            
            $response = $e->getResponse()->getStatusCode();
            
            return $e;
        }
        
    }
    
    function newMember(Request $request, $idProject){
        
        try{
        
            $url = LoginController::API_URL().'/api/team/addMember';
            $header = array('Authorization'=> $request->cookie('token'));
            $client = new Client();
            $body = array('users_idusers'=>$request->new_member , 'projects_idprojects'=> $idProject);
            $response = $client->request('POST',$url, [ 'form_params'=>$body, 'headers'=>$header]);
            $users = json_decode($response->getBody()->getContents(), 200);
            
            
    
            
            
            return redirect('/team/'.$idProject);
            
        }
        catch (RequestException $e){
            
            $response = $e->getResponse()->getStatusCode();
            
            return $e;
        }
        
        
    }
    
    function deleteMember(Request $request, $idUser, $idProject){
        try{
            
            $url = LoginController::API_URL().'/api/team/deleteMember/'.$idUser.'/'.$idProject;
            
            
            
            
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
