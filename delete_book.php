<?php
// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=Bibliotheque", "root", "");

// Delete book based on ID
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM Livres WHERE id = ?");
    $stmt->execute([$_GET['id']]);

    echo "Book deleted successfully!";
}
?>