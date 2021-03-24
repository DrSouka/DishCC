/**
 * @param element[] html element to add in list
 **/
function add_to_list(element){
  element.style.display = 'none';
  document.getElementById('list').innerHTML += "<div id='" + element.id + "e' class='element' calories='" + element.childNodes[1].innerHTML + "'>" + element.firstChild.innerText + "<input type='number' min=1 placeholder='N'/> g<div class='close' onclick='remove(\"" + element.id + "e\", " + element.id + ");'></div></div>";
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
