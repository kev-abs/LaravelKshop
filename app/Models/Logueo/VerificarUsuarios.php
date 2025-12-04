<?php
class VerificarUsuarios {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function loginCliente($correo) {
        $sql = "SELECT ID_Cliente, Nombre, Contrasena FROM Cliente WHERE Correo = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->num_rows === 1 ? $resultado->fetch_assoc() : null;
    }

    public function loginEmpleado($correo) {
        $sql = "SELECT ID_Empleado, Nombre, Contrasena, Cargo FROM Empleado WHERE Correo = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->num_rows === 1 ? $resultado->fetch_assoc() : null;
    }
}
