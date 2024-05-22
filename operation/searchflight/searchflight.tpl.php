<?php
include_once '../manageflight/c_manageflight.php';
include_once 'c_searchflight.php';
$controller = new ManageFlightController();
$flights = $controller->getFlight('ALL');


$searchFlight = new SearchFlightController();
$reserves = $searchFlight->getReserveById($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestionar vuelos</title>
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
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }


    div.dataTables_filter {
      display: none;
     


    }

    div.dataTables_wrapper input[type="search"] {
      display: none;
     
    }

    h2 {
      text-align: center;
    }

    .search-container {
      background-color: #007BFF;
      padding: 20px;
      border-radius: 15px;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .search-container label {
      color: white;
      margin-right: 10px;
      margin-bottom: 5px;
      display: block;
    }

    .search-container .search-field {
      display: flex;
      flex-direction: column;
      margin-bottom: 10px;
    }

    .search-container input {
      width: 150px;
      /* Ancho fijo */
      padding: 5px;
      border: none;
      border-bottom: 2px solid white;
      /* Línea debajo del input */
      background-color: transparent;
      color: white;
      outline: none;
    }

    .search-container input::placeholder {
      color: #b3d7ff;
    }

    table {
      width: 100%;
    }
  </style>

</head>

<body>

  <div class="container-fluid mt-5">
    <h2>Buscar vuelos</h2>
    <hr>
    <div class="search-container">
        <div class="search-field">
            <label for="minDate">Fecha desde:</label>
            <input type="text" id="minDate" placeholder="YYYY-MM-DD">
        </div>
        <div class="search-field">
            <label for="maxDate">Fecha hasta:</label>
            <input type="text" id="maxDate" placeholder="YYYY-MM-DD">
        </div>
        <div class="search-field">
            <label for="search3">Origen:</label>
            <input type="text" id="search3" placeholder="Buscar origen">
        </div>
        <div class="search-field">
            <label for="search4">Destino:</label>
            <input type="text" id="search4" placeholder="Buscar destino">
        </div>
    </div>
    <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Agregar</button> -->
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
              <button type="button" class="btn btn-info btn-sm btnm" data-toggle="modal" data-target="#editModal">Reservar <i class="fa-solid fa-ticket"></i></button>
            </td>



          </tr>


        <?php endforeach; ?>

      </tbody>
    </table>
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#searchReserve">Consultar mis reservas</button>
    <!-- <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#searchFlight">Filtrar vuelos</button> -->
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
              <input type="date" class="form-control" id="departuredate" name="departuredate" required>

              <label for="departuretime">Hora salida:</label>
              <input type="time" class="form-control" id="departuretime" name="departuretime" required>

              <label for="origin">Origen:</label>
              <input type="text" class="form-control" id="origin" name="origin" required>

              <label for="destination">Destino:</label>
              <input type="text" class="form-control" id="destination" name="destination" required>

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

  <div class="modal fade" id="searchFlight" tabindex="-1" role="dialog" aria-labelledby="searchFlightLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Mis reservas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="container mt-4">
          <form class="text-center" action="searchflight/searchflight.php?modo=searchFlight" method="post">
            <div class="form-group">
              <label for="fechaDesde">Desde:</label>
              <input type="date" class="form-control mb-2" id="fechaDesde" required name="fechaDesde" style="width: 150px; margin: 0 auto;">
            </div>
            <div class="form-group">
              <label for="fechaHasta">Hasta:</label>
              <input type="date" class="form-control mb-2" id="fechaHasta" required name="fechaHasta" style="width: 150px; margin: 0 auto;">
            </div>
            <div class="form-group">
              <label for="origen">Origen:</label>
              <input type="text" class="form-control mb-2" id="origen" name="origen" style="width: 150px; margin: 0 auto;">
            </div>
            <div class="form-group">
              <label for="destino">Destino:</label>
              <input type="text" class="form-control mb-2" id="destino" name="destino" style="width: 150px; margin: 0 auto;">
            </div>
            <button type="submit" class="btn btn-primary mb-5 btn-block">Consultar vuelos</button>
          </form>
        </div>
        <div class="modal-body">

          <table class="table table-striped table-bordered">
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

  <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
  <script>
    $(document).ready(function() {
      // Habilitar el botón de modificar al seleccionar una fila
      var table = $('#grid').DataTable();

      $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {

          var search3 = $('#search3').val().toLowerCase();
          var search4 = $('#search4').val().toLowerCase();
          var minDate = $('#minDate').val();
          var maxDate = $('#maxDate').val();
          var date = data[1] || "";
          // Filtro de rango de fechas
          if (minDate && new Date(date) < new Date(minDate)) {
            return false;
          }
          if (maxDate && new Date(date) > new Date(maxDate)) {
            return false;
          }

          // Filtros de texto
          if (data[5].toLowerCase().indexOf(search3) === -1 ||
            data[6].toLowerCase().indexOf(search4) === -1) {
            return false;
          }

          return true;
        }
      );

      // Event listeners para inputs de búsqueda
      $('#search3, #search4').on('keyup', function() {
        table.draw();
      });

      $('#minDate, #maxDate').on('change', function() {
        table.draw();
      });

      // Configuración para los inputs de fecha usando DateTime picker
      var minDatePicker = new DateTime($('#minDate'), {
        format: 'YYYY-MM-DD'
      });
      var maxDatePicker = new DateTime($('#maxDate'), {
        format: 'YYYY-MM-DD'
      });


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


    function validar() {
      let validar = validarDatos()
      console.log(validar)
      if (!validar) {
        return false
      }
      return true
    }

    //Validar formulario 
    function validarDatos() {
      let msj1 = "Lo siento, debe diligenciar todos los campos obligatorios."
      let msj2 = "Por favor digite los siguientes campos:"
      let campos = ''

      let nombre = $("#nombre2").val()
      console.log(nombre)
      if (nombre == '') {
        campos += '&#9679; ' + 'Nombre' + '</br>';
      }


      if ($.trim(campos) != '') {
        var alert = (msj1 + '<br/>' + msj2 + '<br/><br/>' + campos + '<br/>')
        cons
        $.toast({
          heading: '::AIR::',
          text: alert,
          showHideTransition: 'plain',
          icon: 'info',
          stack: false,
          position: 'top-center',
          hideAfter: 3000
        });
        event.preventDefault();
        return false;

      } else {
        return true;
      }
    }
  </script>

</body>

</html>