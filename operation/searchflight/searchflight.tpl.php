<?php
include_once '../manageflight/c_manageflight.php';
include_once 'c_searchflight.php';
$controller = new ManageFlightController();
$flights = $controller->getFlight();


$searchFlight = new SearchFlightController();
$reserves = $searchFlight->getReserveById($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar usuarios</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
      select.form-select {
      appearance: auto;
      background-color: #fff;
      background-image: none;
      border: 1px solid #ced4da;
      border-radius: .25rem;
      color: #495057;
      padding: .375rem .75rem;
      line-height: 1.5;
      width: 100%;
      transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }


     div.dataTables_filter {
            text-align: justify;
            
            
        }
    div.dataTables_wrapper input[type="search"] {
        margin-right: 120px; 
        width: 350px; 
        padding: 5px;
        border-radius: 5px; 
        border: 1px solid #ccc; 
    }

    h2{
      text-align: center;
    }

  </style>

</head>

<body>

  <div class="container-fluid mt-5">
    <h2>Buscar vuelos</h2>
    <hr>
    <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Agregar</button> -->
    <table id="grid" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Piloto</th>
          <th>Avion</th>
          <th>Origen</th>
          <th>Destino</th>
          <th>Acciones</th>
         
        </tr>
      </thead>
      <tbody>
      <?php foreach ($flights as $flight) : ?>
          <tr>
            <td><?php echo $flight['vlso_id']; ?></td>
            <td><?php echo $flight['vlso_fecha']; ?></td>
            <td><?php echo $flight['vlso_hora']; ?></td>
            <td><?php echo $flight['vlso_piloto']; ?></td>
            <td><?php echo $flight['vlso_avion']; ?></td>
            <td><?php echo $flight['vlso_origen']; ?></td>
            <td><?php echo $flight['vlso_destino']; ?></td>

            <td>
              <button type="button" class="btn btn-info btn-sm btnm" data-toggle="modal" data-target="#editModal">Reservar <i class="fa-solid fa-ticket"></i></button>
            </td>
           
            
            
          </tr>

        
      <?php endforeach; ?>
       
      </tbody>
</table>
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#searchReserve">Consultar mis reservas</button>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Crear reserva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="../searchflight/searchflight.php?modo=createReserve" method="post">
          <div class="form-group">
            <label for="departuredate">Fecha salida:</label>
            <input type="date" class="form-control" id="departuredate" name="departuredate" required >

            <label for="departuretime">Hora salida:</label>
            <input type="time" class="form-control" id="departuretime" name="departuretime" required >

            <label for="origin">Origen:</label>
            <input type="text" class="form-control" id="origin" name="origin" required >

            <label for="destination">Destino:</label>
            <input type="text" class="form-control" id="destination" name="destination" required >

            <label for="totalpassengers">Total pasajeros:</label>
            <input type="number" class="form-control" id="totalpassengers" name="totalpassengers" required>

            
          </div>
          <button type="submit" class="btn btn-primary">Crear Reserva</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="searchReserve" tabindex="-1" role="dialog" aria-labelledby="searchReserveLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Mis reservas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Total pasajeros</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha salida</th>
                <th>Hora salida</th>
                <th>Estado</th>
                <th>Fecha creacion</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($reserves as $reserve) : ?>
              <tr>
          
                <td><?php echo $reserve['rsva_id']; ?></td>
                <td><?php echo $reserve['rsva_totalpasajeros']; ?></td>
                <td><?php echo $reserve['rsva_origen']; ?></td>
                <td><?php echo $reserve['rsva_destino']; ?></td>
                <td><?php echo $reserve['rsva_fechasalida']; ?></td>
                <td><?php echo $reserve['rsva_horasalida']; ?></td>
                <td><?php echo $reserve['rsva_estado']; ?></td>
                <td><?php echo $reserve['rsva_fechacreacion']; ?></td>

               

              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- DATATABLES -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-toast-plugin@1.3.2/dist/jquery.toast.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-toast-plugin@1.3.2/dist/jquery.toast.min.css">
<script>
  $(document).ready(function() {
    // Habilitar el botón de modificar al seleccionar una fila
    $('#grid').DataTable();
    $('tbody tr').click(function() {
      $(this).addClass('selected').siblings().removeClass('selected');
      $('#editBtn').prop('disabled', false);
    });

    // Abrir el modal de edición al hacer clic en el botón de modificar
    $('#editBtn').click(function() {
      $('#editModal').modal('show');
    });

    $('#grid').on('click', '.btnm', function() {
      // Obtener los datos de la fila seleccionada
      var fila = $(this).closest('tr');
      
      var dato2 = fila.find('td:eq(1)').text(); // Obtener el segundo dato de la fila
      var dato3 = fila.find('td:eq(2)').text(); // Obtener el tercer dato de la fila
      var dato5 = fila.find('td:eq(5)').text(); // Obtener el quinto dato de la fila
      var dato6 = fila.find('td:eq(6)').text(); // Obtener el sexto dato de la fila
      
     
      // Actualizar los campos del modal con los datos obtenidos
     
      $('#departuredate').val(dato2);
      $('#departuretime').val(dato3);
     
      $('#origin').val(dato5);
      $('#destination').val(dato6);
      
    });

  });


  function validar(){
      let validar = validarDatos()
      console.log(validar)
      if (!validar) {
        return false
      }
      return true
    }

    //Validar formulario 
    function validarDatos(){
      let msj1 = "Lo siento, debe diligenciar todos los campos obligatorios."
      let msj2 = "Por favor digite los siguientes campos:"
      let campos = ''

      let nombre = $("#nombre2").val()
      console.log(nombre)
      if (nombre == '') {
        campos += '&#9679; '+ 'Nombre' + '</br>';
      }


      if ($.trim(campos) != '') {
        var alert = (msj1 + '<br/>' + msj2 + '<br/><br/>' + campos + '<br/>' )
        cons
        $.toast({
          heading:'::AIR::',
          text:alert,
          showHideTransition: 'plain',
          icon: 'info',
          stack: false,
          position:'top-center',
          hideAfter: 3000
        });
        event.preventDefault();
        return false;

      }else{
        return true;
      }
    }
</script>

</body>

</html>