function formValidation() {
  /* Retrieving values from form fields using document.getElementById(""): This part of the statement is a 
    method call on the document object,The 'value' property is a property of input elements, such as <input>, */
  var name = document.getElementById("name").value;
  var lastname = document.getElementById("lname").value;
  var mobileNumber = document.getElementById("mobileNumber").value;
  var email = document.getElementById("email").value;
  var userName = document.getElementById("userName").value;
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirmPassword").value;
  var IDNO = document.getElementById("IDNO").value;
  var date_of_birth = document.getElementById("DOB").value;
  var role = document.getElementById("role").value;
  var gender = document.getElementById("gender").value;

  //ensure all fileds are filed
  if (
    name === "" ||
    lastname === "" ||
    mobileNumber === "" ||
    email === "" ||
    userName === "" ||
    password == "" ||
    confirmPassword === "" ||
    IDNO === "" ||
    date_of_birth === "" ||
    role === "" ||
    gender == ""
  ) {
    alert("FILL ALL FIELDS!");
    return false;
  }
  //ensure the email is valid

  /*indexOf() method is used to find the index of the first occurrence of a
   specified value within a string*/
  if (email.indexOf("@") === -1 || email.indexOf(".") === -1) {
    alert("Please enter a valid email address");
    return false;
  }

  //ensure the ID number is valid

  if (isNaN(IDNO) || IDNO.length !== 8) {
    alert("please enter a valid ID number");
    return false;
  }
  //ensure the mobilenumber is valid
  if (isNaN(mobileNumber) || mobileNumber.length !== 10) {
    alert("please enter a valid Phone Number ten digits");
    return false;
  }

  //ensure the year of birth is valid

  /* Split the date string by '/' character to get year, month, and
     datesplit() method is used to split a string into an array of 
     substrings based on a specified separator */
  var parts = date_of_birth.split("-");

  // Check if the date string contains three parts (year, month, )
  if (parts.length !== 3) {
    alert("enter a valid year of birth in YYYY-MM-DD format");
    return false;
  }

  // Parse day, month, and year as integers
  var year = parts[0];
  var month = parts[1];
  var day = parts[2];
  // Check if year month and day are valid numbers
  if (isNaN(year) || isNaN(month) || isNaN(day)) {
    alert("enter a valid year of birth in YYYY-MM-DD format");
    return false;
  }

  // Check if month is within valid range (1-12)
  if (month < 1 || month > 12) {
    alert("enter a valid year of birth in YYYY-MM-DD format");
    return false;
  }

  // Check if day is within valid range based on month
  var daysInMonth = 31;
  if (month < 8 && month % 2 != 0) {
    daysInMonth = 31;
  }
  if (month > 7 && month % 2 != 1) {
    daysInMonth = 31;
  }
  if (month < 7 && month % 2 != 1) {
    daysInMonth = 30;
  }
  if (month > 7 && month % 2 != 0) {
    daysInMonth = 30;
  }
  if (month === 2) {
    if (year % 4 != 0) {
      daysInMonth = 29;
    } else {
      daysInMonth = 28;
    }
  }
  if (day < 1 || day > daysInMonth) {
    alert("enter valid date ");
    return false;
  }
  // Check if year is within a reasonable range (e.g., between 1900 and 2100)
  if (year < 1950 || year > 2006) {
    alert("enter a valid year of birth in YYYY-MM-DD format");
    return false;
  }

  // ensure the password is strong and password and confirm password much
  //ensure the password is more than 8
  if (password.length < 8) {
    alert("enter a strong password");
    return false;
  }
  //ensure the password has a special character
  for (var i = 0; i < password.length; i++) {
    // Get the character at index i
    var char = password.charAt(i);
    var specialChars = "!@#$%^&*()-_+=<>?";
    var special = false;
    if (specialChars.indexOf(char) !== -1) {
      special = true;
      break;
    }
  }

  if (special === false) {
    alert("enter a strong password");
    return false;
  }
  // Loop through each character in the password
  for (var i = 0; i < password.length; i++) {
    // Get the character at index i
    var char = password.charAt(i);
    var Uppercase = false;
    //ensure the password has a upper case character
    if (char >= "A" && char <= "Z") {
      Uppercase = true;
      break;
    }
  }

  // Loop through each character in the password
  for (var i = 0; i < password.length; i++) {
    // Get the character at index i
    var char = password.charAt(i);
    var Digit = false;
    //ensure the password has a number
    if (char >= "0" && char <= "9") {
      Digit = true;
      break;
    }
  }

  // Loop through each character in the password
  for (var i = 0; i < password.length; i++) {
    // Get the character at index i
    var char = password.charAt(i);
    var lower = false;
    //ensure the password has a lower case character
    if (char >= "a" && char <= "z") {
      lower = true;
      break;
    }
  }
  //check for uppercharacter lower character and digit
  if (Uppercase === false) {
    alert("enter a strong password  ");
    return false;
  }

  if (lower === false) {
    alert("enter a strong password ");
    return false;
  }
  if (Digit === false) {
    alert("enter a strong password");
    return false;
  }

  // ensure the password and confirm password much
  if (password !== confirmPassword) {
    alert("passwords do not match");
    return false;
  }
  return true;
}

//reset password validation
function loginvalidate() {
  /* Retrieving values from form fields using document.getElementById(""): This part of the statement is a 
   method call on the document object,The 'value' property is a property of input elements, such as <input>, */
  var password = document.getElementById("password").value;
  var userName = document.getElementById("userName").value;
  var role = document.getElementById("role").value;

  //ensure the inputs have a value
  if (userName === "" || password === "" || role === "") {
    alert("Fill all fields");
    return false;
  }
  return true;
}
//reset password validation
function resetPasswordValidation() {
  /* Retrieving values from form fields using document.getElementById(""): This part of the statement is a 
    method call on the document object,The 'value' property is a property of input elements, such as <input>, */
  var password = document.getElementById("newPassword").value;
  var confirmPassword = document.getElementById("confirmPassword").value;
  var userName = document.getElementById("usernName").value;

  //ensure the inputs have a value
  if (userName === "" || password === "" || confirmPassword === "") {
    alert("all field must be filled");
    return false;
  }
  // ensure the password is strong and password and confirm password much
  //ensure the password is more than 8
  if (password.length < 8) {
    alert("weak password");
    return false;
  }
  //ensure the password has a special character
  for (var i = 0; i < password.length; i++) {
    // Get the character at index i
    var char = password.charAt(i);
    var specialChars = "!@#$%^&*()-_+=<>?";
    var special = false;
    if (specialChars.indexOf(char) !== -1) {
      special = true;
      break;
    }
  }

  if (special === false) {
    alert("weak password");
    return false;
  }
  // Loop through each character in the password
  for (var i = 0; i < password.length; i++) {
    // Get the character at index i
    var char = password.charAt(i);
    var Uppercase = false;
    //ensure the password has a upper case character
    if (char >= "A" && char <= "Z") {
      Uppercase = true;
      break;
    }
  }

  // Loop through each character in the password
  for (var i = 0; i < password.length; i++) {
    // Get the character at index i
    var char = password.charAt(i);
    var Digit = false;
    //ensure the password has a number
    if (char >= "0" && char <= "9") {
      Digit = true;
      break;
    }
  }

  // Loop through each character in the password
  for (var i = 0; i < password.length; i++) {
    // Get the character at index i
    var char = password.charAt(i);
    var lower = false;
    //ensure the password has a lower case character
    if (char >= "a" && char <= "z") {
      lower = true;
      break;
    }
  }
  //check for uppercharacter lower character and digit
  if (Uppercase === false) {
    alert("enter a strong password");
    return false;
  }

  if (lower === false) {
    alert("enter a strong password ");
    return false;
  }
  if (Digit === false) {
    alert("enter a strong password");
    return false;
  }

  // ensure the password and confirm password much
  if (password !== confirmPassword) {
    alert("passwords do not match");
    return false;
  }
  return true;
}

//validation for profile edit
function editProfileVAlidate() {
  /* Retrieving values from form fields using document.getElementById(""): This part of the statement is a 
    method call on the document object,The 'value' property is a property of input elements, such as <input>, */
  var name = document.getElementById("name").value;
  var mobileNumber = document.getElementById("mobileNumber").value;
  var email = document.getElementById("email").value;
  var address = document.getElementById("address").value;
  var IDNO = document.getElementById("IDNO").value;
  var DOB = document.getElementById("DOB").value;
  var gender = document.getElementById("gender").value;

  //ensure all fields are filled
  if (
    name === "" ||
    mobileNumber === "" ||
    email === "" ||
    address === "" ||
    IDNO === "" ||
    DOB === "" ||
    gender === ""
  ) {
    alert("fill all fields");
    return false;
  }

  //ensure the email is valid

  /*indexOf() method is used to find the index of the first occurrence of a
   specified value within a string*/
  if (email.indexOf("@") === -1 || email.indexOf(".") === -1) {
    alert("enter a valid email address");
    return false;
  }
  //ensure the ID number is valid

  if (isNaN(IDNO) || IDNO.length !== 8) {
    alert("enter a valid ID number");
    return false;
  }

  //ensure the mobilenumber is valid
  if (isNaN(mobileNumber) || mobileNumber.length !== 10) {
    alert("enter a valid Phone Number with ten digits");
    return false;
  }

  //ensure the dates of birth is valid

  /* Split the date string by '/' character to get year, month, and
     datesplit() method is used to split a string into an array of 
     substrings based on a specified separator */
  var parts = DOB.split("-");

  // Check if the date string contains three parts (year, month, )
  if (parts.length !== 3) {
    alert("enter a valid year of birth in YYYY-MM-DD format");
    return false;
  }

  // Parse day, month, and year as integers
  var year = parts[0];
  var month = parts[1];
  var day = parts[2];
  // Check if year month and day are valid numbers
  if (isNaN(year) || isNaN(month) || isNaN(day)) {
    alert("enter a valid year of birth in YYYY-MM-DD format");
    return false;
  }

  // Check if month is within valid range (1-12)
  if (month < 1 || month > 12) {
    alert("enter a valid year in YYYY-MM-DD format");
    return false;
  }

  // Check if day is within valid range based on month
  var daysInMonth = 31;
  if (month < 8 && month % 2 != 0) {
    daysInMonth = 31;
  }
  if (month > 7 && month % 2 != 1) {
    daysInMonth = 31;
  }
  if (month < 7 && month % 2 != 1) {
    daysInMonth = 30;
  }
  if (month > 7 && month % 2 != 0) {
    daysInMonth = 30;
  }
  if (month === 2) {
    if (year % 4 != 0) {
      daysInMonth = 29;
    } else {
      daysInMonth = 28;
    }
  }
  if (day < 1 || day > daysInMonth) {
    alert("enter valid date");
    return false;
  }
  // Check if year is within a reasonable range (e.g., between 1900 and 2100)
  if (year < 1950 || year > 2007) {
    alert("enter a valid year of birth in YYYY-MM-DD format");
    return false;
  }

  return true;
}

//booking validation
function bookingValidation() {
  /* Retrieving values from form fields using document.getElementById(""): This part of the statement is a 
    method call on the document object,The 'value' property is a property of input elements, such as <input>, */
  var name = document.getElementById("name").value;
  var IDNO = document.getElementById("IDNO").value;
  var mobileNumber = document.getElementById("mobileNumber").value;
  var email = document.getElementById("email").value;
  var destination = document.getElementById("destination").value;
  var dep_time = document.getElementById("departure_time").value;
  var current_location = document.getElementById("current_location").value;
  var departure_date = document.getElementById("departure_date").value;

  // ensure all fields are filled
  if (
    name === "" ||
    IDNO === "" ||
    mobileNumber === "" ||
    email === "" ||
    destination === "" ||
    dep_time === "" ||
    current_location === "" ||
    departure_date === ""
  ) {
    alert("all fields must be filled");
    return false;
  }
  //ensure the email is valid

  /*indexOf() method is used to find the index of the first occurrence of a
   specified value within a string*/
  if (email.indexOf("@") === -1 || email.indexOf(".") === -1) {
    alert("enter a valid email address");
    return false;
  }
  //ensure the ID number is valid

  if (isNaN(IDNO) || IdNo.length !== 10) {
    alert(" enter a valid ID number");
    return false;
  }

  //ensure the mobilenumber is valid
  if (isNaN(mobileNumber) || mobileNumber.length <= 10) {
    alert("enter a valid Phone Number ten digits");
    return false;
  }
  //ensure the year of birth is valid

  /* Split the date string by '/' character to get year, month, and
     datesplit() method is used to split a string into an array of 
     substrings based on a specified separator */
  var parts = departure_date.split("-");

  // Check if the date string contains three parts (year, month, )
  if (parts.length !== 3) {
    alert("enter a valid year in YYYY-MM-DD format");
    return false;
  }

  // Parse day, month, and year as integers
  var year = parts[0];
  var month = parts[1];
  var day = parts[2];
  // Check if year month and day are valid numbers
  if (isNaN(year) || isNaN(month) || isNaN(day)) {
    alert("enter a valid year of birth in YYYY-MM-DD format");
    return false;
  }

  // Check if month is within valid range (1-12)
  if (month < 1 || month > 12) {
    alert("enter a valid year of birth in YYYY-MM-DD format");
    return false;
  }

  // Check if day is within valid range based on month
  var daysInMonth = 31;
  if (month < 8 && month % 2 != 0) {
    daysInMonth = 31;
  }
  if (month > 7 && month % 2 != 1) {
    daysInMonth = 31;
  }
  if (month < 7 && month % 2 != 1) {
    daysInMonth = 30;
  }
  if (month > 7 && month % 2 != 0) {
    daysInMonth = 30;
  }
  if (month === 2) {
    if (year % 4 != 0) {
      daysInMonth = 29;
    } else {
      daysInMonth = 28;
    }
  }
  if (day < 1 || day > daysInMonth) {
    alert("enter a valid date in the year of birth");
    return false;
  }
  // Check if year is within a reasonable range 
  if (year < 2024 || year > 2024) {
    alert("enter a valid year of birth in YYYY-MM-DD format");
    return false;
  }

  return true;
}

//validate feedback form
function feedbackvalidation() {
  /* Retrieving values from form fields using document.getElementById(""): This part of the statement is a 
    method call on the document object,The 'value' property is a property of input elements, such as <input>, */
  var Feedback = document.getElementById("Feedback").value;

  if (Feedback === "") {
    alert("FILL ALL FIELDS");
    return false;
  }

  return true;
}

function AddStaff() {
  var name = document.getElementById("name").value;
  var lastname = document.getElementById("lname").value;
  var IDNO = document.getElementById("IDNO").value;
  var mobileNumber = document.getElementById("mobileNumber").value;
  var email = document.getElementById("email").value;
  var position = document.getElementById("position").value;
  var state = document.getElementById("state").value;
  var DOB = document.getElementById("DOB").value;
  var gender = document.getElementById("gender").value;
  var userName = document.getElementById("userName").value;

  //ensure all fields are filed
  if (
    name === "" ||
    userName === "" ||
    lastname === "" ||
    IDNO === "" ||
    mobileNumber === "" ||
    email === "" ||
    position === "" ||
    state === "" ||
    DOB === "" ||
   
    gender === ""
  ) {
    alert("FILL ALL FIELDS");
    return false;
  }
  //ensure the email is valid

  /*indexOf() method is used to find the index of the first occurrence of a
   specified value within a string*/
  if (email.indexOf("@") === -1 || email.indexOf(".") === -1) {
    alert("enter a valid email address");
    return false;
  }
  //ensure the ID number is valid

  if (isNaN(IDNO) || IDNo.length !== 8) {
    alert("please enter a valid ID number");
    return false;
  }

  //ensure the mobilenumber is valid
  if (isNaN(mobileNumber) || mobileNumber.length !== 10) {
    alert("enter a valid Phone Number with ten digits");
    return false;
  }
  //ensure the dates of birth is valid

  /* Split the date string by '/' character to get year, month, and
     datesplit() method is used to split a string into an array of 
     substrings based on a specified separator */
  var parts = DOB.split("-");

  // Check if the date string contains three parts (year, month, )
  if (parts.length !== 3) {
    alert("enter a valid year in YYYY-MM-DD format");
    return false;
  }

  // Parse day, month, and year as integers
  var year = parts[0];
  var month = parts[1];
  var day = parts[2];
  // Check if year month and day are valid numbers
  if (isNaN(year) || isNaN(month) || isNaN(day)) {
    alert("enter a valid year YYYY-MM-DD format");
    return false;
  }

  // Check if month is within valid range (1-12)
  if (month < 1 || month > 12) {
    alert("enter a valid year in YYYY-MM-DD format");
    return false;
  }

  // Check if day is within valid range based on month

  if (month < 8 && month % 2 != 0) {
    var daysInMonth = 31;
  }
  if (month > 7 && month % 2 != 1) {
    var daysInMonth = 31;
  }
  if (month > 2 && month < 7 && month % 2 != 1) {
    var daysInMonth = 30;
  }
  if (month > 7 && month % 2 != 0) {
    var daysInMonth = 30;
  }
  if (month === 2) {
    if (year % 4 != 0) {
      var daysInMonth = 29;
    } else {
      var daysInMonth = 28;
    }
  }
  if (day < 1 || day > daysInMonth) {
    alert("enter a valid date");
    return false;
  }
  // Check if year is within a reasonable range (e.g., between 1900 and 2100)
  if (year < 1950 || year > 2007) {
    alert("enter a valid year of birth in YYYY-MM-DD format");
    return false;
  }

  return true;
}

//validate add vehicle

function AddVehicle() {
  /* Retrieving values from form fields using document.getElementById(""): This part of the statement is a 
    method call on the document object,The 'value' property is a property of input elements, such as <input>, */
  var plateNO = document.getElementById("plateNO").value;
  var capacity = document.getElementById("capacity").value;
  var state = document.getElementById("state").value;

  //ensure all fields are filled
  if (plateNO === "" || capacity === "" || state === "") {
    alert("FILL ALL FIELDS");
    return false;
  }
  // ensure that capacity is in digits
  if (isNaN(capacity)) {
    alert("ENTER IN NUMBER FORMAT");
    return false;
  }
  return true;
}
