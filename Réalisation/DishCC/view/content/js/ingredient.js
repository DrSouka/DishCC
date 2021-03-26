/**
 * @param {element} element element from which the function will be executed
 * @param {target} target element where result will be written
 **/
function result(element, target){
  total = 0;

  Array.prototype.forEach.call(document.getElementById(element).children, index => {
    total += (Number(index.attributes.calories.value) / 100) * index.children[0].valueAsNumber;
  });

  document.getElementById(target).children[0].innerText = total.toFixed(2);
}


/**
* @param {element} element ingredient element to add in a list of ingredient
*/
function add_element(element){
  document.getElementById(element.id).style.display = 'none';
  
  //set ingredient element parameters
  var new_element = document.createElement('div');
  var title = document.createTextNode(element.firstChild.innerText);
  new_element.name = 'ingredient';
  new_element.id = element.id + "e";
  new_element.className = 'element';
  new_element.setAttribute("calories", element.childNodes[1].innerHTML);
  new_element.appendChild(title);

  //input number
  var nbInput = document.createElement('input');
  nbInput.name = "ingredient["+ element.id +"]";
  nbInput.type = 'number';
  nbInput.min = 1;
  nbInput.placholder = 'N';
  new_element.appendChild(nbInput);

  var comment = document.createTextNode(' g');
  new_element.appendChild(comment);

  //close button
  var close = document.createElement('div');
  close.className = 'close';
  close.addEventListener("click", function(){
    document.getElementById(new_element.id).remove();
    document.getElementById(element.id).style.display = 'block';
  })
  new_element.appendChild(close);

  //create element in list
  document.getElementById('list').appendChild(new_element);
}
