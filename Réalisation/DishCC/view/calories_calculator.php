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

<script>
  /**
   * @param element[] html element to add in list
   **/
  function add_to_list(element){
    element.style.display = 'none';
    document.getElementById('list').innerHTML += "<div id='" + element.id + "e' class='element' calories='" + element.childNodes[1].innerHTML + "'>" + element.firstChild.innerText + "<input oninput='this.attributes.value = this.value;' type='number' value=''/> g<div class='close' onclick='remove(\"" + element.id + "e\", " + element.id + ");'></div></div>";
    console.log(document.getElementById('list'));
  }

  /**
   * @param element[] html element from which the function will be executed
   * @param target[] html element to display in original list
   **/
  function remove(element, target){
    document.getElementById(element).remove();
    document.getElementById(target).style.display = 'block';
  }

  /**
   * @param element[] html element from which the function will be executed
   * @param target[] html element where result will be written
   **/
  function result(element, target){
    total = 0;

    Array.prototype.forEach.call(document.getElementById(element).children, index => {
      total += (Number(index.attributes.calories.value) / 100) * index.children[0].valueAsNumber;
    });

    document.getElementById(target).children[0].innerText = total.toFixed(2);
  }
</script>
