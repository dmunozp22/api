<?php
class vehiculo {
    private $conn;
    private $table_name = "vehiculos";

    public $idvehiculo;
    public $idcolor;
    public $idmarca;
    public $modelo;
    public $chasis;
    public $motor;
    public $nombre;
    public $carnet;
    public $activo;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Función para crear un nuevo vehículo
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET
            idcolor=:idcolor, idmarca=:idmarca, modelo=:modelo, chasis=:chasis, motor=:motor, nombre=:nombre, carnet=:carnet, activo=:activo";
        
        $stmt = $this->conn->prepare($query);

        $this->idcolor = htmlspecialchars(strip_tags($this->idcolor));
        $this->idmarca = htmlspecialchars(strip_tags($this->idmarca));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->chasis = htmlspecialchars(strip_tags($this->chasis));
        $this->motor = htmlspecialchars(strip_tags($this->motor));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->carnet = htmlspecialchars(strip_tags($this->carnet));
        $this->activo = htmlspecialchars(strip_tags($this->activo));

        $stmt->bindParam(":idcolor", $this->idcolor);
        $stmt->bindParam(":idmarca", $this->idmarca);
        $stmt->bindParam(":modelo", $this->modelo);
        $stmt->bindParam(":chasis", $this->chasis);
        $stmt->bindParam(":motor", $this->motor);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":carnet", $this->carnet);
        $stmt->bindParam(":activo", $this->activo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Función para obtener todos los vehículos
    public function leer() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Función para buscar un vehículo por ID
    public function buscarPorId() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idvehiculo = :idvehiculo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idvehiculo', $this->idvehiculo);
        $stmt->execute();
        return $stmt;
    }

    // Función para actualizar un vehículo
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " 
                  SET idcolor = :idcolor, idmarca = :idmarca, modelo = :modelo, chasis = :chasis, 
                      motor = :motor, nombre = :nombre, carnet = :carnet, activo = :activo
                  WHERE idvehiculo = :idvehiculo";
    
        $stmt = $this->conn->prepare($query);
    
        $this->idcolor = htmlspecialchars(strip_tags($this->idcolor));
        $this->idmarca = htmlspecialchars(strip_tags($this->idmarca));
        $this->modelo = htmlspecialchars(strip_tags($this->modelo));
        $this->chasis = htmlspecialchars(strip_tags($this->chasis));
        $this->motor = htmlspecialchars(strip_tags($this->motor));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->carnet = htmlspecialchars(strip_tags($this->carnet));
        $this->activo = htmlspecialchars(strip_tags($this->activo));
        $this->idvehiculo = htmlspecialchars(strip_tags($this->idvehiculo));

        $stmt->bindParam(":idcolor", $this->idcolor);
        $stmt->bindParam(":idmarca", $this->idmarca);
        $stmt->bindParam(":modelo", $this->modelo);
        $stmt->bindParam(":chasis", $this->chasis);
        $stmt->bindParam(":motor", $this->motor);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":carnet", $this->carnet);
        $stmt->bindParam(":activo", $this->activo);
        $stmt->bindParam(":idvehiculo", $this->idvehiculo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Función para eliminar un vehículo
    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE idvehiculo = :idvehiculo";
    
        $stmt = $this->conn->prepare($query);
        $this->idvehiculo = htmlspecialchars(strip_tags($this->idvehiculo));
        $stmt->bindParam(":idvehiculo", $this->idvehiculo);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
