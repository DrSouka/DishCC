<div class='ingredient' id='ingredient'>
  <a id='close' href='#' onclick="document.getElementById('ingredient').style.display = 'none';"></a>
  <?php
    require_once "model/dbManager.php";
    $ingredientList = select(array('id', 'name', 'caloriesPer100g'), 'ingredient',);
    foreach ($ingredientList as $key => $value) {
      echo "<div id='". $value['id'] ."' class='element' onclick='add_to_list(this);'><div class='name'>". $value['name'] ."</div><div class='calories'>". $value['caloriesPer100g'] ."</div>cal/100g</div>";
    }
  ?>
</div>
<div class='block list' id='list'>
</div>
<div class='block'>
  <div class='add' onclick="document.getElementById('ingredient').style.display = 'block';"></div>
  <div class='element calories' onclick="result('list', 'result');">How much calories?</div>
  <div class='result' id='result'><div class='value' name='result'>Result</div><p>calories</p></div>
  <div class='element save' onclick="location.href='index?action=save_in_history'">Save in history</div>
</div>

<script src='view/content/js/ingredient.js'></script>
