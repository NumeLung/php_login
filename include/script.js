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

  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on the button, open the modal
  btn.addEventListener('click', function (){
    modal.style.display = "block";
  });

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  modal.addEventListener('click', function (e){
    if(e.target == modal){
      modal.style.display = "none";
    }
  });
});


function handleClick(employeeID) {
  // Find the corresponding employee object using the employee ID
  var employee = employees[employeeID];

  // Log the employee object to the console
  console.log(employee);
}