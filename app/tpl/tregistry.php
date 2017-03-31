<?php
    include 'cabecera_comun.php';
?>
<script>
    $(function(){
       
        $("#email").focusout(function()
        { email=$("#email").val();
            $.post( "/registry/check_email",{ email: email}, function( data ) {
               $("#error_email").text(data);
            });
        });
        
        $("#user").focusout(function()
        { user=$("#user").val();
            $.post( "/registry/check_user",{ user: user}, function( data ) {
               $("#error_user").text(data);
            });
        });
        
        $("#form_registry").submit(function(event)
        { 
            event.preventDefault();
            var user = $("#user").val();
            var email = $("#email").val();
            var pass = $.md5($("#pass").val());
            

            if($("#error_email").text()=="" && $("#error_user").text()=="")
            {
                $.post( "/registry/registry",{email:email,user:user,pass:pass}, function( data ) {
                    if(data==1)
                    {
                        window.location.href = "http://aperez.cesnuria.com/dashboard";
                    }
                    else
                    {
                        alert(data);
                    }

                 }); 
            }
           
        });
        
    });
</script>
  <body>

    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">StoryPub</a>
        </div>
      </div>
    </nav>

    <div class="container">

        <form class="form-signin" method="POST" id="form_registry">
        <h2 class="form-signin-heading">Registry</h2>
        <label for="inputPassword" class="sr-only">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
        <span id="error_email"></span>
        <label for="inputtext" class="sr-only">Username</label>
        <input type="text" id="user" name="user" class="form-control" placeholder="User" required>
        <span id="error_user"></span>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
        <span id="error_pass"></span>
        
        
        <button id="enviar" class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
      </form>
        <a href="/login"><button type="button" class="btn btn-lg btn-default">Login</button></a>
          <a href="/dashboard"><button type="button" class="btn btn-lg btn-default">Guest</button></a>
    </div> 
  </body>
</html>


