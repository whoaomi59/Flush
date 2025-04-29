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
    default:
        echo json_encode(["error" => "Método no permitido"]);
}
//OK
function get() {
    global $conn;
    $result = $conn->query("SELECT d.id,d.nombre,i.multimedia,d.Tipo,d.contacto FROM `datos` d LEFT JOIN imagenes i ON i.fk_multimedia=d.id GROUP BY d.id DESC;");

    $empresas = [];

    while ($row = $result->fetch_assoc()) {
        // Convertir la imagen a Base64 si existe
        if (!empty($row['multimedia'])) {
            $row['multimedia'] = "data:image/jpeg;base64," . base64_encode($row['multimedia']);
        } else {
            $row['multimedia'] = null; // Si no hay imagen, devuelve null
        }
        $empresas[] = $row;
    }

    echo json_encode($empresas);
}

function post() {
    global $conn;
        $usuario_id = $_POST["usuario_id"] ?? null;
        $categoria_id = $_POST["categoria_id"] ?? null;
        $nombre = $_POST["nombre"] ?? null;
        $direccion = $_POST["direccion"] ?? null;
        $telefono = $_POST["telefono"] ?? null;
        $ApiKey = $_POST["ApiKey"] ?? null;
        $email = $_POST["email"] ?? null;
        $horario_inicial = $_POST["Horario_inicial"] ?? null;
        $horario_final = $_POST["Horario_final"] ?? null;

        if ( !$categoria_id || !$nombre || !$direccion || !$telefono || !$email || !$horario_inicial || !$horario_final) {
            echo json_encode(["error" => "Faltan datos obligatorios"]);
            return;
        }

        if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] === UPLOAD_ERR_OK) {
            $logo = file_get_contents($_FILES["logo"]["tmp_name"]); // Leer imagen binaria
        } else {
            echo json_encode(["error" => "Error al subir la imagen", "file_error" => $_FILES["logo"]["error"] ?? "Archivo no enviado"]);
            return;
        }

    $stmt = $conn->prepare("INSERT INTO negocios (usuario_id, categoria_id, nombre, direccion, telefono,ApiKey, email, Horario_inicial, Horario_final, logo) 
                            VALUES (?, ?, ?, ?, ?, ?,?, ?, ?, ?)");

    if (!$stmt) {
            echo json_encode(["error" => "Error en la consulta", "mysqli_error" => $conn->error]);
    return;
    }
        $stmt->bind_param("iissssssss", 
            $usuario_id, 
            $categoria_id, 
            $nombre, 
            $direccion, 
            $telefono,
            $ApiKey, 
            $email, 
            $horario_inicial, 
            $horario_final, 
            $logo
        );
    if ($stmt->execute()) {
            echo json_encode(["message" => "Registro creado con imagen"]);
    } else {
            echo json_encode(["error" => "Error al insertar datos", "mysqli_error" => $stmt->error]);
    }

    $stmt->close();
}

function update() {
    global $conn;
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);

    if (!isset($data['id']) || !isset($data['estado'])) {
        echo json_encode(["error" => "Faltan parámetros requeridos (id o estado)", "debug" => $data]);
        return;
    }
    $id = $data['id'];
    $estado = $data['estado'];
    $stmt = $conn->prepare("UPDATE negocios SET estado = ? WHERE id = ?");
    if (!$stmt) {
        echo json_encode(["error" => "Error al preparar la consulta", "mysqli_error" => $conn->error]);
        return;
    }

    $stmt->bind_param("ii", $estado, $id);
    if ($stmt->execute()) {
        echo json_encode(["message" => "Estado actualizado correctamente"]);
    } else {
        echo json_encode(["error" => "Error al actualizar estado", "mysqli_error" => $stmt->error]);
    }
    $stmt->close();
}
?>
