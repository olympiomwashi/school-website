<?php
require 'db_connect.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['staffNumber'])) {
    echo json_encode(["message" => "Invalid request"]);
    exit;
}

$db = getDBConnection();
$collection = $db->staff;
$deleteResult = $collection->deleteOne(['staffNumber' => $data['staffNumber']]);

if ($deleteResult->getDeletedCount() > 0) {
    echo json_encode(["message" => "Staff member deleted successfully"]);
} else {
    echo json_encode(["message" => "Staff member not found"]);
}
?>