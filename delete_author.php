<?php
// Database connection
$host = 'localhost';
$dbname = 'bibliotheque';  // Your database name
$username = 'root';        // Your database username
$password = '';            // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Delete author and related books
    if (isset($_GET['id'])) {
        $author_id = $_GET['id'];

        // Delete all books written by this author
        $stmt = $pdo->prepare("DELETE FROM livres WHERE auteur_id = ?");
        $stmt->execute([$author_id]);

        // Delete the author
        $stmt = $pdo->prepare("DELETE FROM auteurs WHERE id = ?");
        $stmt->execute([$author_id]);

        echo "Author and related books deleted successfully!";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
