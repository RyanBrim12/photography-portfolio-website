<?php include 'top.php'; ?>
<main class="slide-gallery">
    <?php
    $commentary = array(
        "landscapes" => "Landscapes are some of my favorite photos to take. The world is so extremely beautiful, and only needs a little bit of framing to show its wonders. Many of my landscapes are of mountains because I find sprawling ranges of mountains particularly pretty. Many of these landscapes were taken while skiing at Killington Mountain.",
        "portraits" => "My approach to portraits is overall quite odd. I tend not to take more traditional portraits; that being pictures of people with them looking into the camera and smiling. Instead I take my portraits from odd angles. Often my subjects are looking entirely away from the camera and are sometimes obscured by objects between them and the camera.",
        "nature" => "I love nature photography. Plants and animals are such interesting subjects. Plants, such as flowers and mushrooms, can be so vibrantly colored. When I bring the camera in close I can capture so much detail that would never be seen if I were to just walk by. Animals are cute and pretty so pictures of them are often easy to make look good. Many of the pictures here are of frogs. This is because they are easy to find and are often in interesting poses, because they can be in water and on land.",
        "sports" => "Sports photography is a style that I have not explored very much. This is because I take most of my pictures on my phone. Phones are not great for most sports photography because a good zoom and high shutter speed is often needed.",
        "architecture" => "Architecture photography is another kind of photography that I have not explored very much. I find it very interesting but have not found myself in many places that have had architecture that I have found interesting enough to photograph. I enjoy architecture with harsh angles, and also like how buildings contrast with the sky and other natural things."
    );

    $sql = 'SELECT DISTINCT fldCategory FROM tblPortfolioPhotos';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll();
    foreach ($records as $record) {
        print '<section>';
        print '<button class="prev" onclick="plusDivs(-1, \'' . $record['fldCategory'] . '\')">&#10094;</button>';
        print '<button class="next" onclick="plusDivs(1, \'' . $record['fldCategory'] . '\')">&#10095;</button>';
        print '<h2>' . ucfirst($record['fldCategory']) . '</h2>';
        print '<ul>';
        $sql = 'SELECT fldPhotoUrl, fldPhotoDescription, fldCategory FROM tblPortfolioPhotos WHERE fldCategory = "' . $record['fldCategory'] . '"';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $photos = $statement->fetchAll();
        foreach ($photos as $photo) {
            print '<li class="' . $record['fldCategory'] . '-slide"><img src="images/' . $photo['fldPhotoUrl'] . '" alt="' . $photo['fldPhotoDescription'] . '"></li>';
        }
        print '</ul>';
        print '<p>' . $commentary[$record['fldCategory']] . '</p>';
        print '</section>';
    }
    ?>
</main>
<script>
var slideIndexes = {
    "landscapes": 1,
    "portraits": 1,
    "nature": 1,
    "sports": 1,
    "architecture": 1
};
showDivs(slideIndexes["landscapes"], "landscapes")
showDivs(slideIndexes["portraits"], "portraits");
showDivs(slideIndexes["nature"], "nature");
showDivs(slideIndexes["sports"], "sports");
showDivs(slideIndexes["architecture"], "architecture");


function plusDivs(n, prefix) {
    showDivs(slideIndexes[prefix] += n, prefix);
}

function showDivs(n, prefix) {
    var x = document.getElementsByClassName(prefix + "-slide");
    if (n > x.length) {
        slideIndexes[prefix] = 1;
    }
    if (n < 1) {
        slideIndexes[prefix] = x.length;
    }
    for (var i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }

    x[slideIndexes[prefix] - 1].style.display = "block";
}
</script>
<?php include 'footer.php'; ?>
</body>
</html>