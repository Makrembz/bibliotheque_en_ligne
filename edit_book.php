<?php
// Database connection
$pdo = new PDO("mysql:host=localhost;dbname=Bibliotheque", "root", "");

// Fetch book details based on ID
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM Livres WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $book = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
</head>
<body>
    <h2>Edit Book</h2>
    <form action="update_book.php" method="post">
        <input type="hidden" name="id" value="<?= $book['id'] ?>">
        <label>Title:</label><input type="text" name="titre" value="<?= htmlspecialchars($book['titre']) ?>" required><br>
        <label>Genre:</label><input type="text" name="genre" value="<?= htmlspecialchars($book['genre']) ?>" required><br>
        <label>Author ID:</label><input type="number" name="auteur_id" value="<?= $book['auteur_id'] ?>" required><br>
        <label>Availability:</label><input type="checkbox" name="disponibilite" value="1" <?= $book['disponibilite'] ? "checked" : "" ?>><br>
        <input type="submit" value="Update Book">
    </form>
</body>
</html>