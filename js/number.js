const selectNumber = document.getElementById("SelectedNumber");
const inputNumber = document.getElementById("phone_number");

selectNumber.addEventListener("change", function () {
    let selectedOption = JSON.parse(selectNumber.value);
    console.log(selectedOption); // Debugging line
    var contact = selectedOption.contact;
    inputNumber.value = contact;
});