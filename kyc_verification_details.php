<?php
ob_start();
SESSION_START();
    include 'final_header.php';
    include_once('common.php');
    page_protect();
    if (!isset($_SESSION['user_id']) && !isset($_SESSION['token'])) {
        logout();
    }
  
  
if(isset($_GET['curr']))
{
  $currencyname=base64_decode($_GET['curr']);

}

 $postData1 = array(
  "userMailId"=> $_SESSION["user_session"]
  );
 $context1 = stream_context_create(array(
  'http' => array(
    'method' => 'POST',
    'header' => "Content-Type: application/json\r\n",
    'content' => json_encode($postData1)
    )
  ));
 $response1 = file_get_contents($url_api.'/user/getAllDetailsOfUser', true, $context1);

 $responseData1 = json_decode(@$response1, true);
/* echo "<pre>";
 print_r($responseData1);
 echo "</pre>";*/
 @$datastatus=$responseData1['user']['verificationStatus'];
  @$data=$responseData1['user']['verificationDetails'][0];
/*if($datastatus=="1"){ 
  echo "hello";
}
else
{
  echo "else part";
}
die();*/
?>

<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<script type="text/javascript" src="js/city.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
background-color: #ffffff;
color: #006552 !important;
    margin: 25px auto;
    font-family: Raleway;
    padding: 14px;
    width: 50%;
    min-width: 300px;
        margin-bottom: 72px;
}
.fullwidth{
width: 99% !important;
}

h2 {
  text-align: center;
  margin: 0 0 0px 0 !important;
  color: #006552;
}

input {
  padding: 10px;
  width: 98%;
  font-size: 15px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
  color: #006552 !important;
}
.bank input{
width: 100%;
}
.document input{
width: 100%;
}
select {
  padding: 7px;
  width: 98%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
  color: #006552 !important;
  margin: 3px;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #006552;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}
.btunn {
  background-color: #006552;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}
label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 500;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
.high{ padding: 50px !important; }
label{ color: black; }
</style>
<body>
<div class="success"></div>
<script></script>


<form id="regForm" action="kyc_submit.php" method="post">

  <!-- One "tab" for each step in the form: -->
  <div class="tab contact">
    <div>
     <h2>Details</h2>
   </div>
    <label>First Name:<em style="color:red">*</em></label>
    <input type="text" placeholder="First name" oninput="this.className = ''" name="firstName" value="<?php echo $data['firstName'];?>" disabled="">
    <label>Last  Name:<em style="color:red">* </em> </label><input type="text" placeholder="Last name" oninput="this.className = ''" name="lastName"  value="<?= $data['lastName'];?>" disabled></p>
    <label>Middle Name:<em style="color:red"></em></label><input type="text" placeholder="Middle name" oninput="this.className = ''" name="middleName" value="<?= $data['middleName'];?>" disabled>
    <label>Address:<em style="color:red">* </em></label><input type="text" placeholder="Address1" oninput="this.className = ''" name="addLine1" value="<?= $data['addLine1'];?>" disabled></p>
    <label>Address:<em style="color:red"> </em></label><input type="text" placeholder="Address2" oninput="this.className = ''" name="addLine2" value="<?= $data['addLine2'];?>" disabled>
   
      <label>Country:<em style="color:red">* </em></label><input type="text" placeholder="Country" id="country" oninput="this.className = ''" name="country" value="<?= $data['country'];?>" disabled>

    <label>State:<em style="color:red">* </em></label><input type="text" id="state" placeholder="State" oninput="this.className = ''" name="state" value="<?= $data['state'];?>" disabled>
    <label>City:<em style="color:red">* </em></label><input type="text" id="city" placeholder="City" oninput="this.className = ''" name="city" value="<?= $data['city'];?>" disabled>
    
 


    <label>Contact No:<em style="color:red">* </em></label><input type="text" placeholder="Contact No" oninput="this.className = ''" name="mobileNumber" value="<?= $data['mobileNumber'];?>" disabled>
    <label>&nbsp;&nbsp;Pincode :<em style="color:red">* </em></label><input type="text" placeholder="Pincode" oninput="this.className = ''" name="pincode" value="<?= $data['mobileNumber'];?>" disabled>
   
    <div class="msg "></div></p>
  </div>
  <div class="tab bank">
    <h2 style="fon-size:20px !important; text-align: center !important;">Bank Details:</h2>
  <p><label>Account No :<em style="color:red">* </em></label>
    <input type="text" placeholder="Account No." oninput="this.className = ''" name="bankAccountNumber" value="<?= $data['bankAccountNumber'];?>" disabled></p>
    <p><label>Account Holder Name :<em style="color:red">* </em></label><input type="text" placeholder="Bank Account Holder Name:" oninput="this.className = ''" name="bankAccountHolderName" value="<?= $data['bankAccountHolderName'];?>" disabled></p>
  <p><label>Bank Name: :<em style="color:red">* </em></label><input type="text" placeholder="Bank Name:" oninput="this.className = ''" name="bankName" value="<?= $data['bankName'];?>" disabled ></p>
    <p><label>IFSC Code :<em style="color:red">*</em></label><input type="text" placeholder="IFSC Code: " oninput="this.className = ''" name="IFSCCode"value="<?= $data['IFSCCode'];?>" disabled></p>
  </div>
  <div class="tab document">:
    <p>
      <label for="upload" >Upload Document</label></p>
      <p>
      <a href="#" class="btn btn-default" id="openBtn">Upload Document</a>
      </p>
   
    <p><label>Tax Proof Number :<em style="color:red">* </em></label><input type="text" placeholder="Tax Proof Number" oninput="this.className = ''" name="taxProofNumber" value="<?= $data['taxProofNumber'];?>" disabled ></p>

    <p><label>Select ID Below  :<em style="color:red">* </em></label>
      <input type="" value="<?= $data['addressProofType'];?>" disabled" placeholder="Document Image" id="taxProofImage" oninput="this.className = ''" name="addressProofType"  class="fullwidth">
    

    </p>
    <p><label>Address Proof ID  :<em style="color:red">* </em></label>
      <input id="addressProofNumber" type="text" placeholder="Address Proof Number" oninput="this.className = ''" name="file2" value="<?= $data['addressProofType'];?>" disabled></p>
    <p>
      <!-- <label for="upload">Upload User Image</label> -->
   <!--   <input id="addressProofImage" type="file" placeholder="User Images" oninput="this.className = ''" name="file2" onchange="upload_document(this);"> -->
      <a href="#" class="btn btn-default" id="openBtn1">Upload Image User Profile</a>

      <input type="hidden" id="user_id" name="userId" value="<?php echo $_SESSION['user_id'];?>" >
    </p>
  </div>
   <div class="tab">Privacy:
    <p style="color:black;">Term And Condition All Fill:<input style="margin-bottom:30px !important; height: 20px; width: 40px;" class="high" placeholder="Privacy..." oninput="this.className = ''" name="privacy" type="checkbox"></p>
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button " id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>






<script>
var currentTab = 0;
showTab(currentTab);

function showTab(n) {
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  fixStepIndicator(n)
}
function nextPrev(n) {
  var x = document.getElementsByClassName("tab");
  if (n == 1 && !validateForm()) return false;
  x[currentTab].style.display = "none";
  currentTab = currentTab + n;
  if (currentTab >= x.length) {
    document.getElementById("regForm").submit();
    return false;
  }
  showTab(currentTab);
}

function validateForm() {

  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  for (i = 0; i < y.length; i++) {
    if (y[i].value == "") {
      y[i].className += " invalid";
      valid = false;
    }

  }
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid;
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  x[n].className += " active";
}


</script>
<script type="text/javascript">
$(document).ready(function (e) {
   api_url = '<?php echo $url_api;?>';
  $("#uploadForm").on('submit',(function(e) {
    e.preventDefault();  //If this method is called, the default action of the event will not be              triggered.
    $.ajax({
          url: api_url+"/verification/uploadAddressProofImage",
      type: "POST",
      data:  new FormData(this),
      contentType: false,     //when we send json file we write contentType: 'application/json'
          cache: false,
      processData:false,
      success: function(data)
        {
          alert("Successfull ");
      $("#targetLayer").html(data);
        },
        error: function(data) 
        {
          alert("asdfasdf " +data);
        }           
     });
  }));
});
</script>
<script type="text/javascript">
$(document).ready(function (e) {
  api_url = '<?php echo $url_api;?>';
  $("#uploadForm2").on('submit',(function(e) {
    e.preventDefault();  //If this method is called, the default action of the event will not be              triggered.
    $.ajax({
          url: api_url+"/verification/uploadTaxProofImageImage",
      type: "POST",
      data:  new FormData(this),
      contentType: false,     //when we send json file we write contentType: 'application/json'
          cache: false,
      processData:false,
      success: function(data)
        {
          alert("Successfull ")
      $("#targetLayer").html(data);
        },
        error: function(data) 
        {
          alert("asdfasdf " +data);
        }           
     });
  }));
});
</script>
<!-- http://localhost:1338/verification/uploadAddressProofImage -->
<?php
    include 'footer.php';
?>
<script>
 $('#openBtn').click(function(){
  $('#myModal').modal({show:true})
});
$('#openBtn1').click(function(){
  $('#myModal1').modal({show:true})
});

</script>
</body>
</html>

