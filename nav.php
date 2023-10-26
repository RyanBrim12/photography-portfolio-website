<script>
function switchNav() {
  var x = document.getElementsByClassName("links");
  if (x[0].style.display == "flex") {
    x[0].style.display = "none";
  } else {
    x[0].style.display = "flex";
  }
}

window.onresize = function() {
    var x = document.getElementsByClassName("links");
    if (window.innerWidth > 600) {
        x[0].style.display = "flex"
    }
    else {
        x[0].style.display = "none";
    }
}
</script>
<nav>
    <a class="icon" onclick="switchNav()">
        <img src="images/hamburger-icon.png" alt="Menu Toggle">
    </a>

    <div class="links">
        <a class="<?php
        if ($pathParts['filename'] == "index") {
            print 'activePage';
        }
        ?>" href="index.php">Home</a>

        <a class="<?php
        if ($pathParts['filename'] == "portfolio") {
            print 'activePage';
        }
        ?>" href="portfolio.php">Portfolio</a>

        <a class="<?php
        if ($pathParts['filename'] == "about") {
            print 'activePage';
        }
        ?>" href="about.php">About</a>

        <a class="<?php
        if ($pathParts['filename'] == "form") {
            print 'activePage';
        }
        ?>" href="form.php">Contact</a>
    </div>
</nav>
</header>