<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class SprintController extends Controller
{
    
    function index(Request $request, $idProject){
        
        try{
            
            if($request->cookie('token')==''){
                return redirect('/login');
            }
            
            $url = LoginController::API_URL().'/api/sprints/getAllbyProject/'.$idProject;
            $header = array('Authorization'=> $request->cookie('token'));
            
            $client = new Client();
            
            $response = $client->request('GET',$url, ['headers'=>$header]);
            
            $sprints = json_decode($response->getBody()->getContents(), 200);
            
            
            return view('sprint_menu', ['sprints'=>$sprints, 'idProject'=>$idProject]);
            
        }
        catch (RequestException $e){
            
            $response = $e->getResponse()->getStatusCode();
            
            return $e;
        }
        
    }
    
    function create(Request $request, $idProject){
        
        try{
        
            $url = LoginController::API_URL().'/api/sprints/newSprint';
            $header = array('Authorization' => $request->cookie('token'));
            $client = new Client();
            
            
            $sprint_name = $request->input('name_sprint');
            $sprint_goal = $request->input('goal_sprint');
            $date_start = $request->input('date_start');
            $date_end  = $request->input('date_end');
            
            $body = array('projects_idprojects'=>$idProject, 'sprint_name'=> $sprint_name, 'sprint_goal'=>$sprint_goal, 'start_date'=>$date_start, 'end_date'=>$date_end);
            
            $response = $client->request('POST', $url, ['form_params'=>$body, 'headers'=>$header]);
        
            return redirect('/sprints/'.$idProject);
            
            
            
            
        }catch(RequestException $e){
            
            return $e->getMessage();
        }
        
    }
    
    
    function update(Request $request, $idProject){
        
        try{
            $idSprint = $request->input('id_sprint_edit');
            
            $url = LoginController::API_URL().'/api/sprints/editSprint/'.$idSprint;
            $header = array('Authorization' => $request->cookie('token'));
            $client = new Client();
            
            
            
            $sprint_name = $request->input('name_sprint_edit');
            $sprint_goal = $request->input('goal_sprint_edit');
            $date_start = $request->input('start_sprint_edit');
            $date_end  = $request->input('end_sprint_edit');
            
            $body = array('sprint_name'=> $sprint_name, 'sprint_goal'=>$sprint_goal, 'start_date'=>$date_start, 'end_date'=>$date_end);
            
            $response = $client->request('POST', $url, ['form_params'=>$body, 'headers'=>$header]);
        
            return redirect('/sprints/'.$idProject);
            
            
        }catch(RequestException $e){
            
            return $e->getMessage();
        }
        
    }
    
    function destroy(Request $request, $idSprint){
        try{
            
            $url = LoginController::API_URL().'/api/sprints/destroy/'.$idSprint;
            
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
