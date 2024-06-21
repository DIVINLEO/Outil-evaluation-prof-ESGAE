<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== 0) {
    header("Location: /login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .wrapper {
            display: flex;
            flex: 1;
        }
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            flex: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .sidebar .nav-link {
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link .fas {
            margin-right: 10px;
        }
        .header {
            background: #343a40;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
    </div>
    <div class="wrapper">
        <div class="sidebar">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="manage_teachers.php">
                        <i class="fas fa-chalkboard-teacher"></i> Manage Teachers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_students.php">
                        <i class="fas fa-user-graduate"></i> Manage Students
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_classes.php">
                        <i class="fas fa-school"></i> Manage Classes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="evaluation_reports.php">
                        <i class="fas fa-file-alt"></i> View Evaluation Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage_activities.php">
                        <i class="fas fa-futbol"></i> Manage Activities
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
        <div class="content">
            <h2>Salut, Admin</h2>
            <p>C'est le dashboard de l'admin, il peut manager le systeme.</p>
            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
