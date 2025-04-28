function validateForm() {
  var username = document.getElementById("username").value;
  var password = document.getElementById("password").value;
  var errorText = document.getElementById("errorText");
  if (username === "" || password === "") {
    document.getElementById("errorText").innerHTML =
      "*Please fill in all fields.";
    return false;
  } else if (username !== "" && password !== "") {
    document.getElementById("errorText").innerHTML = "Login successful!";
    setTimeout(function () {
      window.location.href = "admin.html";
    }, 2000);
  }
  return true;
}
