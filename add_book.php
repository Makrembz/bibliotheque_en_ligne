<?php
// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=Bibliotheque", "root", "");

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $genre = $_POST['genre'];
    $auteur_id = $_POST['auteur_id'];
    $disponibilite = isset($_POST['disponibilite']) ? 1 : 0;

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO Livres (titre, genre, auteur_id, disponibilite) VALUES (?, ?, ?, ?)");
    $stmt->execute([$titre, $genre, $auteur_id, $disponibilite]);

    echo "Book added successfully!";
}
?>