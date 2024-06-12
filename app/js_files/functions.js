function updatestaff() {
    var staffId=document.getElementById("staffId").value;
    var phoneNo=document.getElementById("phoneNo").value;
    var email=document.getElementById("email").value;
    var state=document.getElementById("state").value;

   if( staffId==="" || phoneNo==="" || email==="" || state==="" ){
    alert("Fill all fields!");
    return false;
   }
   if(isNaN(staffId)){
    alert("ID should be in number form!");
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
        alert("Fill all fields!");
        return false;
    }

    if(isNaN(vehicleId) || isNaN(driverId)){
        alert("ID in number form!");
        return false;
    }

    return true;
 }

 function validatePayment() {
    var paymentMethod=document.getElementById("paymentMethod").value;
    var paymentStatement=document.getElementById("paymenStatement").value;

   if(paymentStatement==="" || paymentMethod===""){
    alert("Fill all fields!");
    return false;
   }
    return  true;
 }

