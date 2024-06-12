function NotNullAndNan (){
   var GivenId=document.getElementById("searchid").value;
   if(GivenId ==="" ){
       alert("enter ID ");
       return false;

   }
   if(isNaN(GivenId)){
       alert("ENTER IN NUMBER FORMAT");
       return false;
   }
   return true;
}

function NotNull (){
   var GivenId=document.getElementById("searchid").value;
   if(GivenId==="" ){
       alert("enter ID ");
       return false;
   }
   
   return true;
}

function validateDate() {
   var GivenId=document.getElementById("searchid").value;

   /* Split the date string by '/' character to get year, month, and
     datesplit() method is used to split a string into an array of 
     substrings based on a specified separator */
     if(GivenId=== ""){
      alert("ENTER ID");
      return false;
     }

     var parts = GivenId.split('-');
    
     // Check if the date string contains three parts (year, month, )
     if (parts.length !== 3) {
         alert("enter a valid year in YYYY-MM-DD format");
         return false;
     }
     
     // Pass day, month, and year as integers
     var year =parts[0];
     var month =parts[1];
     var day = parts[2];
     // Check if year month and day are valid numbers
     if (isNaN(year) || isNaN(month) || isNaN(day)) {
         alert("enter a valid year YYYY-MM-DD format");
         return false;
     }
     
     // Check if month is within valid range (1-12)
     if (month < 1 || month > 12) {
         alert("enter a valid year YYYY-MM-DD format");
         return false;
     }
     
     // Check if day is within valid range based on month
    
     if (month<8 && (month%2) !=0){
        var daysInMonth=31;
     }
     if (month>7 && (month%2) !=1){
        var daysInMonth=31;
     }
     if (month!==2 && month<7 && (month%2) !=1){
       var  daysInMonth=30;
     }
     if (month>7 && (month%2) !=0){
        var daysInMonth=30;
     }
     if(month===2){
        if(year%4 !=0){
           var daysInMonth=29;
        }else{
         var daysInMonth=28;
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

function validatemonth() {
    
    var GivenId=document.getElementById("searchid").value;
    var secId=document.getElementById("search").value; 
    
      if(GivenId=== "" || secId===""){
       alert("ENTER ID");
       return false;
      }
      if(isNaN(GivenId) || isNaN(secId)){
        alert("ENTER IN NUMBER FORMAT");
        return false;
       }
       if(GivenId<1950 || GivenId>2024){
        alert("enter a valid year");
        return false;
       }
       if(secId<1 || secId>12){
        alert("enter a valid month");
        return false;
       }
 
       
      return true;
 
 }

 function updatestaff() {
    var staffId=document.getElementById("staffId").value;
    var phoneNo=document.getElementById("phoneNo").value;
    var email=document.getElementById("email").value;
    var state=document.getElementById("state").value;

   if( staffId==="" || phoneNo==="" || email==="" || state===""){
    alert("Fill all fields");
    return false;
   }
   if(isNaN(staffId)){
    alert("ID in number format");
    return false;
}
if(email.indexOf("@") === -1|| email.indexOf(".") === -1){
    alert("enter a valid email address");
    return false;
}

    return true;
 }

 function validatepayment() {
    var paymentMethod=document.getElementById("paymentMethod").value;
    var paymentStatement=document.getElementById("paymenStatement").value;

   if(paymentStatement==="" || paymentMethod===""){
    alert("Fill all fields");
    return false;
   }
    return  true;
 }

 function updateVehicle() {
    var vehicleId=document.getElementById("vehicleId").value;
    var driverId= document.getElementById("driverId").value;
    var state= document.getElementById("state").value;
    
    if(vehicleId==="" || driverId==="" || state===""){
        alert("Fill all fields");
        return false;
    }

    if(isNaN(vehicleId) || isNaN(driverId)){
        alert("ID in number format");
        return false;
    }

    return true;
 }
  
 