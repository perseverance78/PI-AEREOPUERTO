<?php
include_once 'c_manageflight.php';
$controller = new ManageFlightController();
$flights = $controller->getFlight();
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
    <h2>Gestionar vuelos</h2>
    <hr>
    <table id="grid" class="table table-striped table-bordered table-light" style="width:100%">
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
              <button type="button" class="btn btn-info btn-sm btnm" data-toggle="modal" data-target="#editModal"><i class="fa-regular fa-pen-to-square"></i></button>
              
              <a href="#"  class="btn btn-light btn-sm" onclick="confirmarDelete('<?php echo $flight['vlso_id']; ?>')"><i class="fa-regular fa-trash-can"></i></a>
            </td>
          </tr>

        
      <?php endforeach; ?>
       
      </tbody>
</table>
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Agregar</button>
</div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Agregar Vuelo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="../manageflight/manageflight.php?modo=createFlight" method="post" >
          <div class="form-group">
            <label for="Fecha">Fecha:</label>
            <input type="date" class="form-control" id="Fecha2" name="date" required>

            <label for="hora">Hora:</label>
            <input type="time" class="form-control" id="hora2" name="hour" required>

            <label for="piloto">Piloto:</label>
            <input type="text" class="form-control" id="piloto2" name="pilot" required>

            <label for="avion">Avion:</label>
            <input type="text" class="form-control" id="avion2" name="plane" required>

            <label for="origen">Origen:</label>
            <input type="text" class="form-control" id="origen2" name="origin" required>

            <label for="destino">Destino:</label>
            <input type="text" class="form-control" id="destino2" name="destination" required>
            
          </div>
          <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Modificar Vuelo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="../manageflight/manageflight.php?modo=updateFlight" method="post">
        <div class="form-group">
            <label for="Fecha">Fecha:</label>
            <input type="date" class="form-control" id="fecha" name="date" required>

            <label for="hora">Hora:</label>
            <input type="time" class="form-control" id="hora" name="hour" required>

            <label for="piloto">Piloto:</label>
            <input type="text" class="form-control" id="piloto" name="pilot" required>

            <label for="avion">Avion:</label>
            <input type="text" class="form-control" id="avion" name="plane" required>

            <label for="origen">Origen:</label>
            <input type="text" class="form-control" id="origen" name="origin" required>

            <label for="destino">Destino:</label>
            <input type="text" class="form-control" id="destino" name="destination" required>

            <input type="hidden" id="id" name="id">
            
          </div>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
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
      var dato1 = fila.find('td:eq(0)').text(); // Obtener el primer dato de la fila
      var dato2 = fila.find('td:eq(1)').text(); // Obtener el segundo dato de la fila
      var dato3 = fila.find('td:eq(2)').text(); // Obtener el tercer dato de la fila
      var dato4 = fila.find('td:eq(3)').text(); // Obtener el cuarto dato de la fila
      var dato5 = fila.find('td:eq(4)').text(); // Obtener el quinto dato de la fila
      var dato6 = fila.find('td:eq(5)').text(); // Obtener el sexto dato de la fila
      var dato7 = fila.find('td:eq(6)').text(); // Obtener el septimo dato de la fila
     
      // Actualizar los campos del modal con los datos obtenidos
      $('#id').val(dato1);
      $('#fecha').val(dato2);
      $('#hora').val(dato3);
      $('#piloto').val(dato4);
      $('#avion').val(dato5);
      $('#origen').val(dato6);
      $('#destino').val(dato7);
    });

  });

 
  function confirmarDelete(valor) {
      if (confirm("¿Estás seguro de eliminar la tarea?")) {
          window.location.href = "../manageflight/manageflight.php?modo=deleteFlight&id=" + valor;
      }
  }
  function confirmarRealizada(valor) {
      if (confirm("¿Desea marcar la tarea como realizada?")) {
          window.location.href = "task.php?modo=taskDone&id=" + valor;
      }
  }
  


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