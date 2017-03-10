<?php
if(!empty($_SESSION['rol']))
{
    $rol = $_SESSION['rol'];
    $id = $_SESSION['iduser'];
}
else
{
    $rol = 0;
}
include 'cabecera_comun.php';
?>
<script type="text/javascript">
  $(function(){
    $(".propias").css("display","none");
    $("#mis").on("click", function(){
        $(".propias").css("display","flex");
        $(".todas").css("display","none");
    });
    $("#todas").on("click", function(){
        $(".propias").css("display","none");
        $(".todas").css("display","flex");
    });
  });
</script>
<body>
  <?php
  if($rol==0)
  {
  ?>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="/storypub">StoryPub</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="/storypub/dashboard">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/storypub/registry"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
          <li><a href="/storypub/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
      </div>
    </nav>
  <?php
  }
  else if($rol!=0)
  {
  ?>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="/storypub">StoryPub</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="/storypub/dashboard">Home</a></li>
          <li><a href="#">My Stories</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class=""></span> <?=$_SESSION['user'];?></a></li>
          <li><a href="/storypub/dashboard/logout"><span class=""></span>Logout</a></li>
        </ul>
      </div>
    </nav>
  <?php
  }
  ?>

  <div id="container-fluid">
    <?php
    if($rol!=0)
    {
    ?>
      <div class="botones" style="display: flex; justify-content: center;">
        <button type="button" id="todas" style="margin-right: 50px;"" class="btn btn-lg btn-default">Todas las historias</button>
        <button type="button" id="mis" class="btn btn-lg btn-default">Mis historias</button>
      </div>
    <?php
    }
    ?>
    <div class="lista_historias">
      <div class="todas" style="display: flex; justify-content: center;">
      <table style="margin: 50px;width: 60%" border="1">
        <?php
          foreach ($this->dataTable['all_stories'] as $historia) {
          ?>
            <tr style="width: 100%;">
              <td style="padding: 10px;"><?=$historia['path']?></td>
              <td style="padding: 10px;"><p><strong><?=$historia['title']?></strong></p><?=$historia['sinopsis']?></td>
              <?php
              if($rol==1 || $id == $historia['users'])
              {
              ?>
                <td style="padding: 10px;">Editar</td>
                <td style="padding: 10px;">Borrar</td>
              <?php
              }
              ?>
            </tr>
        <?php
          }
        ?>
        
      </table></div>
      <dir class="propias" style="display: flex; justify-content: center;">
        <table style="margin: 50px;width: 60%" border="1">
        <?php
        if(!empty($this->dataTable['my_stories']))
        {
          foreach ($this->dataTable['my_stories'] as $historia) {
          ?>
            <tr style="width: 100%;">
              <td style="padding: 10px;"><?=$historia['path']?></td>
              <td style="padding: 10px;"><p><strong><?=$historia['title']?></strong></p><?=$historia['sinopsis']?></td>
              <td style="padding: 10px;">Editar</td>
              <td style="padding: 10px;">Borrar</td>
            </tr>
        <?php
          }
        }
        else
        {
        ?>
        <tr style="width: 100%;">
          <td style="padding: 10px;">No tienes ninguna historia. Crea una en este momento!</td>
          <td style="padding: 10px;">Crear historia.</td>
         </tr>
        <?php
        }
        ?> 
      </table>
      </dir>
    </div>
  </div>
  
</body>