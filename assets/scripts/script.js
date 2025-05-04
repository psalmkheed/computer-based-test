$(document).ready(function () {
  // Load the default page when the brand logo is clicked
  $("#brand").on("click", function () {
    window.location.href = "admin.php";
  });

  $("#manageStudent").on("click", function () {
    $("#mainContent").load("pages/admin_manageStudent.php");
  });
  $("#addStaff").on("click", function () {
    $("#mainContent").load("pages/admin_addStaff.php");
  });
  $("#subject").on("click", function () {
    $("#mainContent").load("pages/admin_subject.php");
  });
  $("#addExam").on("click", function () {
    $("#mainContent").load("pages/admin_addExam.php");
  });
  $("#viewExam").on("click", function () {
    $("#mainContent").load("pages/admin_viewExam.php");
  });
  $("#result").on("click", function () {
    $("#mainContent").load("pages/admin_class.php");
  });
});
