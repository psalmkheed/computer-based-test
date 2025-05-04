function validateForm() {
  var username = document.getElementById("username").value.trim();
  var password = document.getElementById("password").value.trim();

  if (username === "") {
    document.getElementById("errorText").innerHTML =
      "*Please enter your username";
    return false;
  } else if (password === "") {
    document.getElementById("errorText").innerHTML =
      "*Please enter your password";
    return false;
  } else {
    document.getElementById("errorText").innerHTML = "";
    return true;
  }
}

$("#login_Form").on("submit", function (e) {
  e.preventDefault();

  if (!validateForm()) return;

  var formData = $(this).serialize();
  var $btn = $("#loginBtn");

  $btn.prop("disabled", true).text("Logging in...");

  $.ajax({
    url: "/CBT/connection/user_login.php",
    type: "POST",
    data: formData,
    success: function (response) {
      response = response.trim();
      if (response === "admin") {
        window.location.href = "/CBT/admin.php";
      } else if (response === "teacher") {
        window.location.href = "/CBT/teacher.php";
      } else if (response === "student") {
        window.location.href = "/CBT/student.php";
      } else {
        document.getElementById("errorText").innerHTML = response;
        $btn.prop("disabled", false).text("Login"); // Re-enable on error
      }
    },
    error: function (xhr, status, error) {
      alert("Error logging in: " + error);
      $btn.prop("disabled", false).text("Login"); // Re-enable on error
    },
  });
});
