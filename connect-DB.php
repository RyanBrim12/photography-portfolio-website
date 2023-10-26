<!-- Connecting -->
<?php
$databaseName = 'RBRIM_final';
$dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
$username = '';
$password = ''; // Add db password and username
$pdo = new PDO($dsn, $username, $password);
?>
<!-- Connection complete -->