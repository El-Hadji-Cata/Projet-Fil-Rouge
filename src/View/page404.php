<?php
require_once 'src/View/partial/_head.php';
require_once 'src/View/partial/_header.php';
?>


<div class="error-container">
  <div class="lottie-animation"></div>
  <div class="error-content">
    <h1>Error!</h1>
    <p>Oops! Product Not Found :(</p>
    <a href="index.php?page=mission&action=homePage" class="btn btn-primary">Go Back!</a>
  </div>
</div>

<?php
require_once 'src/View/partial/_footer.php';
?>