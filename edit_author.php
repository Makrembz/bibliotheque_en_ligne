<?php
// Database connection
$host = 'localhost';
$dbname = 'bibliotheque';  // Your database name
$username = 'root';        // Your database username
$password = '';            // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if id is set and fetch the author details
    if (isset($_GET['id'])) {
        $author_id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM auteurs WHERE id = ?");
        $stmt->execute([$author_id]);
        $author = $stmt->fetch(PDO::FETCH_ASSOC);

        // If no author is found, exit and show an error message
        if (!$author) {
            echo "Author not found!";
            exit;
        }
    } else {
        echo "No author id provided!";
        exit;
    }

    // Update author details after form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nom = $_POST['nom'];
        $biographie = $_POST['biographie'];
        $photo = $_FILES['photo']['name'];

        // Handle photo update
        if ($photo) {
            move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/".$photo);
            // Delete old photo if new one is uploaded
            if ($author['photo'] && file_exists("uploads/".$author['photo'])) {
                unlink("uploads/".$author['photo']);
            }
        } else {
            $photo = $author['photo'];  // Retain the old photo if not changed
        }

        // Update author in the database
        $stmt = $pdo->prepare("UPDATE auteurs SET nom = ?, biographie = ?, photo = ? WHERE id = ?");
        $stmt->execute([$nom, $biographie, $photo, $author_id]);

        echo "Author updated successfully!";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!-- Form to edit author -->
<form action="edit_author.php?id=<?= $author['id'] ?>" method="post" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="nom" value="<?= htmlspecialchars($author['nom']) ?>" required><br>

    <label>Biography:</label>
    <textarea name="biographie"><?= htmlspecialchars($author['biographie']) ?></textarea><br>

    <label>Photo:</label>
    <?php if (!empty($author['photo'])): ?>
        <img src="uploads/<?= htmlspecialchars($author['photo']) ?>" width="100" alt="Author Photo"><br>
    <?php endif; ?>
    <input type="file" name="photo"><br>

    <input type="submit" value="Update Author">
</form>
