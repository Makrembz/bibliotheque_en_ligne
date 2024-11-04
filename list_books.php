<?php
// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=Bibliotheque", "root", "");

// Fetch all books
$stmt = $pdo->query("SELECT Livres.*, Auteurs.nom AS auteur_nom FROM Livres JOIN Auteurs ON Livres.auteur_id = Auteurs.id");
$books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book List</title>
</head>
<body>
    <h2>Book List</h2>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Genre</th>
            <th>Author</th>
            <th>Availability</th>
            <th>Return Date</th>
        </tr>
        <?php foreach ($books as $book): ?>
        <tr>
            <td><?= htmlspecialchars($book['titre']) ?></td>
            <td><?= htmlspecialchars($book['genre']) ?></td>
            <td><?= htmlspecialchars($book['auteur_nom']) ?></td>
            <td><?= $book['disponibilite'] ? "Available" : "Borrowed" ?></td>
            <td><?= $book['date_retour'] ?? "N/A" ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>