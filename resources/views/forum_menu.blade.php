<!DOCTYPE html>
<html>
    <title>Forum</title>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
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
            overflow-y: scroll;
            
        }
        .contenido{
            position: absolute;
            width: 80%;
            height: 100%;
            background-color: #fff;
            margin-left: 20%;
            padding-right: 100px;
            padding-left: 100px;
            padding-top: 30px;
            
        }
        .form-new-daily{
            position: fixed;
            width: 80%;
            height: 100%;
            padding: 20px;
            padding-top: 50px;
            right: 0px;
            background-color: #F9FAFC;
            
            overflow-y: scroll;
            
        }
        .div-custom-dailys-user{
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
        
        
        
        .table-dailys{
            text-align:center;
            height: 10px;
        }
        .table-dailys-user{
            text-align:center;
            
            height: 10px;
        }
        .table-dailys-user td{
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
        
        .card {
  /* Add shadows to create the "card" effect */
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
          transition: 0.3s;
          width: 100%;
          
          padding-top:15px;
          background-color: #F9FAFC;
          
         
        }
        .forum{
            
            width: 100%;
            height: 100%;
            padding:20px;
          
            
            
            
        }
        .circular--square{
            width: 95px;
            height: 90px;
            border-radius: 50%;
            border: 2px solid #000;
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
                <li><a href="/moodtoday/{{$idProject}}/{{$idSprint}}">MoodToday</a></li>
                <li class="active"><a href="/forum/{{$idProject}}/{{$idSprint}}">Foro</a></li>
                
            </ul>
            
            <ul>
                
                
                <li><a href="/sprints/{{$idProject}}">Volver</a></li>
                
            </ul>
            
        </div>
        
        <div class="contenido open_side">
        
           
            <div class="forum">
                <form>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <textarea id="message" placeholder="Escriba un comentario..." style="margin-bottom: 5px;" class="form-control" name="message" maxlength="300"></textarea>
                    <p id="required-message" style="color: red;">Este campo es necesario*</p>
                </form>
                    <button class="btn btn-secondary btn-lg btn-block addComment">Publicar</button>
                
                <br>
                <div class="card_container">
                    @foreach($comments as $comment)
                        <div class="card">
                            
                            <div class="container">
                                <div class="row">
                                    <div class="col-2" style="text-align:center;">
                                        @if($comment['image']!=null)
                                            <img class=circular--square src="{{$urlImage}}{{$comment['image']}}"></img>
                                        @else
                                            <img class=circular--square src="/images/img_profile_logo.jpg"></img>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <h5>{{$comment['givenName']}} {{$comment['familyName']}}</h5>
                                        <h6>{{$comment['created_at']}}</h6>
                                        <p>{{$comment['message']}}</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>
        
    <script type="text/javascript">
        $(function(){
            $("#required-message").hide();
        });
        
        $('.addComment').on('click',function(){
            
            var hola = $("#message").val().trim();
            console.log(hola.length);
            if(hola.length==0){
                $("#required-message").show();
                return;
            }
            
            $.ajax({
                cache: false,
                type: 'POST',
                url: '/forum/store',
                data: {
                    '_token'  : $('input[name=_token]').val(),
                    'message' : $("#message").val(),
                    'sprints_idsprints' : '{{$idSprint}}'
                },
                success: function(data){
                    console.log(data);
                    
                    var div_card=
                        '<div class="card">'+
                            '<div class="container">'+
                                '<div class="row">'+
                                    '<div class="col-2" style="text-align:center;">'+
                                        '<img class=circular--square src="{{$urlImage}}'+data.image+'"></img>'+
                                    '</div>'+
                                    '<div class="col">'+
                                        '<h5>'+data.givenName+' '+data.familyName+'</h5>'+
                                        '<h6>'+data.created_at+'</h6>'+
                                        '<p>'+data.message+'</p>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                    
                    $('.card_container').prepend(div_card);
                    
                    $("#message").val('');
                    
                },
                error: function(ex){
                    console.log(ex.responseText);
                }
            });
            
        });
        
    </script>   
     <!--   <script type="text/javascript" src="/js/open-sidebar-home.js"></script> !-->
    </body>
</html>