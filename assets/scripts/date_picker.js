let calendar;
function showCustomDatePicker() {
  if (!calendar) {
    calendar = flatpickr("#customDateInput", {
      dateFormat: "d-m-Y", // format as 2025-04-22
      defaultDate: new Date(),
      onChange: function (selectedDates, dateStr, instance) {
        document.getElementById("customDateInput").value = dateStr;
        console.log("Date picked:", dateStr);
      },
    });
  }
  calendar.open();
}
