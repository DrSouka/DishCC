<div class='block ingredient' id='ingredient'>
  <?php
    require_once "model/dbManager.php";
    $ingredientList = select(array('name', 'caloriesPer100g'), 'ingredient',);
    foreach ($ingredientList as $key => $value) {
      echo "<div class='element'>". $value['name'] ." ". $value['caloriesPer100g'] ."</div>";
    }
  ?>
</div>
<div class='block list' id='list'>
</div>
<div class='block'>
  <div class='add' onclick="document.getElementById('list').style.display = 'block';"></div>
  <div class='element calories'>How much calories?</div>
  <div class='element'><div class='value'>Result</div><p>calories</p></div>
  <div class=' element save'>Save in history</div>
</div>
