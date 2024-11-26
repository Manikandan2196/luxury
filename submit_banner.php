<?php
header('Content-Type: application/json');

// Validate inputs
if (!isset($_POST['file_name'], $_POST['project_id'], $_POST['alt_text'], $_FILES['banner_image'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid form data']);
    exit;
}

$file_name = $_POST['file_name'];
$project_id = $_POST['project_id'];
$alt_text = $_POST['alt_text'];
$image = $_FILES['banner_image'];

// Check if file is an image
if (!getimagesize($image['tmp_name'])) {
    echo json_encode(['status' => 'error', 'message' => 'Uploaded file is not a valid image']);
    exit;
}

// Get image details
$image_info = getimagesize($image['tmp_name']);
$image_width = $image_info[0]; // Width
$image_height = $image_info[1]; // Height
$file_format = $image_info['mime']; // MIME type (e.g., image/jpeg)
$file_size = $image['size']; // File size in bytes

// Save image
$upload_dir = 'uploads/banners/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}
$image_path = $upload_dir . basename($image['name']);

if (move_uploaded_file($image['tmp_name'], $image_path)) {
    // Save banner details to the database
    $conn = new mysqli('localhost', 'username', 'password', 'database');
    if ($conn->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
        exit;
    }

    $stmt = $conn->prepare("
        INSERT INTO banners (file_name, project_id, alt_text, image_path, file_size, image_width, image_height, file_format)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param('sissiiis', $file_name, $project_id, $alt_text, $image_path, $file_size, $image_width, $image_height, $file_format);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Banner added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save banner']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to upload image']);
}
?>
