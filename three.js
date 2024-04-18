function updatestaff() {
    var staffId=document.getElementById("staffId").value;
    var phoneNo=document.getElementById("phoneNo").value;
    var email=document.getElementById("email").value;
    var state=document.getElementById("state").value;

   if( staffId==="" || phoneNo==="" || email==="" || state==="" ){
    alert("all field must be filled");
    return false;
   }
   if(isNaN(staffId)){
    alert("staffId should be a digit");
    return false;
}
if(email.indexOf("@") === -1|| email.indexOf(".") === -1){
    alert("Please enter a valid email address");
    return false;
}

    return true;
 }

 function updateVehicle() {
    var vehicleId=document.getElementById("vehicleId").value;
    var driverId= document.getElementById("driverId").value;
    var state= document.getElementById("state").value;
    
    if(vehicleId==="" || driverId==="" || state===""){
        alert("all fields must be filled");
        return false;
    }

    if(isNaN(vehicleId) || isNaN(driverId)){
        alert("Both driverId and VehicleId should be digits");
        return false;
    }

    return true;
 }

 function validatePaymentSelect() {
    var paymentMethod=document.getElementById("paymentMethod").value;
    var paymentStatement=document.getElementById("paymenStatement").value;

   if(paymentStatement==="" || paymentMethod===""){
    alert("all fields must be field");
    return false;
   }
    return  true;
 }

