<?php
class ClienteService {
    private $apiUrl;

    public function __construct() {
        global $urlCliente;
        $this->apiUrl = $urlCliente;
    }

    public function obtenerClientes() {

        $context = stream_context_create([
            "http" => [
                "method" => "GET",
                "header" => "Content-Type: application/json"
            ]
        ]);
        $respuesta = file_get_contents($this->apiUrl, false, $context);
        if ($respuesta === FALSE) return [];

        // Decodificar JSON
        $lineas = json_decode($respuesta, true);
        if (!is_array($lineas)) return [];

        $clientes = [];
        foreach ($lineas as $linea) {
            $clientes[] = [
                    "ID_Cliente"     => $linea["idCliente"]     ?? null,
                    "Nombre"         => $linea["nombre"]        ?? null,
                    "Correo"         => $linea["correo"]        ?? null,
                    "Contrasena"     => $linea["contrasena"]    ?? null,
                    "Fecha_Registro" => $linea["fechaRegistro"] ?? null,
                    "Estado"         => $linea["estado"]        ?? null,
                    "Documento"      => $linea["documento"]     ?? null,
                    "Telefono"       => $linea["telefono"]      ?? null
                ];
            }
            return $clientes;
        }
        


    public function agregarCliente($nombre, $correo, $contrasena, $documento, $telefono, $estado) {

        $hash = password_hash($contrasena, PASSWORD_BCRYPT);

        $datos = [
            "nombre"     => $nombre,
            "correo"     => $correo,
            "contrasena" => $hash,
            "documento"  => $documento,
            "telefono"   => $telefono,
            "estado"     => $estado
        ];
        return $this->enviarPeticion("POST", $this->apiUrl, $datos);
    }

    public function actualizarCliente($id, $nombre, $correo, $contrasena, $telefono, $documento, $estado) {

        $hash = password_hash($contrasena, PASSWORD_BCRYPT);

        $datos = [
            "nombre"     => $nombre,
            "correo"     => $correo,
            "contrasena" => $hash,
            "documento"  => $documento,
            "telefono"   => $telefono,
            "estado"     => $estado
        ];
        return $this->enviarPeticion("PUT", $this->apiUrl . "/$id", $datos);
    }

    public function eliminarCliente($id) {
        return $this->enviarPeticion("DELETE", $this->apiUrl . "/$id");
    }

    private function enviarPeticion($metodo, $url, $datos = null) {
        $proceso = curl_init($url);
        curl_setopt($proceso, CURLOPT_CUSTOMREQUEST, $metodo);
        curl_setopt($proceso, CURLOPT_RETURNTRANSFER, true);

        $headers = [
            "Content-Type: application/json",
            "header" => "Content-Type: application/json"
        ];

        if ($datos) {
            $jsonData = json_encode($datos);
            curl_setopt($proceso, CURLOPT_POSTFIELDS, $jsonData);
            $headers[] = 'Content-Length: ' . strlen($jsonData);
        }

        curl_setopt($proceso, CURLOPT_HTTPHEADER, $headers);

        $res = curl_exec($proceso);
        $http_code = curl_getinfo($proceso, CURLINFO_HTTP_CODE);

        if ($res === false) {
            $error = curl_error($proceso);
            curl_close($proceso);
            return [
                "success" => false,
                "error"   => "cURL error: $error",
                "response"=> null
            ];
        }

        curl_close($proceso);

        return [
            "success" => ($http_code >= 200 && $http_code < 300),
            "error"   => ($http_code >= 200 && $http_code < 300) ? null : "HTTP $http_code",
            "response"=> $res
        ];
    }
}
