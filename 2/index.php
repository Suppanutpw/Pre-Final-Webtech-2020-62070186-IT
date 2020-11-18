<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2 HdQuiz</title>
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    .form-group {
      box-sizing: border-box;
      width: 80% !important;
    }
    .submit-btn {
      box-sizing: border-box;
      width: 20% !important;
    }
    r {
      font-weight: bold;
      color: red;
    }
  </style>
  <?php
    $spotify = file_get_contents('https://dd-wtlab2020.netlify.app/pre-final/ezquiz.json');
    $spotify = json_decode($spotify);
  ?>
</head>
<body>
  <div class="container pt-4">
    <?php
      $found_count = 0;
      if (isset($_POST['submit'])) {
        $query_music = [];
        $find_word = strtolower($_POST['query']);
        foreach ($spotify->tracks->items as $music) {
          $is_found = strpos(strtolower($music->album->name), $find_word) !== false;
          foreach ($music->album->artists as $artists) {
            if (strpos(strtolower($artists->name), $find_word) !== false) {
              $is_found = true;
            }
          }

          if ($is_found) {
            $query_music[$found_count++] = $music;
          }

        }
      } else {
        $query_music = $spotify->tracks->items;
      }
    ?>

    <p class="mb-1">ระบุคำค้นหา​ <?php echo $found_count != 0? "<b>พบ ".$found_count." เพลง</b>" : (isset($_POST['submit'])? "<r>ไม่พบคำที่ต้องการค้นหา</r>" : ""); ?></p>
    <form class="form-inline" method="POST">
      <div class="form-group">
        <label for="inputPassword2" class="sr-only">ใส่ชื่อศิลปิน หรือ ชื่อเพลงที่ต้องการค้นหา</label>
        <input type="text" class="form-control w-100" name="query" id="query" value="<?php echo isset($_POST['submit'])? $_POST['query'] : ""; ?>" placeholder="ใส่ชื่อศิลปิน หรือ ชื่อเพลงที่ต้องการค้นหา" required>
      </div>
      <input type="submit" name="submit" class="btn btn-primary submit-btn" value="ค้นหาเพลง">
    </form>

    <div class="row">
    <?php
      foreach ($query_music as $music) {
    ?>

      <div class="col-4 mt-3">
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
