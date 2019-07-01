<!DOCTYPE html>
<html>
    <title>Sprints</title>
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
            position:absolute;
            width: 80%;
            height: 100%;
            background-color: #fff;
            margin-left: 20%;
            padding-top:50px;
            padding-right: 100px;
            padding-left: 100px;
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
        .div-custom-sprints{
            
            
            
           
            
        }
        .table-sprints{
            text-align:center;
            
        }
        thead{
            
            background-color: #6C98FF;
        }
        tbody{
            
            background-color: #F9FAFC;
        }
        
        .form-new-sprint{
            position: fixed;
            width: 300px;
            height: 100%;
            padding: 20px;
            padding-top: 50px;
            right: 0px;
            background-color: #F9FAFC;
            text-align: center;
            
            
        }
        
        .form-edit-sprint{
            position: fixed;
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
        
    </style>
    <body>
        
        <div class="sidebar">
            <div class="image_logo">
                <img src="/images/img_logo.png"></img>
            </div>
            <h2>TECSCRUM</h2>
            <ul>
                <li class="active"><a href="/sprints/{{$idProject}}">Sprints</a></li>
                <li><a href="/team/{{$idProject}}">Equipo</a></li>
                
            </ul>
            
            <ul>
                
                
                <li><a href="/home">Volver</a></li>
                
            </ul>
            
        </div>
        
        <div class="contenido open_side">
            <button class="btn btn-dark" id="btn-show-new-sprint"><i class="fas fa-plus"></i> Nuevo Sprint</button>
        
            <div class="table-responsive-xl div-custom-sprints">
                <table class="table table-sprints">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Sprint Goal</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha Final</th>
                            <th colspan="3">Acciones</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($sprints as $sprint)
                            <tr>
                                <td hidden>{{ $sprint['idsprints'] }}</td>
                                <td>{{ $sprint['sprint_name'] }}</td>
                                <td>{{ $sprint['sprint_goal'] }}</td>
                                <td>{{ $sprint['start_date'] }}</td>
                                <td>{{ $sprint['end_date'] }}</td>
                                
                                <td><a href="/daily/{{$idProject}}/{{$sprint['idsprints']}}" class="btn btn-info"><i class="fas fa-eye"></i></a></td>
                                <td><button class="btn btn-warning btn-edit-sprint"><i class="fas fa-pen"></i></button></td>
                                <td><a class="btn btn-danger btn-delete-sprint"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        
                       
                        
                    </tbody>
                </table>
                
                
            </div>
            
            
            
        </div>
        <!-- Form New sprint !-->
        <div class="form-new-sprint">
            
            <form method="POST" action="/sprints/create/{{$idProject}}">
                <h3>Nuevo Sprint</h3><br>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label for="name_sprint">Nombre del sprint</label><br>
                <input class="form-control" type="text" name="name_sprint" required/><br>
                
                <label for="name_sprint">Sprint Goal(opcional)</label><br>
                <textarea class="form-control" name="goal_sprint" type="textarea" rows="2" maxlength="200"></textarea><br>
                
                
                <label for="date_start">Fecha de Inicio</label><br>
                <input class="form-control" type="date" name="date_start" required/><br>
                
                <label for="">Fecha Final</label><br>
                <input class="form-control" type="date" name="date_end" required/><br><br>
                <input class="btn btn-success" type="submit" value="Crear"/>
                
            </form>
            <br>
            <button class="btn btn-danger" id="cancel_button">Cancelar</button>
        </div>
        
        
        <!-- Form Edit sprint !-->
        <div class="form-edit-sprint">
            
            <form method="POST" action='/sprints/update/{{$idProject}}'>
                <h3>Editar Sprint</h3>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <input type="hidden" name="id_sprint_edit"/>
                
                <label for="name_sprint">Nombre del sprint</label><br>
                <input class="form-control" type="text" name="name_sprint_edit" required/><br>
                
                <label for="name_sprint">Sprint Goal(opcional)</label><br>
                <input class="form-control" type="text" name="goal_sprint_edit" /><br>
                
                <label for="date_start">Fecha de Inicio</label><br>
                <input class="form-control" type="date" name="start_sprint_edit" required/><br>
                
                <label for="">Fecha Final</label><br>
                <input class="form-control" type="date" name="end_sprint_edit" required/><br><br>
                
                <input class="btn btn-success" type="submit" value="Editar"/>
                
            </form>
            <br>
            <button class="btn btn-danger" id="cancel_button_edit">Cancelar</button>
        </div>
        
        
        <script type="text/javascript" >
            $(function(){
                $('.form-new-sprint').hide();
                $('.form-edit-sprint').hide();
                
            });
            
            $('#btn-show-new-sprint').click(function(){
                console.log('On form new sprint');
                $('.form-new-sprint').slideToggle();
                $('#btn-show-new-sprint').attr('disabled', true);  
                $('.btn-edit-sprint').attr('disabled', true);
                
                
                
                $( "input[name='name_sprint']" ).val('');
                $( "input[name='goal_sprint']" ).val('');
                $( "input[name='date_start']" ).val('');
                $( "input[name='date_end']" ).val('');
                
            
            });
                
             
            
            
            
            $('.btn-edit-sprint').on('click', function() {
                
                $('#btn-show-new-sprint').attr('disabled', true);
                $('.btn-edit-sprint').attr('disabled', true);
                var $row = $(this).closest('tr');
                var $columns = $row.find('td');
                
                
                var values = new Array();
                
                $.each($columns, function(i, item) {
                    values[i] = item.innerHTML;
                });
                console.log(values);
                
                $( "input[name='id_sprint_edit']" ).val( values[0]);
                $( "input[name='name_sprint_edit']" ).val( values[1]);
                $( "input[name='goal_sprint_edit']" ).val( values[2]);
                $( "input[name='start_sprint_edit']" ).val( values[3]);
                $( "input[name='end_sprint_edit']" ).val( values[4]);
                
                $('.form-edit-sprint').slideToggle();
            });
            
            $('#cancel_button').click(function(){
                
                $('.form-new-sprint').slideToggle();
                $('#btn-show-new-sprint').attr('disabled', false); 
                $('.btn-edit-sprint').attr('disabled', false);
                
            });
            
            $('#cancel_button_edit').click(function() {
               
               $('.form-edit-sprint').slideToggle();
               $("#btn-show-new-sprint").attr('disabled', false);
               $(".btn-edit-sprint").attr('disabled', false);
               
                
            });
            
            $('.btn-delete-sprint').click(function() {
                
                var $row = $(this).closest('tr');
                var $columns = $row.find('td');
                
                
                var values = new Array();
                
                $.each($columns, function(i, item) {
                    values[i] = item.innerHTML;
                });
                
               if (confirm('¿Esta seguro de archivar "'+values[1]+'"?')) {
                    $.ajax({
                        url: '/sprints/delete/'+values[0],
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