<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FlightFree</title>
  <link rel="stylesheet" href="styles.css">
  <script src="https://kit.fontawesome.com/27552c5f41.js" crossorigin="anonymous"></script>
  <style>
     .centered-heading {
            background-color:rgb(53, 147, 235) ; 
            color: #fff; 
            border-radius: 15px; 
            padding: 50px; 
            text-align: center;
        }
        .full-screen {
            display: flex;
            justify-content: center; /* Centrar horizontalmente */
            align-items: center; /* Centrar verticalmente */
            height: 80vh; /* Altura de la pantalla completa */
        }
  </style>
</head>
<body>
  <div class="menu" id="menu">
    <div class="menu-toggle" >
      <div class="menu-icon"><i class="fa-solid fa-ellipsis"></i></div>
    </div>
    <ul class="menu-items">
      <li><a href="../dashboard/dashboard.tpl.php?page=user"><i class="fas fa-user"></i></a></li>
      <li><a href="../dashboard/dashboard.tpl.php?page=flight"><i class="fa-solid fa-plane-circle-exclamation"></i></a></li>
      <li><a href="../dashboard/dashboard.tpl.php?page=pilot"><i class="fa-solid fa-splotch"></i></a></li>
      <li><a href="../dashboard/dashboard.tpl.php?page=plane"><i class="fa-solid fa-plane"></i></a></li>
      <li><a href="../dashboard/dashboard.tpl.php?page=reserve"><i class="fa-solid fa-ticket"></i></a></li>
      <li><a href="../dashboard/dashboard.tpl.php?page=searchflight"><i class="fa-solid fa-magnifying-glass"></i></i></a></li>
      <li><a href="../../login/login.php?modo=logout"><i class="fas fa-sign-out-alt"></i></a></li>
    </ul>
  </div>
  
  <div class="contenido">
    <?php
    session_start();
    if (!isset($_SESSION['rol']) && !isset($_SESSION['user'])) {
      header("Location: ../../index.php");
      exit();
    }
    $rol = $_SESSION['rol'];
    
    if (!empty($_GET['page'])) {
      $page= $_GET['page'];
    
      switch ($page) {
        case 'user':
            if ($rol == 1) {
              include '../manageusers/manageusers.tpl.php';
            } 
            else{
             echo "<div class='container-fluid full-screen'><h4 class='centered-heading'>NO TIENES ACCESO A ESTA PAGINA</h4></div>";
            }
          break;
        case 'flight':
          if ($rol == 1) {
            include '../manageflight/manageflight.tpl.php';
          }
          else{
           echo "<div class='container-fluid full-screen'><h4 class='centered-heading'>NO TIENES ACCESO A ESTA PAGINA</h4></div>";
          }
          break;
        
        case 'pilot':
          if($rol == 1){
            include '../managepilot/managepilot.tpl.php';
          }
          else{
           echo "<div class='container-fluid full-screen'><h4 class='centered-heading'>NO TIENES ACCESO A ESTA PAGINA</h4></div>";
          }
            
          break;
          
        case 'plane':
          if ($rol == 1) {
            include '../manageplane/manageplane.tpl.php';
          }
          else{
           echo "<div class='container-fluid full-screen'><h4 class='centered-heading'>NO TIENES ACCESO A ESTA PAGINA</h4></div>";
          }
           
          break;

        case 'reserve':
          if ($rol == 1) {
            include '../managereserve/managereserve.tpl.php';
          }
          else{
            echo "<div class='container-fluid full-screen'><h4 class='centered-heading'>NO TIENES ACCESO A ESTA PAGINA</h4></div>";
          }
            
          break;

        case 'searchflight':
          include '../searchflight/searchflight.tpl.php';
        break;
        default:
          # code...
          break;
      }
      
    }
   
      
    ?>
  </div>


  

  <script src="script.js"></script>

</body>
</html>
