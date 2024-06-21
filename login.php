<?php
include('includes/database.php');
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Identifiants de l'administrateur en dur dans le code
    $admin_username = "admin";
    $admin_password = "admin123";

    // Vérifier si l'utilisateur est un administrateur
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['user_id'] = 0; // ID fictif pour l'admin
        header("Location: /admin/dashboard.php");
        exit();
    }

    // Vérifier si l'utilisateur est un élève
    try {
        $stmt = $conn->prepare("SELECT * FROM Élèves WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['ID_élève'];
            header("Location: /student/dashboard.php");
            exit();
        } else {
            $errors['login'] = "Nom d'utilisateur ou mot de passe incorrect";
        }
    } catch (PDOException $e) {
        $errors['login'] = "Erreur SQL : " . $e->getMessage();
    }

    // Vérifier si l'utilisateur est un professeur
    try {
        $stmt = $conn->prepare("SELECT * FROM Professeurs WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['ID_professeur'];
            header("Location: /teacher/dashboard.php");
            exit();
        } else {
            $errors['login'] = "Nom d'utilisateur ou mot de passe incorrect";
        }
    } catch (PDOException $e) {
        $errors['login'] = "Erreur SQL : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Connexion</title>

</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <main class="mr-6 ml-6 flex flex-col lg:flex-row gap-10 p-6 bg-white rounded-lg shadow-lg">
        <section class="flex flex-col justify-center items-center text-center lg:w-1/2 p-6 border-r border-gray-300">
            <img class="w-20 h-20" src="./assets/images/logo-esgae.png" alt="" srcset="">
            <h1 class="text-2xl font-bold mb-4">Bienvenue sur notre plateforme d'évaluation de performance des professeurs à l'ESGAE</h1>
            <p class="text-gray-700">Notre plateforme vise à améliorer la qualité de l'enseignement . Elle offre également des outils pour les professeurs pour auto-évaluer et améliorer leurs pratiques pédagogiques.</p>
        </section>
        <section class="flex flex-col items-center lg:w-1/2 p-6">
            <h2 class="text-xl font-semibold mb-6">Se connecter</h2>
            <form method="post" action="login.php" id="login-form" class="w-full max-w-sm">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 mb-2">Nom d'utilisateur :</label>
                    <input type="text" id="username" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <?php if (isset($errors['login'])) { echo "<p class='text-red-500 mt-1'>Nom d'utilisation incorrect</p>"; } ?>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 mb-2">Mot de passe :</label>
                    <input type="password" id="password" name="password"class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <?php if (isset($errors['login'])) { echo "<p class='text-red-500 mt-1'>Mot de passe incorrect</p>"; }?>
                </div>
                <input type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors" value="Se connecter">
                <?php if (isset($error)) {
                    echo "<p class='text-red-500 mt-4'>$error</p>";
                }?>
            </form>
        </section>
    </main>
</body>

</html>