<?php
//connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PerfprofESGAE";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Message de confirmation en cas de succès
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        $errors['username'] = "Le nom d'utilisateur est requis.";
    }

    if (empty($password)) {
        $errors['password'] = "Le mot de passe est requis.";
    }

    if (empty($errors)) {
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        try {
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                echo "Connexion réussie";
                // Rediriger vers une autre page ou démarrer une session
            } else {
                $errors['login'] = "Nom d'utilisateur ou mot de passe incorrect";
            }
        } catch (PDOException $e) {
            $errors['login'] = "Erreur SQL : " . $e->getMessage();
        }
    }
}
?>
