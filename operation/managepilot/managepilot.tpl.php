<?php
include_once 'c_managepilot.php';
$controller = new ManagePilotController();
$pilots = $controller->getPilot();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar pilotos</title>
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

  <div class="container-fluid mt-5 ">
    <h2>Gestionar pilotos</h2>
    <hr>
    <table id="grid" class="table table-striped table-bordered table-light" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Fecha nacimiento</th>
          <th>Nacionalidad</th>
          <th>Fecha creacion</th>
          <th>Telefono</th>
          <th>Email</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($pilots as $pilot) : ?>
          <tr>

            <td><?php echo $pilot['plto_id']; ?></td>
            <td><?php echo $pilot['plto_nombre']; ?></td>
            <td><?php echo $pilot['plto_fechanacimiento']; ?></td>
            <td><?php echo $pilot['plto_nacionalidad']; ?></td>
            <td><?php echo $pilot['plto_fechacreacion']; ?></td>
            <td><?php echo $pilot['plto_telefono']; ?></td>
            <td><?php echo $pilot['plto_email']; ?></td>
            
            <td>
              <button type="button" class="btn btn-info btn-sm btnm" data-toggle="modal" data-target="#editModal"><i class="fa-regular fa-pen-to-square"></i></button>
              
              <a href="#"  class="btn btn-light btn-sm" onclick="confirmarDelete('<?php echo $pilot['plto_id']; ?>')"><i class="fa-regular fa-trash-can"></i></a>
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
        <h5 class="modal-title" id="addModalLabel">Agregar Piloto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="../managepilot/managepilot.php?modo=createPilot" method="post" >
          <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" required>

            <label for="birthdate">Fecha nacimiento:</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" required>


            <label for="nationality">Nacionalidad:</label>
            <input type="text" class="form-control" id="nationality" name="nationality" required>

            <label for="phone">Telefono:</label>
            <input type="number" class="form-control" id="phone" name="phone" required>

            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" required>
            
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
        <h5 class="modal-title" id="editModalLabel">Modificar Piloto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="../managepilot/managepilot.php?modo=updatePilot" method="post">
         <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name2" name="name" required>

            <label for="birthdate">Fecha nacimiento:</label>
            <input type="date" class="form-control" id="birthdate2" name="birthdate" required>

            <label for="nationality">Nacionalidad:</label>
            <input type="text" class="form-control" id="nationality2" name="nationality" required>

            <label for="phone">Telefono:</label>
            <input type="number" class="form-control" id="phone2" name="phone" required>

            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email2" name="email" required>

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
      var dato6 = fila.find('td:eq(5)').text(); // Obtener el sexto dato de la fila
      var dato7 = fila.find('td:eq(6)').text(); // Obtener el septimo dato de la fila
     
      // Actualizar los campos del modal con los datos obtenidos
      $('#id').val(dato1);
      $('#name2').val(dato2);
      $('#birthdate2').val(dato3);
      $('#nationality2').val(dato4);
      $('#phone2').val(dato6);
      $('#email2').val(dato7);
    });

  });

 
  function confirmarDelete(valor) {
      if (confirm("¿Estás seguro de eliminar el piloto?")) {
          window.location.href = "../managepilot/managepilot.php?modo=deletePilot&id=" + valor;
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