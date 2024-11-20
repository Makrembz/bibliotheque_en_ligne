<?php
// Database connection
$host = 'localhost';
$dbname = 'bibliotheque';  // Your database name
$username = 'root';        // Your database username
$password = '';            // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all authors
    $stmt = $pdo->query("SELECT * FROM auteurs");
    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($authors) {
        echo "<h2>Authors List</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Name</th>
                    <th>Biography</th>
                    <th>Photo</th>
                    <th>Books</th>
                    <th>Actions</th>
                </tr>";
        
        foreach ($authors as $author) {
            // Fetch books by the current author
            $stmt_books = $pdo->prepare("SELECT titre FROM livres WHERE auteur_id = ?");
            $stmt_books->execute([$author['id']]);
            $books = $stmt_books->fetchAll(PDO::FETCH_ASSOC);
            
            $books_list = '';
            foreach ($books as $book) {
                $books_list .= $book['titre'] . "<br>";
            }

            echo "<tr>
                    <td>{$author['nom']}</td>
                    <td>{$author['biographie']}</td>
                    <td><img src='uploads/{$author['photo']}' width='100'></td>
                    <td>{$books_list}</td>
                    <td>
                        <a href='edit_author.php?id={$author['id']}'>Edit</a> |
                        <a href='delete_author.php?id={$author['id']}'>Delete</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No authors found!";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
