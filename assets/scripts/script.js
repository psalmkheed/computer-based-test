$(document).ready(function () {
  // Load the default page when the brand logo is clicked
  $("#brand").on("click", function () {
    window.location.href = "admin.php";
  });

  $("#mainContentTeacher").load("pages/admin_manageStudent.php");
  $("#brandTeacher").on("click", function () {
    window.location.href = "teacher.php";
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
  // This is for the teacher's page
  $("#addExamT").on("click", function () {
    $("#mainContentTeacher").load("pages/admin_viewExam.php");
  });
  $("#viewExam").on("click", function () {
    $("#mainContent").load("pages/admin_viewExam.php");
  });

  $("#startExam").on("click", function () {
    $("#mainContentStudent").load("student/exams.php");
  });

  $("#next").on("click", function () {
    $("#mainContentStudent").load(
      "student/start_exam.php?exam_id=<?= urlencode($exam['exam_id']) ?"
    );
  });
});
