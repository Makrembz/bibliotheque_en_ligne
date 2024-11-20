<?php
// Database connection
$host = 'localhost';
$dbname = 'bibliotheque';  // Your database name
$username = 'root';        // Your database username
$password = '';            // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get data from form
        $nom = $_POST['nom'];
        $biographie = $_POST['biographie'];
        $photo = $_FILES['photo']['name'];
        
        // Handle file upload for photo
        if ($photo) {
            move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/".$photo);
        }

        // Insert author into the database
        $stmt = $pdo->prepare("INSERT INTO auteurs (nom, biographie, photo) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $biographie, $photo]);

        echo "Author added successfully!";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!-- HTML form to add new author -->
<form action="add_author.php" method="post" enctype="multipart/form-data">
    <label>Name:</label><input type="text" name="nom" required><br>
    <label>Biography:</label><textarea name="biographie"></textarea><br>
    <label>Photo:</label><input type="file" name="photo"><br>
    <input type="submit" value="Add Author">
</form>
