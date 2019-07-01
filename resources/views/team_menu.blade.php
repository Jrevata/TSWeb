<!DOCTYPE html>
<html>
    <title>Team</title>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/bootstrap.css" type="text/css" />
    <style type="text/css">
        body{
            
            padding:0;
            margin:0;
            font-family: 'Lato', sans-serif;
            
        }
        
        body::-webkit-scrollbar {
            width: 10px;
          }
        body::-webkit-scrollbar-track {
          background: #fff;
        }
        body::-webkit-scrollbar-thumb {
          background-color: #6C98FF;
        }
        
        ul{
           background-color: #fff;
        }
        .sidebar{
            background-color : #6C98FF; 
            width: 20%;
            height:100%;
            margin: 0px;
            
            position:fixed;
            
            
        }
        .contenido{
            position: absolute;
            width: 80%;
            height: 100%;
            background-color: #fff;
            margin-left: 20%;
            padding-right: 100px;
            padding-left: 100px;
            padding-top: 50px;
            
        }
        
        
        .sidebar a{
            color: #8492A6;
            text-decoration: none;
            display: block;
            padding: 10px;
            font-style: none;
        }
        
        .sidebar ul{
            list-style: none;
            background-color: #F9FAFC;
            padding : 0;
            margin-bottom : 10px;
        }
        
        .sidebar li:hover{
            
            background-color: #6C98FF;
            opacity: 0.39;
            border-left: 15px solid #eee;
            transition-property: border;
            transition-duration: 0.4s;
            
            
        }
        .sidebar a:hover{
            color: #fff;
            
        }
        
        .sidebar h2{
            margin-bottom:15px;
            margin-top: 15px;
            text-align: center;
            
        }
        
        
        .sidebar img{
            width :200px;
        }
        .image_logo{
            background-color: #F9FAFC;
            text-align: center;
        }
        
        
        .img_menu{
            width: 50px;
            height:50px;
        }
        
        
        .open_side{
            
            
        }
        .div-custom-teams{
            
            
            
           
            
        }
        .table-teams{
            text-align:center;
            height: 10px;
        }
        thead{
            
            background-color: #6C98FF;
        }
        tbody{
            
            background-color: #F9FAFC;
        }
        
        
        
        .form-edit-team{
            position: absolute;
            width: 300px;
            height: 100%;
            padding: 20px;
            padding-top: 50px;
            right: 0px;
            background-color: #F9FAFC;
            text-align: center;
        }
        
        .active{
            background-color: #6C98FF;
            opacity: 0.39;
            border-left: 15px solid #eee;
            transition-property: border;
            transition-duration: 0.4s;
        }
        .active a{
            color:#fff;
        }
        .form-new-team{
            position: fixed;
            width: 420px;
            height: 100%;
            padding: 20px;
            padding-top: 50px;
            right: 0px;
            background-color: #F9FAFC;
            text-align: center;
            
            
        }
        .multiple-options{
            position: relative;
            width: 380px;
            
        }
        
    </style>
    <body>
        
        <div class="sidebar">
            <div class="image_logo">
                <img src="/images/img_logo.png"></img>
            </div>
            <h2>TECSCRUM</h2>
            <ul>
                <li><a href="/sprints/{{$idProject}}">Sprint</a></li>
                <li class="active"><a href="/team/{{$idProject}}">Equipo</a></li>
                
            </ul>
            
            <ul>
                
                
                <li><a href="/home">Volver</a></li>
                
            </ul>
            
        </div>
        
        <div class="contenido open_side">
            <button class="btn btn-dark" id="btn-show-new-team"><i class="fas fa-plus"></i> Nuevo Miembro</button>
        
            <div class="table-responsive-xl div-custom-teams">
                <table class="table table-teams">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Acciones</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="id_edit_team" hidden>{{$user['idusers']}}</td>
                                <td class="email_edit_team" >{{$user['email']}}</td>
                                <td class="name_edit_team" >{{$user['givenName']}}</td>
                                <td class="lastname_edit_team" >{{$user['familyName']}}</td>
                                
                                <td><a class="btn btn-danger deleteButton"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                       
                        
                    </tbody>
                </table>
                
                
            </div>
            
            
            
        </div>
        <!-- Form New team !-->
        <div class="form-new-team">
            
            <form method="POST" action="/team/newMember/{{$idProject}}">
                <h3>Nuevo Miembro</h3><br>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label for="name_team">Selecciona:</label><br>
                
                
                <div class="multiple-options">
                    <select class="form-control" name="new_member" multiple>
                      @foreach($users_new as $user_new)
                          <option value="{{$user_new['idusers']}}">{{$user_new['givenName']}} ({{$user_new['email']}})</option>
                      @endforeach
                    </select>
                </div><br>
                
                <input class="btn btn-success" type="submit" value="Añadir"/>
                
                
                
            </form>
            <br>
            <button class="btn btn-danger" id="cancel_button">Cancelar</button>
        </div>
        
        
        
        
        
        <script type="text/javascript" >
            $(function(){
                $('.form-new-team').hide();
               
                
            });
            
            $('#btn-show-new-team').click(function(){
                console.log('On form new team');
                $('.form-new-team').slideToggle();
                $('#btn-show-new-team').attr('disabled', true);  
                $('.btn-edit-team').attr('disabled', true); 
            
            });
                
             
            
            
           
            $('#cancel_button').click(function(){
                
                $('.form-new-team').slideToggle();
                $('#btn-show-new-team').attr('disabled', false); 
              
                
            });
            
           
            $('.deleteButton').click(function() {
                
                var $row = $(this).closest('tr');
                var $columns = $row.find('td');
                
                
                var values = new Array();
                
                $.each($columns, function(i, item) {
                    values[i] = item.innerHTML;
                });
                
               if (confirm('¿Esta seguro de sacar a '+values[2]+' del proyecto?')) {
                    $.ajax({
                        url: '/team/deleteMember/'+values[0]+'/'+'{{$idProject}}',
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(result) {
                            location.reload();
                        }
                    });
                } 
            });
           
            
        </script>
        
     <!--   <script type="text/javascript" src="/js/open-sidebar-home.js"></script> !-->
    </body>
</html>