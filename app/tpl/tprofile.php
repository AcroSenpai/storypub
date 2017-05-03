<?php 

if(!empty($_SESSION['rol']))
{
    $rol = $_SESSION['rol'];
    $id = $_SESSION['iduser'];
}
else
{
    header('Location: /storypub/dashboard');
}
include 'cabecera_comun.php';
?>


<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="/storypub/dashboard">StoryPub</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="/storypub/dashboard">Home</a></li>
          <li><a href="/storypub/newstory">New Story</a></li>
          <?php
            if($rol==1)
            {
          ?>
            <li><a href="/storypub/users">Users</a></li>
          <?php
            }
          ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
  <?php
  if($rol==0)
  {
  ?>
          <li><a href="/storypub/registry"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
          <li><a href="/storypub/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
  <?php
  }
  else if($rol!=0)
  {
  ?>
          <li><a href="/storypub/profile"><span class=""></span><?=$_SESSION['user'];?></a></li>
          <li><a href="/storypub/dashboard/logout"><span class=""></span>Logout</a></li>
  <?php
  }
  ?>
        </ul>
      </div>
</nav>

<div id="container-fluid" style="width: 60%;justify-content: center; margin-left: 20%; margin-top: 3%; background-color: white; padding: 20px; border-radius: 10px; display: flex; flex-wrap: wrap; justify-content: space-between;">
<h2 style="width: 100%;">Perfil</h2>
    <div style="font-size: 20px;">
      <div><strong>Nombre: </strong><?=$this->dataTable['user'][0]['username'];?></div>
      <div><strong>Email: </strong><?=$this->dataTable['user'][0]['email'];?></div>
      <div><strong>Rol: </strong><?php if($this->dataTable['user'][0]['rols']==1){echo 'Administrador';} else{ echo 'Usuario';};?></div>
    </div>
    <div id="map" style="width:50%;height:200px"></div>
    <script type="text/javascript">
      function myMap() {
        var myCenter = new google.maps.LatLng(<?=$this->dataTable['user'][0]['altitud'];?>,<?=$this->dataTable['user'][0]['latitud'];?>);
        var mapCanvas = document.getElementById("map");
        var mapOptions = {center: myCenter, zoom: 8};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({position:myCenter,title:'Flipendo!'});
        marker.setMap(map);
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1CS5qnLXMBlT8cvzsWPE7IaN5r5TT-tY&callback=myMap"></script>
    <h2 style="width: 100%;">Historias</h2>
    <div style="width: 100%;">
    <?php
      foreach ($this->dataTable['stories'] as $story)
      {
        ?>
        <div class="historia">
                <a class="datos" href="/storypub/storyview/load/id/<?=$story['idstories']?>">
                <div class="media"><?=$story['medium_value']?></div>
                <div class="h_cont"><p><strong><?=$story['title']?></strong></p><?=$story['sinopsis']?></div>
                </a>
                <div class="acciones">
                  <a href="/storypub/editstory/load/id/<?=$story['idstories']?>">
                  <div>Editar</div>
                  </a>
                  <a href="/storypub/dashboard/delete/id/<?=$story['idstories']?>">
                  <div>Borrar</div>
                  </a> 
                </div>
              </div>
        <?php
      }
    ?>
    </div>
</div>