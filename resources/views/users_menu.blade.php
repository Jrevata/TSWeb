<!DOCTYPE html>
<html>
    <title>Users</title>
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
        .div-custom-users{
            
            
            
           
            
        }
        .table-users{
            text-align:center;
            
        }
        thead{
            
            background-color: #6C98FF;
        }
        tbody{
            
            background-color: #F9FAFC;
        }
        
        .form-new-user{
            position: fixed;
            width: 300px;
            height: 100%;
            padding: 15px;
            right: 0px;
            background-color: #F9FAFC;
            text-align: center;
            overflow-y: scroll;
        }
        
        .form-edit-user{
            position: fixed;
            width: 300px;
            height: 100%;
            padding: 20px;
            padding-top: 50px;
            right: 0px;
            background-color: #F9FAFC;
            text-align: center;
            overflow-y: scroll;
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
                <li><a href="/home">Proyectos</a></li>
                
                <li class="active"><a href="/users">Usuarios</a></li>
            </ul>
            
            <ul>
                
                
                <li><a class="btn-logout">Cerrar Sesión</a></li>
                
            </ul>
            
        </div>
        
        <div class="contenido open_side">
            <button class="btn btn-dark" id="btn-show-new-user"><i class="fas fa-plus"></i> Nuevo Usuario</button>
        
            <div class="table-responsive-xl div-custom-users">
                <table class="table table-users">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Admin</th>
                            <th colspan="2">Acciones</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td hidden>{{$user['idusers']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>{{$user['givenName']}}</td>
                                <td>{{$user['familyName']}}</td>
                                @if($user['role']==1)
                                    <td>Si</td>
                                @else
                                    <td>No</td>
                                @endif
                                <td><button class="btn btn-warning btn-edit-user"><i class="fas fa-pen"></i></button></td>
                                <td><a class="btn btn-danger btn-delete-user"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        
                        
                        
                        
                    </tbody>
                </table>
                
                
            </div>
            
            
            
        </div>
        <!-- Form New user !-->
        <div class="form-new-user">
            <iframe id="frame_new" name="frame" style="display:none;"></iframe>
            <form target="frame" id="form_new_user" method="POST">
                <h3>Nuevo Usuario</h3>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label for="email_user">Email</label><br>
                <input class="form-control" type="email" name="email_user" required/>
                <p class="p_email_user" style="color:red;">Este email ya existe</p><br>
                
                <label for="password_user">Password</label><br>
                <input class="form-control" type="password" name="password_user" required/><br>
                
                <label for="confirm_password_user">Confirm Password</label><br>
                <input class="form-control" type="password" name="confirm_password_user" required/>
                <p class="confirm-password" style="color:red;">Las contraseñas no coinciden</p><br>
                
                <label for="name_user">Nombres</label><br>
                <input class="form-control" type="text" name="name_user" required/><br>
                
                <label for="lastname_user">Apellidos</label><br>
                <input class="form-control" type="text" name="lastname_user" required/><br>
                
                <label for="admin_user">Administrador</label><br>
                <select class="form-control" name="admin_user" id="">
                    <option value="no_admin">No</option>
                    <option value="si_admin">Si</option>
                </select><br>
                
                <input class="btn btn-success btn-new-user" type="submit" value="Crear"/>
                
                
                
            </form>
            <br>
            <button class="btn btn-danger" id="cancel_button">Cancelar</button>
        </div>
        
        
        <!-- Form Edit user !-->
        <div class="form-edit-user">
            
            <form method="POST" action="/users/update">
                <h3>Editar Usuario</h3>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id_user_edit"/>
                <label for="email_user_edit">Email</label><br>
                <input class="form-control" type="text" name="email_user_edit" required/><br>
                
                <label for="name_user_edit">Nombres</label><br>
                <input class="form-control" type="text" name="name_user_edit" required/><br>
                
                <label for="lastname_user_edit">Apellidos</label><br>
                <input class="form-control" type="text" name="lastname_user_edit" required/><br>
                
                <label for="admin_user">Administrador</label><br>
                <select class="form-control" name="admin_edit_user" id="admin_edit_user">
                    <option value="no_admin_edit">No</option>
                    <option value="si_admin_edit">Si</option>
                </select><br>
                
                <input class="btn btn-success" type="submit" value="Editar"/>
                
            </form>
            <br>
            <button class="btn btn-danger" id="cancel_button_edit">Cancelar</button>
        </div>
        
        
        <script type="text/javascript" >
            $(function(){
                $('.form-new-user').hide();
                $('.form-edit-user').hide();
                $('.confirm-password').hide();
                $('.p_email_user').hide();
            });
            
            $('#btn-show-new-user').click(function(){
                console.log('On form new user');
                $('.form-new-user').slideToggle();
                $('#btn-show-new-user').attr('disabled', true);  
                $('.btn-edit-user').attr('disabled', true); 
            
            });
                
             
            
            
            
            $('.btn-edit-user').on('click', function() {
                
                $('#btn-show-new-user').attr('disabled', true);
                $('.btn-edit-user').attr('disabled', true);
                var $row = $(this).closest('tr');
                var $columns = $row.find('td');
                
                
                var values = new Array();
                
                $.each($columns, function(i, item) {
                    values[i] = item.innerHTML;
                });
                console.log(values);
                
                $( "input[name='id_user_edit']" ).val( values[0]);
                $( "input[name='email_user_edit']" ).val( values[1]);
                $( "input[name='name_user_edit']" ).val( values[2]);
                $( "input[name='lastname_user_edit']" ).val( values[3]);
                
                if(values[4] == "Si"){
                     $("#admin_edit_user option[value='si_admin_edit']").attr("selected", "selected");
                }else{
                    $("#admin_edit_user option[value='no_admin_edit']").attr("selected", "selected");
                }
                
                $('.form-edit-user').slideToggle();
            });
            
            $('#cancel_button').click(function(){
                
                $('.form-new-user').slideToggle();
                $('#btn-show-new-user').attr('disabled', false); 
                $('.btn-edit-user').attr('disabled', false);
                
            });
            
            $('#cancel_button_edit').click(function() {
                
               $('.form-edit-user').slideToggle();
               $("#btn-show-new-user").attr('disabled', false);
               $(".btn-edit-user").attr('disabled', false);
               
            });
            
            $('.btn-new-user').on('click', function(){
                $('.confirm-password').hide();
                $('.p_email_user').hide();
                var passPassword = true;
                var passEmail = true;
                if($("input[name='password_user']" ).val()!=$("input[name='confirm_password_user']" ).val()){
                    $('.confirm-password').show();
                    var passPassword=false;
                }else{
                    var passPassword=true;
                }
                
                var emails = new Array();
                <?php foreach($emails as $key => $val){ ?>
                    emails.push('<?php echo $val; ?>');
                <?php } ?>  
                var cont = 0;
                emails.forEach(function(element) {
                    if($("input[name='email_user']").val() == element){
                        console.log(element);
                        $('.p_email_user').show();
                        cont = 1;
                    }
                    
                });
                if(cont == 1){
                    passEmail = false;
                }
                if(passEmail==true && passPassword==true && $("input[name='name_user']").val().trim()!= '' && $("input[name='lastname_user']").val().trim()!= '' ){
                    $("#frame_new").remove();
                    $("#form_new_user").removeAttr('target');
                    $("#form_new_user").attr('action', '/users/store');
                }
                
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
                            location.reload();
                        },
                        error: function(ex){
                            location.reload();
                        }
                    });
                }
            });
            
            $('.btn-delete-user').click(function() {
                
                var $row = $(this).closest('tr');
                var $columns = $row.find('td');
                
                
                var values = new Array();
                
                $.each($columns, function(i, item) {
                    values[i] = item.innerHTML;
                });
                
               if (confirm('¿Esta seguro de cambiar de estado al usuario "'+values[1]+'"? Esta acción no podrá restaurar al usuario desde este sistema')) {
                    $.ajax({
                        url: '/users/delete/'+values[0],
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
        
    </body>
</html>