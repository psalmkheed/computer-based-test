$(document).ready(function () {
  // Load the default page when the brand logo is clicked
  $("#brand").on("click", function () {
    window.location.href = "admin.php";
  });
  $("#logout").on("click", function () {
    // Perform logout action here, e.g., redirect to logout.php or clear session
    // For demonstration, I'll just redirect to index.php
    window.location.href = "index.php";
  });
  $("#manageStudent").on("click", function () {
    $("#mainContent").load("pages/admin_manageStudent.php");
  });
  $("#addStaff").on("click", function () {
    $("#mainContent").load("pages/admin_addStaff.php");
  });
  $("#addExam").on("click", function () {
    $("#mainContent").load("pages/admin_addExam.php");
  });
  $("#viewExam").on("click", function () {
    $("#mainContent").load("pages/admin_viewExam.php");
  });
  $("#result").on("click", function () {
    $("#mainContent").load("pages/admin_result.php");
  });
});
