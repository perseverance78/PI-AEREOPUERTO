<?php
include_once 'c_manageusers.php';
$controller = new ManageUsersController();
$rol = $_SESSION['rol'];
$id = $_SESSION['user'];
if ($rol == 1) {
  $users = $controller->getUser();
}else{
  $users = $controller->getUserById($id);
}
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
    <h2>Gestionar usuarios</h2>
    <hr>
    <table id="grid" class="table table-striped table-bordered table-primary" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Contraseña</th>
          <th>Usuario</th>
          <th>Email</th>
          <th>Rol</th>
          <th>Fecha Creacion</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user) : ?>
          <tr>
            <td><?php echo $user['sro_id']; ?></td>
            <td><?php echo $user['sro_nombre']; ?></td>
            <td><?php echo $user['sro_password']; ?></td>
            <td><?php echo $user['sro_user']; ?></td>
            <td><?php echo $user['sro_email']; ?></td>
            <td><?php echo $user['rol_nombre']; ?></td>
            <td><?php echo $user['sro_fechacreacion']; ?></td>
            <td>
              <button type="button" class="btn btn-info btn-sm btnm" data-toggle="modal" data-target="#editModal"><i class="fa-regular fa-pen-to-square"></i></button>
              <!-- <button type="button" class="btn btn-danger btn-sm">Eliminar</button> -->
              <?php if($rol == 1): ?>
                <a href="#"  class="btn btn-light btn-sm" onclick="confirmarDelete('<?php echo $user['sro_id']; ?>')"><i class="fa-regular fa-trash-can"></i></a>
              <?php endif; ?>
            </td>
          </tr>

  </div>
<?php endforeach; ?>
</tbody>
</table>
<?php if($rol == 1): ?>
  <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Agregar</button>
<?php endif; ?>
</div>


<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="../manageusers/manageusers.php?modo=createUser" method="post" onsubmit="return validar();">
          <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre2" name="name" required>

            <label for="user">Usuario:</label>
            <input type="text" class="form-control" id="user2" name="user" required>

            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password2" name="password" required>

            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email2" name="email" required>
            
            <label for="rol">Rol:</label>
            <select class="form-select" name="rol" required aria-label="Default select example">
              <option value=1>ADMIN</option>
              <option value=2>PASAJERO</option>
            </select>
           
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
        <h5 class="modal-title" id="editModalLabel">Modificar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="../manageusers/manageusers.php?modo=updateUser" method="post">
          <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="name" required>

            <label for="password">Contraseña:</label>
            <input type="text" class="form-control" id="password" name="pass" required>

            <label for="user">Usuario:</label>
            <input type="text" class="form-control" id="user" name="user" required>

            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>

            <?php if($rol == 1): ?>
                <label for="rol">Rol:</label>
                <select class="form-select" name="rol" required aria-label="Default select example">
                  <option value=1>ADMIN</option>
                  <option value=2>PASAJERO</option>
                </select>
            <?php endif; ?>

            <input type="hidden" id="id" name="id" value ="{id}">
          </div>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://kit.fontawesome.com/27552c5f41.js" crossorigin="anonymous"></script>

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

    $('#grid').DataTable();

    // Habilitar el botón de modificar al seleccionar una fila
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
      var dato3 = fila.find('td:eq(2)').text(); // Obtener el segundo dato de la fila
      var dato4 = fila.find('td:eq(3)').text(); // Obtener el tercer dato de la fila
      var dato5 = fila.find('td:eq(4)').text(); // Obtener el cuarto dato de la fila
      
      // Actualizar los campos del modal con los datos obtenidos
      $('#id').val(dato1);
      $('#nombre').val(dato2);
      $('#password').val(dato3);
      $('#user').val(dato4);
      $('#email').val(dato5);
    });

  });


  function confirmarDelete(valor) {
      if (confirm("¿Estás seguro de eliminar el usuario?")) {
          window.location.href = "../manageusers/manageusers.php?modo=deleteUser&id=" + valor;
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