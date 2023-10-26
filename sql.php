<?php
include 'top.php';
?>
<main>
    <h2>Create Table SQL</h2>
<pre><code>
CREATE TABLE tblUserMessages(
    pmkUserMessagesId INT AUTO_INCREMENT PRIMARY KEY,
    fldFirstName VARCHAR(40) DEFAULT NULL,
    fldLastName VARCHAR(40) DEFAULT NULL,
    fldEmail VARCHAR(256) DEFAULT NULL,
    fldSubject VARCHAR(40) DEFAULT NULL,
    fldMessage VARCHAR(1000) DEFAULT NULL,
    fldDiscoveryMethod VARCHAR(20) DEFAULT NULL
)
</code></pre>

    <h2>Insert into UserMessages Table SQL</h2>
<pre><code>
INSERT INTO tblUserMessages (fldFirstName, fldLastName, fldEmail, fldSubject, fldMessage, fldDiscoveryMethod)
VALUES (?, ?, ?, ?, ?, ?)
</code></pre>

    <h2>Retrieve Records from UserMessages Table SQL</h2>
<pre><code>
SELECT fldFirstName, fldLastName, fldEmail, fldSubject, fldMessage, fldDiscoveryMethod FROM tblUserMessages
</code></pre>

    <h2>Create Table SQL</h2>
<pre><code>
CREATE TABLE tblPortfolioPhotos(
    pmkPortfolioPhotosId INT AUTO_INCREMENT PRIMARY KEY,
    fldPhotoUrl VARCHAR(50) NOT NULL,
    fldPhotoDescription VARCHAR(125) NOT NULL,
    fldCategory VARCHAR(50) NOT NULL
)
</code></pre>

    <h2>Insert into PortfolioPhotos Table SQL</h2>
<pre><code>
INSERT INTO `tblPortfolioPhotos`(`fldPhotoUrl`, `fldPhotoDescription`, `fldCategory`) VALUES 
('IMG_6247.jpg', 'Black and white photo of person standing at a lookout at Garret Mountain', 'portraits'),
('IMG_6248.jpg', 'Group of people sitting enjoying a view', 'portraits'),
('IMG_7402.jpg', 'Person sitting with brooklyn bridge in distance', 'portraits'),
('IMG_5556.jpg', 'Person sitting at lookout', 'portraits'),
('IMG_6879.jpg', 'Frog poking out of the water', 'nature'),
('IMG_6886.jpg', 'Frog resting on rock', 'nature'),
('IMG_6891.jpg', 'Frog sitting in stream', 'nature'),
('IMG_4312.jpg', 'Sprinter on the starting line', 'sports'),
('IMG_7103.jpg', 'People playing spikeball', 'sports'),
('IMG_7075.jpg', 'Fishing in the ocean', 'sports'),
('IMG_7513.jpg', 'Building against the night sky', 'architecture'),
('IMG_7267.jpg', 'Building shining with light', 'architecture')
</code></pre>

    <h2>Retrieve Records from PortfolioPhotos Table SQL</h2>
<pre><code>
SELECT fldPhotoUrl, fldPhotoDescription, fldCategory FROM tblPortfolioPhotos WHERE fldCategory = "landscapes"
</code></pre>

    <h2>Retrieve all unique categories of photos in Table</h2>
<pre><code>
SELECT DISTINCT fldCategory FROM tblPortfolioPhotos
</code></pre>

</main>
<?php include 'footer.php'; ?>
</body>
</html>