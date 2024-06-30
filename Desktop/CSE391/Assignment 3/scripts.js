document
  .getElementById("appointmentForm")
  .addEventListener("submit", function (event) {
    let phone = document.getElementById("phone").value;
    let carEngineNumber = document.getElementById("car_engine_number").value;
    let phoneRegex = /^[0-9]+$/;

    if (!phoneRegex.test(phone) || !phoneRegex.test(carEngineNumber)) {
      alert("Phone and Car Engine Number must contain only numbers.");
      event.preventDefault();
    }
  });
