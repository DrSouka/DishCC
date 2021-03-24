<form class='suggest_a_dish'>
  <section>
    <input class='fm_txtfld' type='text' placeholder='Enter a dish name...'/>

    <select>
      <option selected>Choose a category...</option>
    </select>

    <select>
      <option selected>Choose a type...</option>
    </select>

    <label>For how many person?
      <input class='fm_txtfld' type='text' placeholder='N'/>
    </label>

    <label>Preparation time
      <input class='fm_txtfld' type='text' placeholder='HH:MM'/>
    </label>

    <label>Cooking time
      <input class='fm_txtfld' type='text' placeholder='HH:MM'/>
    </label>

    <label>Difficulty
      <input class='fm_txtfld' type='number' max=5 min=1 placeholder='N'/>/5
    </label>
  </section>

  <section>
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
    <div class='add' onclick="document.getElementById('ingredient').style.display = 'block';"></div>

    <div>Suggest the dish</div>

    <div>Clear</div>
  </section>

  <textarea class='fm_txtfld' placeholder='Add a description...'></textarea>
</form>

<script src='view/content/js/ingredient.js'></script>
