var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
function showCheckboxesSector() {
    var checkboxes = document.getElementById("checkboxesSector");
    if (!expanded) {
      checkboxes.style.display = "block";
      expanded = true;
    } else {
      checkboxes.style.display = "none";
      expanded = false;
    }
  }

  function showCheckboxesPoblacio() {
    var checkboxes = document.getElementById("checkboxesPoblacio");
    if (!expanded) {
      checkboxes.style.display = "block";
      expanded = true;
    } else {
      checkboxes.style.display = "none";
      expanded = false;
    }
  }


function dropdown() {
    let filtro = document.getElementById('form_filtro');
    if (filtro.classList.length == 1) {
        filtro.classList.add('animate-reverse');
    }
    filtro.classList.toggle('animate-reverse');
    filtro.classList.toggle('animate');
}