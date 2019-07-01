<!DOCTYPE html>
<html>
    <title>Moodtoday</title>
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
        .form-new-moodtoday{
            position: fixed;
            width: 80%;
            height: 100%;
            padding: 20px;
            padding-top: 50px;
            right: 0px;
            background-color: #F9FAFC;
            
            overflow-y: scroll;
            
        }
        .div-custom-moodtodays-user{
            text-align: center;
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
        
        
        
        .table-moodtodays{
            text-align:center;
            height: 10px;
        }
        .table-moodtodays-user{
            text-align:center;
            
            height: 10px;
        }
        .table-moodtodays-user td{
            vertical-align:middle;
        }
        thead{
            
            background-color: #6C98FF;
        }
        tbody{
            
            background-color: #F9FAFC;
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
                <li><a href="/daily/{{$idProject}}/{{$idSprint}}">Daily</a></li>
                <li class="active"><a href="/moodtoday/{{$idProject}}/{{$idSprint}}">MoodToday</a></li>
                <li><a href="/forum/{{$idProject}}/{{$idSprint}}">Foro</a></li>
                
            </ul>
            
            <ul>
                
                
                <li><a href="/sprints/{{$idProject}}">Volver</a></li>
                
            </ul>
            
        </div>
        
        <div class="contenido open_side">
        
            <div class="table-responsive-xl div-custom-moodtodays">
                <table class="table table-moodtodays">
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
                                <td hidden>{{$user['idusers']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>{{$user['givenName']}}</td>
                                <td>{{$user['familyName']}}</td>
                                
                                <td><a class="btn btn-info btn-show-new-moodtoday"><i class="fas fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                
            </div>
             
            
            
        </div>
        <!-- Form New moodtoday !-->
        <div class="form-new-moodtoday">
            
            <button class="btn btn-danger float-right" id="cancel_button"><i class="fas fa-arrow-left"></i> Volver</button>
             <div class="table-responsive-xl div-custom-moodtodays-user">
                <h2 class="name_user_moodtoday">Jordan Revata Cuela</h2>
                <table id="table-moodtoday" class="table table-moodtodays-user">
                    <thead>
                        <tr>
                            <th hidden>id</th>
                            <th width="20%">Fecha</th>
                            <th width="20%">¿Cómo me sentí?</th>
                            <th width="20%">Avance</th>
                            <th width="40%">¿Qué dificultades tuve?</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                
                
            </div>
            
        </div>
        
        
        
        
        
        <script type="text/javascript" >
        
            
        
            $(function(){
                $('.form-new-moodtoday').hide();
               
                
            });
            
            $('.btn-show-new-moodtoday').click(function(){
                console.log('On form new moodtoday');
                $('.form-new-moodtoday').slideToggle();
                $('.btn-show-new-moodtoday').attr('disabled', true);  
                $('.btn-edit-moodtoday').attr('disabled', true); 
                //clear table
                $("#table-moodtoday tbody").empty();
                //Data table
                var $row = $(this).closest('tr');
                var $columns = $row.find('td');
                
                var values = new Array();
                
                $.each($columns, function(i, item) {
                    values[i] = item.innerHTML;
                });
                console.log(values);
                
                $('.name_user_moodtoday').html( values[2]+' '+values[3]);
                
                $.ajax({
                    cache: false,
                    type: 'GET',
                    url:'/moodtoday/listMoodToday/'+'{{$idSprint}}'+'/'+values[0],
                    dataType : 'json',  
                    success : function(data){
                        console.log(data);
                        $.each(data, function(i, item){
                            var moodName = selectMood(item.mood_idmood);
                            var dedicated = selectDedicated(item.dedicated_iddedicated);
                            var row = '<tr>' +
                            '<td hidden>'+item.users_idusers+'</td>' +
                            '<td width="20%">'+item.date_mood+'</td>' +
                            '<td width="20%">'+moodName+'</td>' +
                            '<td width="20%">'+dedicated+'</td>' +
                            '<td width="40%">'+item.difficulties+'</td>'+
                            '</tr>';
                            $('#table-moodtoday tbody').append(row);
                            
                        });
                    },
                    error: function(ex){
                        alert("Algo salió mal");
                    }
                   });
            
            });
                
             
            
            
           
            $('#cancel_button').click(function(){
                
                $('.form-new-moodtoday').slideToggle();
                $('.btn-show-new-moodtoday').attr('disabled', false); 
              
                
            });
            
           function selectMood($idMood){
               var value = "";
               switch($idMood){
                   case 1:
                        value = "Enojado";
                        break;
                    case 2:
                        value = "Mal";
                        break;
                    case 3:
                        value = "Neutral";
                        break;
                    case 4:
                        value = "Feliz";
                        break;
                    case 5:
                        value = "Excelente";
                        break;
                        
               }
               
               return value;
               
           }
           
           function selectDedicated($idDedicated){
               var value = "";
               switch($idDedicated){
                   
                   case 1:
                       value = "Nada";
                       break;
                    case 2:
                        value = "< 40 %";
                        break;
                    case 3:
                        value = "40% - 70%";
                        break;
                    case 4:
                        value = "> 70%";
                        break;
                    case 5:
                        value = "100%";
                        break;
               }
               
               return value;
           }
            
        </script>
        
     <!--   <script type="text/javascript" src="/js/open-sidebar-home.js"></script> !-->
    </body>
</html>