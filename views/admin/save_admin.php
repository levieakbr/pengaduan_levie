    <?php
    require_once __DIR__ . '/../connection.php';
    session_start();
    if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
        header('Location: login.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: add_admin.php');
        exit();
    }
    
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    if ($username === '') {
        header('Location: add_admin.php');
        exit();
    }

    $defaultPassword ='12345';
    $hash = password_hash($defaultPassword, PASSWORD_BCRYPT);

    $stmt = mysqli_prepare($conn, 'INSERT INTO admin (username, password) VALUES (?, ?)');

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $username, $hash);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }

    header('Location: manage_admin.php');
    exit();
    ?>