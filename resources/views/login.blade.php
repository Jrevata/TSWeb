<!DOCTYPE html>
<html>
    <title>Tecscrum login</title>
    
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap.css" type="text/css" />
    <style type="text/css">
        body {
            
            background-color : #6C98FF;
            font-family: 'Lato', sans-serif;
        }
        
        .div1{
            
            background-color : #fff;
            border-radius : 30px;
            width : 700px;
            height: 585px;
            padding-bottom: 50px;
            
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            
            position:absolute; /*it can be fixed too*/
            left:0; right:0;
            top:0; bottom:0;
            margin:auto;
    
            /*this to solve "the content will not be cut when the window is smaller than the content": */
            max-width:100%;
            max-height:100%;
            overflow:auto;
            
            
            
        }
        .image{
        
            text-align : center;
        
        
        }
        .input{
            border: 1px solid #8492A6;
            padding : 5px;
            font-size: 15px;
            width : 300px;
            height : 40px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .button-login{
            font-size: 15px;
            width : 310px;
            height : 50px;
            background-color: #47525E;
            color: #fff;
            border-radius: 5px;
        }
        .image input: hover {
            background-color: #fff;
        }
    </style>


    <body>
        
        <div class="div1">
            <div class="image">
                <img src="/images/img_logo.png"></img>
            </div>
            <div class="image">
                <h1>TECSCRUM</h1>
                
            </div>
            @isset($isLogin)
                <div style="text-align: center;" class="alert alert-danger" role="alert">
                  Credenciales inválidas
                </div>
            @endisset
            @isset($isAdmin)
                <div style="text-align: center;" class="alert alert-danger" role="alert">
                  No cuenta con privilegios de administrador
                </div>
            @endisset
            <form method="POST" action="login"> 
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="image">
                    <input class="input" type="email" name="email" placeholder="Email" required/>
                </div>
                <div class="image">
                    <input class="input" type="password" name="password" placeholder="Password" required/>
                </div>
                <div class="image">
                    <input class="button-login" type="submit" name="" value="Sign In"/>
                </div>
            
            </form>
            
        </div>
        
    </body>
    
</html>