<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>1 EzQuiz</title>
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container p-3">
    <div class="row">
    <?php
      $spotify = file_get_contents('https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json');
      $spotify = json_decode($spotify);

      foreach ($spotify->tracks->items as $music) {
    ?>

      <div class="col-4 mt-4">
        <div class="card h-100">
          <img class="card-img-top" src="<?php echo $music->album->images[0]->url; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $music->album->name; ?></h5>
          <?php
            echo "<p class='card-text mb-1'>Artist : ";
            foreach ($music->album->artists as $artists) {
              echo $artists->name." ";
            }
            echo "</p><p class='card-text mb-1'>Release date : ".$music->album->release_date."</p>";
            echo "<p class='card-text'>Avaliable : ".sizeof($music->album->available_markets)." countries</p>";
          ?>
          </div>
        </div>
      </div>

    <?php } ?>

    </div>
  </div>
</body>
</html>
