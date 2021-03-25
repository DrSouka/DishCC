<?php require_once "model/dbManager.php";?>
<form class='suggest_a_dish' method='post' action='index.php?action=suggest_a_dish'>
  <section>
    <input name='name' class='fm_txtfld' type='text' placeholder='Enter a dish name...' required/>

    <select name='category' required>
      <option selected>Choose a category...</option>
      <?php
        $categoryList = select(array('id', 'name'), 'category');
        foreach($categoryList as $key => $value){
          echo "<option value='". $value['id'] ."'>". $value['name'] ."</option>";
        }
      ?>
    </select>

    <select name='type' required>
      <option selected>Choose a type...</option>
      <?php
        $typeList = select(array('id', 'name'), 'type');
        foreach($typeList as $key => $value){
          echo "<option value='". $value['id'] ."'>". $value['name'] ."</option>";
        }
      ?>
    </select>

    <label>For how many person?
      <input name='nbPerson' class='fm_txtfld nb' type='number' placeholder='N' min=1 required/>
    </label>
    <p class='message'>
      <?php if(isset($message['nbPerson'])) echo $message['nbPerson'];?>
    </p>

    <label>Preparation time
      <input name='pTime' class='fm_txtfld hr' type='time' placeholder='HH:MM' required/>
    </label>

    <label>Cooking time
      <input name='cTime' class='fm_txtfld hr' type='time' placeholder='HH:MM' required/>
    </label>

    <label>Difficulty
      <input name='difficulty' class='fm_txtfld nb' type='number' max=5 min=1 placeholder='N' required/><p class='nb'> /5</p>
    </label>
  </section>

  <section>
    <div class='ingredient' id='ingredient'>
      <a id='close' href='#' onclick="document.getElementById('ingredient').style.display = 'none';"></a>
      <?php
        $ingredientList = select(array('id', 'name', 'caloriesPer100g'), 'ingredient');
        foreach ($ingredientList as $key => $value) {
          echo "<div id='". $value['id'] ."' class='element' onclick='add_element(this);'><div class='name'>". $value['name'] ."</div><div class='calories'>". $value['caloriesPer100g'] ."</div>cal/100g</div>";
        }
      ?>
    </div>
    <div class='block list' id='list'>
    </div>
    <div class='add' onclick="document.getElementById('ingredient').style.display = 'block';"></div>

    <input type='submit' value='Suggest the dish'>

    <div>Clear</div>
  </section>

  <textarea name='recipe' role="textbox" class='fm_txtfld' placeholder='Add recipe...' required></textarea>
</form>

<script src='view/content/js/ingredient.js'></script>
