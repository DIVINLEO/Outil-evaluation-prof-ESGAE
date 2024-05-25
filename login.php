<?php
include('includes/database.php');
session_start();

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
    $stmt = $conn->prepare("SELECT * FROM Élèves WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['ID_élève'];
        header("Location: /student/dashboard.php");
        exit();
    }

    // Vérifier si l'utilisateur est un professeur
    $stmt = $conn->prepare("SELECT * FROM Professeurs WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['ID_professeur'];
        header("Location: /teacher/dashboard.php");
        exit();
    }

    $error = "Invalid username or password";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    
</head>
<body>
    
    <header>
        <nav>
            <button id="toggleTheme">Basculer le thème</button>
        </nav>

        <style>
        
            :root {
                --primary-color: #3498db;
                --secondary-color: #2ecc71;
                --background-color-light: #ffffff;
                --background-color-dark: #2c3e50;
                --text-color-light: #2c3e50;
                --text-color-dark: #ecf0f1;
            }
            
            body.light-theme {
                background-color: var(--background-color-light);
                color: var(--text-color-light);
            }
            
            body.dark-theme {
                background-color: var(--background-color-dark);
                color: var(--text-color-dark);
            }
            
            body {
                font-family: Arial, sans-serif;
                transition: background-color 0.5s ease, color 0.5s ease;
            }
            
            .container {
                text-align: center;
                margin-top: 20%;
            }
            
            h1 {
                font-size: 2.5em;
                animation: colorchange 3s infinite;
            }
            
            @keyframes colorchange {
                0% { color: var(--primary-color); }
                50% { color: var(--secondary-color); }
                100% { color: var(--primary-color); }
            }
            
            button {
                background: var(--primary-color);
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                transition: background 0.5s;
            }
            
            button:hover {
                background: var(--secondary-color);
            }
            :root {
                --primary-color: #3498db;
                --secondary-color: #2ecc71;
                --background-color-light: #ffffff;
                --background-color-dark: #2c3e50;
                --text-color-light: #2c3e50;
                --text-color-dark: #ecf0f1;
                --header-bg: rgba(52, 152, 219, 0.8);
                --button-hover-bg: #2980b9;
            }
            
            body.light-theme {
                background-color: var(--background-color-light);
                color: var(--text-color-light);
            }
            
            body.dark-theme {
                background-color: var(--background-color-dark);
                color: var(--text-color-dark);
            }
            
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                transition: background-color 0.5s ease, color 0.5s ease;
            }
            
            header {
                background: var(--header-bg);
                padding: 1em;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            nav ul {
                list-style: none;
                display: flex;
                gap: 1em;
                margin: 0;
                padding: 0;
            }
            
            nav a {
                color: white;
                text-decoration: none;
                font-size: 1.1em;
            }
            
            #toggleTheme {
                background: var(--primary-color);
                border: none;
                color: white;
                padding: 0.5em 1em;
                cursor: pointer;
                transition: background 0.3s;
            }
            
            #toggleTheme:hover {
                background: var(--button-hover-bg);
            }
            
            main {
                padding: 2em;
                max-width: 1200px;
                margin: auto;
            }
            
            .welcome, .login-register, .dashboard, .evaluation, .academic-performance, .professional-development, .feedback, .reports, .settings {
                margin-bottom: 2em;
                padding: 1em;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            
            .welcome h1, .login-register h2 {
                animation: fadeIn 1.5s ease-in-out;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            
            button, input[type="submit"] {
                background: var(--primary-color);
                border: none;
                color: white;
                padding: 0.75em 1.5em;
                cursor: pointer;
                font-size: 1em;
                border-radius: 4px;
                transition: background 0.3s;
            }
            
            button:hover, input[type="submit"]:hover {
                background: var(--button-hover-bg);
            }
            
            form {
                display: flex;
                flex-direction: column;
                gap: 1em;
            }
            
            label {
                font-weight: bold;
            }
            
            input[type="text"], input[type="password"], input[type="email"], input[type="date"], select {
                padding: 0.5em;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 1em;
            }
            
            input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus, input[type="date"]:focus, select:focus {
                border-color: var(--primary-color);
                outline: none;
            }
            
            .table {
                overflow-x: auto;
            }
            
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 1em 0;
            }
            
            th, td {
                padding: 0.75em;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            
            th {
                background-color: var(--primary-color);
                color: white;
            }
            
            .container {
                text-align: center;
                margin-top: 20%;
            }
            
            h1 {
                font-size: 2.5em;
                animation: colorchange 3s infinite;
            }
            
            @keyframes colorchange {
                0% { color: var(--primary-color); }
                50% { color: var(--secondary-color); }
                100% { color: var(--primary-color); }
            }
</style>
<script src="./assers/js/script.js"></script>
</header>
    <main>
        <section class="welcome">
            <center><h1>Bienvenue sur notre plateforme d'évaluation de performance des professeurs à l'ESGAE</h1></center>
            <p>Notre plateforme vise à améliorer la qualité de l'enseignement . Elle offre également des outils pour les professeurs pour auto-évaluer et améliorer leurs pratiques pédagogiques.</p>
        </section>
        <section class="login-register">
            <h2>Se connecter ou s'inscrire</h2>
            <form method="post" action="login.php" id="login-form">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password">
                <input type="submit" value="Se connecter">
                <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
            </form>
        </section>
</body>
</html>