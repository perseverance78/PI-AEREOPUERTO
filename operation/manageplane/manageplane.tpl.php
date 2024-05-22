<?php
include_once 'c_manageplane.php';
$controller = new ManagePlaneController();
$planes = $controller->getPlane();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar Aviones</title>
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
    <h2>Gestionar aviones</h2>
    <hr>
    <table id="grid" class="table table-striped table-bordered table-light" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Serie</th>
          <th>Modelo</th>
          <th>Año Fabricacion</th>
          <th>Aerolinea</th>
          <th>Codigo</th>
          <th>Cant. Pasajeros</th>
          <th>Capacidad</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($planes as $plane) : ?>
          <tr>
      
            <td><?php echo $plane['vno_id']; ?></td>
            <td><?php echo $plane['vno_numeroserie']; ?></td>
            <td><?php echo $plane['vno_modelo']; ?></td>
            <td><?php echo $plane['vno_ayofabricacion']; ?></td>
            <td><?php echo $plane['rlna_id']; ?></td>
            <td><?php echo $plane['vno_codigo']; ?></td>
            <td><?php echo $plane['vno_capacidadpasajeros']; ?></td>
            <td><?php echo $plane['vno_capacidadpeso']; ?></td>
            <td>
              <button type="button" class="btn btn-info btn-sm btnm" data-toggle="modal" data-target="#editModal"><i class="fa-regular fa-pen-to-square"></i></button>
              
              <a href="#"  class="btn btn-light btn-sm" onclick="confirmarDelete('<?php echo $plane['vno_id']; ?>')"><i class="fa-regular fa-trash-can"></i></a>
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
        <h5 class="modal-title" id="addModalLabel">Agregar Avion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="../manageplane/manageplane.php?modo=createPlane" method="post" >
          <div class="form-group">
            <label for="serie">Serie:</label>
            <input type="text" class="form-control" id="serie" name="serie" required>

            <label for="model">Modelo:</label>
            <input type="text" class="form-control" id="model" name="model" required>

            <label for="year">Año de Fabricacion:</label>
            <input type="date" class="form-control" id="year" name="year" required>

            <label for="airline">Aerolinea:</label>
            <input type="text" class="form-control" id="airline" name="airline" required>

            <label for="code">Codigo:</label>
            <input type="text" class="form-control" id="code" name="code" required>

            <label for="passengers">Cantidad pasajeros:</label>
            <input type="text" class="form-control" id="passengers" name="passengers" required>

            <label for="capacity">Capacidad(Kg):</label>
            <input type="text" class="form-control" id="capacity" name="capacity" required>
            
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
        <h5 class="modal-title" id="editModalLabel">Modificar Avion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="../manageplane/manageplane.php?modo=updatePlane" method="post">
        <div class="form-group">
            <label for="serie">Serie:</label>
            <input type="text" class="form-control" id="serie2" name="serie" required>

            <label for="model">Modelo:</label>
            <input type="text" class="form-control" id="model2" name="model" required>

            <label for="year">Año de Fabricacion:</label>
            <input type="date" class="form-control" id="year2" name="year" required>

            <label for="airline">Aerolinea:</label>
            <input type="text" class="form-control" id="airline2" name="airline" required>

            <label for="code">Codigo:</label>
            <input type="text" class="form-control" id="code2" name="code" required>

            <label for="passengers">Cantidad pasajeros:</label>
            <input type="text" class="form-control" id="passengers2" name="passengers" required>

            <label for="capacity">Capacidad(Kg):</label>
            <input type="text" class="form-control" id="capacity2" name="capacity" required>

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
      var dato8 = fila.find('td:eq(7)').text(); // Obtener el septimo dato de la fila
     
      // Actualizar los campos del modal con los datos obtenidos
      $('#id').val(dato1);
      $('#serie2').val(dato2)
      $('#model2').val(dato3)
      $('#year2').val(dato4)
      $('#airline2').val(dato5)
      $('#code2').val(dato6)
      $('#passengers2').val(dato7)
      $('#capacity2').val(dato8)

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