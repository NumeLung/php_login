var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("navbar").style.top = "0";
  }
  else {
    document.getElementById("navbar").style.top = "-50px";
  }
  prevScrollpos = currentScrollPos;
}

window.addEventListener('scroll', function() {
  var footer = document.getElementById('footer');
  var scrollPosition = window.innerHeight + window.pageYOffset;
  var documentHeight = document.body.offsetHeight;
  if (scrollPosition >= documentHeight) {
    footer.style.bottom = '0';
  } else {
    footer.style.bottom = '-50px';
  }
})

function confirmRemove(employeeID) {
  if (confirm("Are you sure you want to remove this employee?")) {
    window.location.href = "remove_employee.php?id=" + employeeID; /*+ "&IdCity=" + document.getElementById('cities').value;*/
  } else {
  }
}



document.addEventListener("DOMContentLoaded", function(){
  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");
  /*var btn2 = document.getElementById("myBtn2");*/

  // Get the modal
  var modal = document.getElementById("myModal");
  /*var modal2 = document.getElementById("myModal2");*/

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  /*var span2 = document.getElementsByClassName("close")[0];*/

  // When the user clicks on the button, open the modal
  if (btn){
    btn.addEventListener('click', function (){
      modal.style.display = "block";
    });
  }

  /*btn2.addEventListener('click', function (){
    modal2.style.display = "block";
  });*/

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
    document.getElementById("ModalForm").reset();
  }
  /*span2.onclick = function() {
    modal2.style.display = "none";
    document.getElementById("ModalForm").reset();
  }*/

  modal.addEventListener('click', function (e){
    if(e.target == modal){
      modal.style.display = "none";
      document.getElementById("ModalForm").reset();
    }
  });
  /*modal2.addEventListener('click', function (e){
    if(e.target == modal2){
      modal2.style.display = "none";
      document.getElementById("ModalForm").reset();
    }
  });*/
});

function openModal(employeeID) {
  // Find the corresponding employee object using the employee ID
  var employee = employees[employeeID];
  // Open the modal
  var modal = document.getElementById("myModal");
  modal.style.display = "block";
  // Load the employee data into the textboxes
  document.getElementById("inputEmployeeID").value = employeeID;
  document.getElementById("inputFirstName").value = employee.FirstName;
  document.getElementById("inputLastName").value = employee.LastName;
  document.getElementById("inputTitle").value = employee.Title;
  document.getElementById("inputTitleOfCourtesy").value = employee.TitleOfCourtesy;
  document.getElementById("inputBirthDate").value = employee.BirthDate;
  document.getElementById("inputHireDate").value = employee.HireDate;
  document.getElementById("inputAddress").value = employee.Address;
  document.getElementById("inputIdCity").value = employee.IdCity;
};

document.addEventListener("DOMContentLoaded", function () {
  // Get references to the select and target elements
  const critlabel = document.getElementById("critlabel")
  const selectElement = document.getElementById("search_options");
  const search_city_properties = document.getElementById("search_city_properties");
  const search_year_properties = document.getElementById("search_year_properties");
  const search_titleofcourt_properties = document.getElementById("search_titleofcourt_properties");
  // Add an event listener to the select element
  selectElement.addEventListener("change", function () {
    // Get the selected value from the select element
    const selectedValue = selectElement.value;
    // Use a switch statement to handle different cases
    switch (selectedValue) {
      case "city":
        critlabel.style.display = "inline";
        search_city_properties.style.display = "inline";
        search_year_properties.style.display = "none";
        search_titleofcourt_properties.style.display = "none";
        break;
      case "years":
        critlabel.style.display = "inline";
        search_city_properties.style.display = "none";
        search_year_properties.style.display = "inline";
        search_titleofcourt_properties.style.display = "none";
        break;
      case "titleofcourtesy":
        critlabel.style.display = "inline";
        search_city_properties.style.display = "none";
        search_year_properties.style.display = "none";
        search_titleofcourt_properties.style.display = "inline";
        break;
        // Add more cases for other values if needed
      default:
        critlabel.style.display = "none";
        search_city_properties.style.display = "none";
        search_year_properties.style.display = "none";
        search_titleofcourt_properties.style.display = "none";
        break;
    }
  });
});


