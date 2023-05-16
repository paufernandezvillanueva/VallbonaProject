function demanaDarkmode(path) {
  var darkmode = 0;
  if ($("#darkmode").val() == 0) {
    darkmode = 1;
    $("#skin").attr("href", path + "/css/darkmode.css");
  } else if ($("#darkmode").val() == 1) {
    darkmode = 0;
    $("#skin").attr("href", path + "/css/lightmode.css");
  }
  fetch(path + `/api/darkmode/` + $("#userid").val() + "/" + darkmode).then(function (response) {
    if (response.ok) {
      response.text().then(mostraDarkmode);
    } else {
      console.log(`Status: ${response.status} ${response.statusText}`);
    }
  })
    .catch(function (error) {
      console.log('Hubo un problema con la petición Fetch:' + error.message);
    });
  return false;
}

function mostraDarkmode(dades) {
  console.log(dades);
  if ($("#darkmode").val() == 0) {
    $("#darkmode").html("Mode nit <i class='bi bi-moon-fill'></i>");
    $("#darkmode").val("1");
    $("#darkmode").removeClass("lightmode");
    $("#darkmode").addClass("darkmode");
  } else if ($("#darkmode").val() == 1) {
    $("#darkmode").html("<i class='bi bi-sun-fill'></i> Mode dia");
    $("#darkmode").val("0");
    $("#darkmode").removeClass("darkmode");
    $("#darkmode").addClass("lightmode");
  }
}
