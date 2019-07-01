<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Symfony\Component\HttpFoundation\Cookie;


class ProjectController extends Controller
{
    
    function index(Request $request){
        
        try{
            if($request->cookie('token')==''){
                return redirect('/login');
            }
            
            $url = LoginController::API_URL().'/api/projects/getAll';
            $header = array('Authorization'=> $request->cookie('token'));
            
            $client = new Client();
            
            $response = $client->request('GET',$url, ['headers'=>$header]);
            
            $projects = json_decode($response->getBody()->getContents(), 200);
            
            $projects = array_reverse($projects);
            
            //$cookie = ProjectController::saveCookie('token1', 'hola 3', 60);
            
            //$cookie = cookie('token', '', 60);
            //return time()+60*60*24*365;
            //return $request->cookie('token').'  '.$request->cookie('user_id');
            
            
            
            //return response(redirect('/login'))->cookie($cookie);
            
            return view('home', ['projects'=>$projects]);
            
        }
        catch (RequestException $e){
            
            $response = $e->getResponse()->getStatusCode();
            
            return $e;
        }
        
    }
    
    function create(Request $request){
        
        try{
        
            $url = LoginController::API_URL().'/api/projects/store';
            $header = array('Authorization' => $request->cookie('token'));
            $client = new Client();
            
            $project_name = $request->input('name_project');
            $date_start = $request->input('date_start');
            $date_end = $request->input('date_end');
            
            $body = array('project_name'=>$project_name, 'start_date'=> $date_start, 'end_date'=>$date_end);
            
            $response = $client->request('POST', $url, ['form_params'=>$body, 'headers'=>$header]);
        
            
            
            return redirect('/home');
            
            
        }catch(RequestException $e){
            
            return $e->getMessage();
        }
        
    }
    
    function update(Request $request){
        
        try{
        
            $idproject = $request->input('id_project_edit');
            $url = LoginController::API_URL().'/api/projects/update/'.$idproject;
            $header = array('Authorization' => $request->cookie('token'));
            $client = new Client();
            
            $project_name = $request->input('name_project_edit');
            $date_start = $request->input('start_project_edit');
            $date_end = $request->input('end_project_edit');
            
            $body = array('project_name'=>$project_name, 'start_date'=> $date_start, 'end_date'=>$date_end);
            
            $response = $client->request('POST', $url, ['form_params'=>$body, 'headers'=>$header]);
        
            return redirect('/home');
            
            
            
            
        }catch(RequestException $e){
            
            return $e->getMessage();
        }
        
        
    }
    
    
    public function saveCookie($key, $value, $time){
        
        $cookie = cookie($key, $value, $time);
            
        return response('Cookie saved')->cookie($cookie);
    }
    
    
    function deleteProject(Request $request, $idProject){
        try{
            
            $url = LoginController::API_URL().'/api/projects/destroy/'.$idProject;
            
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
