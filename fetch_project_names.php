<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'username', 'password', 'database');

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit;
}

// Fetch project details
$sql = "SELECT id, project_name FROM project_details";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $projects = [];
    while ($row = $result->fetch_assoc()) {
        $projects[] = ['id' => $row['id'], 'name' => $row['project_name']];
    }
    echo json_encode(['status' => 'success', 'projects' => $projects]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No projects found']);
}

$conn->close();
?>
