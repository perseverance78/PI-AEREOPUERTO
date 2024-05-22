<?php
include_once 'c_managereserve.php';
$controller = new ManageReserveController();
$reserves = $controller->getReserve();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar reservas</title>
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
    <h2>Gestionar reservas</h2>
    <hr>
    
    <table id="grid" class="table  table-bordered table-light" style="width:100%">
      <thead >
        <tr>
          <th>ID</th>
          <th>Usuario</th>
          <th>Total pasajeros</th>
          <th>Origen</th>
          <th>Destino</th>
          <th>Numero vuelo</th>
          <th>Estado reserva</th>
          <th>Precio</th>
          <th>Fecha reserva</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($reserves as $reserve) : ?>
          <tr>
          
            <td><?php echo $reserve['rsva_id']; ?></td>
            <td><?php echo $reserve['sro_nombre']; ?></td>
            <td><?php echo $reserve['rsva_totalpasajeros']; ?></td>
            <td><?php echo $reserve['rsva_origen']; ?></td>
            <td><?php echo $reserve['rsva_destino']; ?></td>
            <td><?php echo $reserve['vlso_id']; ?></td>
            <td><?php echo $reserve['rsva_estado']; ?></td>
            <td><?php echo $reserve['rsva_precio']; ?></td>
            <td><?php echo $reserve['rsva_fechacreacion']; ?></td>
            
            <td>
            <a href="#"  class="btn btn-primary btn-sm" onclick="confirmarAprobar('<?php echo $reserve['rsva_id']; ?>')"><i class="fa-solid fa-check"></i></a>
              
            <a href="#"  class="btn btn-light btn-sm" onclick="confirmarRechazo('<?php echo $reserve['rsva_id']; ?>')"><i class="fa-solid fa-x"></i></a>
            </td>
          </tr>

        
      <?php endforeach; ?>
       
      </tbody>
</table>

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

 
  function confirmarAprobar(valor) {
      if (confirm("¿Desea aprobar la reserva?")) {
          window.location.href = "../managereserve/managereserve.php?modo=manageReserve&manage=APROBADA&id=" + valor;
      }
  }
  function confirmarRechazo(valor) {
      if (confirm("¿Desea rechazar la reserva")) {
          window.location.href = "../managereserve/managereserve.php?modo=manageReserve&manage=RECHAZADA&id=" + valor;
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