<?php
$phpSelf = htmlspecialchars($_SERVER['PHP_SELF']);
$pathParts = pathinfo($phpSelf);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Ryan Brim Photography</title>
        <meta name="author" content="Ryan Brim">
        <meta name="description" content="Online portfolio of Ryan Brim's photography. The portfolio contains landscapes, portraits, and architecture photography.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/custom.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media="(min-width: 1040px)" href="css/custom-large-monitor.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media="(max-width: 800px)" href="css/custom-tablet.css?version=<?php print time(); ?>" type="text/css">
        <link rel="stylesheet" media="(max-width: 600px)" href="css/custom-phone.css?version=<?php print time(); ?>" type="text/css">
    </head>

    <?php
    print '<body class ="' . $pathParts['filename'] . '">';
    
    include 'connect-DB.php';
    include 'header.php';
    ?>