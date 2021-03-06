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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1CS5qnLXMBlT8cvzsWPE7IaN5r5TT-tY&callback=myMap"></script>
<script type="text/javascript">
 $(function(){

    $(".roles").change(function(){
      rol = $(this).val();
      id=$(this).parents('.usuario').find('span').text();
      $.post("/storypub/users/roles/rol/"+rol+"/id/"+id);
    });

    $(".eliminar").on('click',function(){

      id=$(this).parents('.usuario').find('span').text();
      $.post("/storypub/users/delete/id/"+id);
      location.reload(true);
    });
function myMap() {
  var myCenter = new google.maps.LatLng(41.30113287936854,2.00122414681279);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 5};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter,title:'Flipendo!'});
  marker.setMap(map);
}

});


</script>

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

<div id="container-fluid" style="width: 60%;justify-content: center; margin-left: 20%; margin-top: 3%; background-color: white; padding: 20px; border-radius: 10px;">
  <h2>Users</h2>
    <?php
          foreach ($this->dataTable['users'] as $user) {
          ?>
            <div class="usuario" style="width: 100%; display: flex; border: 1px solid black; margin-bottom: 10px; ">
              <span style="display: none;"><?=$user['iduser']?></span>
              <div style="padding: 10px; width: 30%;"><?=$user['username']?></div>
              <div style="padding: 10px;width: 40%;"><?=$user['email']?></div>
              <div style="padding: 10px;width: 20%;"><select class="roles">
                    <option value="1" <?php if($user['rols']==1)echo 'selected'?>>Administrador</option>
                    <option value="2" <?php if($user['rols']==2)echo 'selected'?>>Usuario</option>
              </select></div>
              <div class="eliminar" style="padding: 10px;width: 10%;"><strong>eliminar</strong></div>
            </div>
        <?php
          }
        ?>
</div>