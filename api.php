<?php
include_once 'db.php';
include_once 'vehiculo.php';

$database = new Database();
$db = $database->getConnection();

$vehiculo = new vehiculo($db);

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $vehiculo->idvehiculo = $_GET['id'];
            $stmt = $vehiculo->buscarPorId();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo json_encode($row);
            } else {
                echo json_encode(array("message" => "Vehículo no encontrado."));
            }
        } else {
            $stmt = $vehiculo->leer();
            $vehiculos_arr = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($vehiculos_arr, $row);
            }
            echo json_encode($vehiculos_arr);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));

        if (!$data) {
            echo json_encode(array("message" => "No se recibieron datos o el formato es incorrecto."));
            exit;
        }

        $vehiculo->idcolor = $data->idcolor;
        $vehiculo->idmarca = $data->idmarca;
        $vehiculo->modelo = $data->modelo;
        $vehiculo->chasis = $data->chasis;
        $vehiculo->motor = $data->motor;
        $vehiculo->nombre = $data->nombre;
        $vehiculo->carnet = $data->carnet ?? '';
        $vehiculo->activo = $data->activo;

        if ($vehiculo->crear()) {
            echo json_encode(array("message" => "Vehículo creado."));
        } else {
            echo json_encode(array("message" => "Error al crear vehículo."));
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));

        if (!$data || !isset($data->idvehiculo)) {
            echo json_encode(array("message" => "ID del vehículo faltante o datos incorrectos."));
            exit;
        }

        $vehiculo->idvehiculo = $data->idvehiculo;
        $vehiculo->idcolor = $data->idcolor ?? null;
        $vehiculo->idmarca = $data->idmarca ?? null;
        $vehiculo->modelo = $data->modelo ?? null;
        $vehiculo->chasis = $data->chasis ?? null;
        $vehiculo->motor = $data->motor ?? null;
        $vehiculo->nombre = $data->nombre ?? null;
        $vehiculo->carnet = $data->carnet ?? '';
        $vehiculo->activo = $data->activo ?? null;

        if ($vehiculo->actualizar()) {
            echo json_encode(array("message" => "Vehículo actualizado."));
        } else {
            echo json_encode(array("message" => "Error al actualizar el vehículo."));
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"));

        if (!$data || !isset($data->idvehiculo)) {
            echo json_encode(array("message" => "ID del vehículo faltante o datos incorrectos."));
            exit;
        }

        $vehiculo->idvehiculo = $data->idvehiculo;

        if ($vehiculo->eliminar()) {
            echo json_encode(array("message" => "Vehículo eliminado."));
        } else {
            echo json_encode(array("message" => "Error al eliminar el vehículo."));
        }
        break;

    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
?>
