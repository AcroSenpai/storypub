
<?php
    include 'cabecera_comun.php';
?>
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
          <a class="navbar-brand" href="/storypub">StoryPub</a>
        </div>
      </div>
    </nav>

    <div class="container">

      <div class="jumbotron">
          <a class="center-block" href="/storypub/login"><button type="button" class="btn btn-lg btn-default">Login</button></a>
          <a href="/storypub/registry"><button type="button" class="btn btn-lg btn-default">Registry</button></a>
          <a href="/storypub/dashboard"><button type="button" class="btn btn-lg btn-default">Guest</button></a>
      </div>

    </div>
  </body>
</html>