<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require __DIR__ . '/../../config/db.php'; // Ajustar si es necesario
$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        get();
        break;
    case 'POST':
        post();
        break;
    case 'PUT':
        update();
        break;
    case 'DELETE':
        delete();
        break;
    default:
        echo json_encode(["error" => "Método no permitido"]);
}
//OK
function get() {
    global $conn;

    $cliente_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($cliente_id > 0) {
        $query = "SELECT * FROM imagenes where fk_multimedia=?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $cliente_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            // Convertir la imagen a Base64 si existe
            if (!empty($row['multimedia'])) {
                $row['multimedia'] = "data:image/jpeg;base64," . base64_encode($row['multimedia']);
            } else {
                $row['multimedia'] = null; // Si no hay imagen, devuelve null
            }
            $data[] = $row;
        }
    
    
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "ID inválido"]);
    }
}
?>
