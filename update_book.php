<?php
// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=Bibliotheque", "root", "");

// Update book information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $genre = $_POST['genre'];
    $auteur_id = $_POST['auteur_id'];
    $disponibilite = isset($_POST['disponibilite']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE Livres SET titre = ?, genre = ?, auteur_id = ?, disponibilite = ? WHERE id = ?");
    $stmt->execute([$titre, $genre, $auteur_id, $disponibilite, $id]);

    echo "Book updated successfully!";
}
?>