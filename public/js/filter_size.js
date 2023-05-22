$(document).ready(function() {
    document.getElementById("filter-form").style = "max-height: " + document.getElementById("filter-form").scrollHeight + "px;";
    setInterval(() => {
        document.getElementById("filter-form").style = "max-height: " + document.getElementById("filter-form").scrollHeight + "px;";
    }, 1000);
});