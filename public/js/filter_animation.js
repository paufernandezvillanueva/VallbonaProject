window.onload = document.getElementById("filter-button").addEventListener("click", animationChange);

function animationChange() {
  var filter = document.getElementById("filter-form").classList;

  if (filter.contains("filter-form-closed-base")) {
    filter.replace("filter-form-closed-base", "filter-form-opened");
  } else if (filter.contains("filter-form-closed")) {
    filter.remove("filter-form-closed");
    document.getElementById("filter-form").offsetWidth;
    filter.add("filter-form-opened");
  } else if (filter.contains("filter-form-opened")) {
    filter.remove("filter-form-opened");
    document.getElementById("filter-form").offsetWidth;
    filter.add("filter-form-closed");
  }
}