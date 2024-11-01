<?php
$servername = "localhost";
$username = "root";
$password = "24770267";
$dbname = "ehms_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Connection failed: " . addslashes($e->getMessage()) . "'
        }).then(() => {
            window.history.back();
        });
    </script>";
    exit();
}
?>
