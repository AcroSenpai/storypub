<?php
    include 'cabecera_comun.php';
?>
<script>
    $(function(){
        
        $("#form_login").submit(function(event)
        { 
            event.preventDefault();
            var user = $("#user").val()
            var pass = $.md5($("#pass").val());

            $.post( "/storypub/login/login",{user:user,pass:pass}, function( data ) {
                    if(data==1)
                    {
                        window.location.href = "http://aperez.cesnuria.com/storypub/dashboard";
                    }
                    else
                    {
                        alert(data);
                    }

            });
           
        });
        
    });
</script>
  <body>

    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/storypub/">StoryPub</a>
        </div>
    </nav>

    <div class="container">
        <div class="cont_blanco">
        <form class="form-signin" method="POST" id="form_login">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputtext" class="sr-only">Username</label>
        <input type="text" id="user" name="user" class="form-control" placeholder="Usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
      </form>
        <a href="https://aperez.cesnuria.com/storypub/registry"><button type="button" class="btn btn-lg btn-default">Registry</button></a>
          <a href="https://aperez.cesnuria.com/storypub/dashboard"><button type="button" class="btn btn-lg btn-default">Guest</button></a>
        </div>
    </div> 
  </body>
</html>

