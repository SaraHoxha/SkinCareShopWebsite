<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radiant Skin Homepage</title>
    <link rel="stylesheet" href="styles/mainstyle.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="page-container">
    <?php include "header.html" ;?>
<div class="slideshow-container">
    <div class="banner">
      <img src="images/banner1.jpeg" style="width:100%">
    </div>
    <a class="prev" onclick="nextSlide(1)">&#10094;</a>
    <a class="next" onclick="prevSlide(1)">&#10095;</a>
    </div>
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span> 
    <span class="dot" onclick="currentSlide(2)"></span> 
    <span class="dot" onclick="currentSlide(3)"></span> 
  </div>
<div class="products-container">
    <div class="title"> Some of our products</div>
    <div class="products">
        <!--ADD PHP CODE-->
    </div>
    <div class="products-button">
        <button class="button button5">SEE ALL</button>
    </div>
    <?php include "footer.html"; ?>
</div>
</div>
</body>
</html>