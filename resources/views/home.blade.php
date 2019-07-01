<!DOCTYPE html>
<html>
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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
        .div-custom-projects{
            
            
            
           
            
        }
        .table-projects{
            text-align:center;
            
        }
        thead{
            
            background-color: #6C98FF;
        }
        tbody{
            
            background-color: #F9FAFC;
        }
        
        .form-new-project{
            position: fixed;
            width: 300px;
            height: 100%;
            padding: 20px;
            padding-top: 50px;
            right: 0px;
            background-color: #F9FAFC;
            text-align: center;
            
            
        }
        
        .form-edit-project{
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
                <li class="active"><a href="/home">Proyectos</a></li>
                <li><a href="/users">Usuarios</a></li>
            </ul>
            
            <ul>
                
                <li><a class="btn-logout">Cerrar Sesión</a></li>
                
            </ul>
            
        </div>
        
        <div class="contenido open_side">
            <button class="btn btn-dark" id="btn-show-new-project"><i class="fas fa-plus"></i> Nuevo Proyecto</button>
        
            <div class="table-responsive-xl div-custom-projects">
                <table class="table table-projects">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha Final</th>
                            <th colspan="3">Acciones</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        
                            <tr>
                                <td hidden>{{ $project['idprojects'] }}</td>
                                <td>{{ $project['project_name'] }}</td>
                                <td>{{ $project['start_date'] }}</td>
                                <td>{{ $project['end_date'] }}</td>
                                <td>
                                <a href="/sprints/{{ $project['idprojects'] }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                
                                </td>
                                <td><button class="btn btn-warning btn-edit-project"><i class="fas fa-pen"></i></button></td>
                                <td><a class="btn btn-danger btn-delete-project" ><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        
                        @endforeach
                    </tbody>
                </table>
                
                
            </div>
            
            
            
        </div>
        <!-- Form New Project !-->
        <div class="form-new-project">
            
            <form method="POST" action="project/create">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h3>Nuevo Proyecto</h3>
                <label for="name_project">Nombre del projecto</label><br>
                <input class="form-control" type="text" name="name_project" required/><br>
                
                <label for="date_start">Fecha de Inicio</label><br>
                <input class="form-control" type="date" name="date_start" required/><br>
                
                <label for="">Fecha Final</label><br>
                <input class="form-control" type="date" name="date_end" required/><br><br>
                <input class="btn btn-success" type="submit" value="Crear"/>
                
            </form>
            <br>
            <button class="btn btn-danger" id="cancel_button">Cancelar</button>
        </div>
        
        
        <!-- Form Edit Project !-->
        <div class="form-edit-project">
            
            <form method="POST" action="project/update">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <h3>Editar Proyecto</h3>
                <input type="hidden" name="id_project_edit"/>
                <label for="name_project">Nombre del projecto</label><br>
                <input class="form-control" type="text" name="name_project_edit" required/><br>
                
                <label for="date_start">Fecha de Inicio</label><br>
                <input class="form-control" type="date" name="start_project_edit" required/><br>
                
                <label for="">Fecha Final</label><br>
                <input class="form-control" type="date" name="end_project_edit" required/><br><br>
                <input class="btn btn-success" type="submit" value="Editar"/>
                
            </form>
            <br>
            <button class="btn btn-danger" id="cancel_button_edit">Cancelar</button>
        </div>
        
        
        <script type="text/javascript" >
            $(function(){
                $('.form-new-project').hide();
                $('.form-edit-project').hide();
                
            });
            
            $('#btn-show-new-project').click(function(){
                console.log('On form new Project');
                $('.form-new-project').slideToggle();
                $('#btn-show-new-project').attr('disabled', true);  
                $('.btn-edit-project').attr('disabled', true); 
            
            });
                
             
            
            
            
            $('.btn-edit-project').on('click', function() {
                
                $('#btn-show-new-project').attr('disabled', true);
                $('.btn-edit-project').attr('disabled', true);
                var $row = $(this).closest('tr');
                var $columns = $row.find('td');
                
                
                var values = new Array();
                
                $.each($columns, function(i, item) {
                    values[i] = item.innerHTML;
                });
                console.log(values);
                
                $( "input[name='id_project_edit']" ).val( values[0]);
                $( "input[name='name_project_edit']" ).val( values[1]); 
                $( "input[name='start_project_edit']" ).val( values[2]);
                $( "input[name='end_project_edit']" ).val( values[3]);
                
                $('.form-edit-project').slideToggle();
            });
            
            $('#cancel_button').click(function(){
                
                $('.form-new-project').slideToggle();
                $('#btn-show-new-project').attr('disabled', false); 
                $('.btn-edit-project').attr('disabled', false);
                
            });
            
            $('#cancel_button_edit').click(function() {
               
               $('.form-edit-project').slideToggle();
               $("#btn-show-new-project").attr('disabled', false);
               $(".btn-edit-project").attr('disabled', false);
               
                
            });
            
            $('.btn-logout').click(function() {
                if(confirm("Está seguro de cerrar sesión")){
                    $.ajax({
                        url: '/logout',
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(data){
                            console.log(data);
                            location.reload();
                        },
                        error: function(ex){
                            location.reload();
                        }
                    });
                }
            });
            
            $('.btn-delete-project').click(function() {
                
                var $row = $(this).closest('tr');
                var $columns = $row.find('td');
                
                
                var values = new Array();
                
                $.each($columns, function(i, item) {
                    values[i] = item.innerHTML;
                });
                
               if (confirm('¿Esta seguro de archivar "'+values[1]+'"?')) {
                    $.ajax({
                        url: '/projects/delete/'+values[0],
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