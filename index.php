

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
$str=$_POST['qrstring'];
$status="";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM emp WHERE name='$str' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $status="Valid";
} else {
    $status="Invalid";
}

mysqli_close($conn);
}
?>
<html>

<head>
  <title>qr code scanner udit❤</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<script type="text/javascript" src="qr_packed.js"></script>
<style>
.topo{
  
  margin-top: 100px;
}
body, input {font-size:14pt}
input, label {vertical-align:middle}
.qrcode-text {padding-right:1.7em; margin-right:0}
.qrcode-text-btn {display:inline-block;
 background:url('1.png') 50% 50% no-repeat; height:1em; width:1.7em; margin-left:-1.7em; cursor:pointer}
.qrcode-text-btn > input[type=file] {position:absolute; overflow:hidden; width:1px; height:1px; opacity:0}
</style>

<script>

  function openQRCamera(node) {
  var reader = new FileReader();
  reader.onload = function() {
    node.value = "";
    qrcode.callback = function(res) {
      if(res instanceof Error) {
        alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
      } else {
        node.parentNode.previousElementSibling.value = res;
      }
    };
    qrcode.decode(reader.result);
  };
  reader.readAsDataURL(node.files[0]);
}

function showQRIntro() {
  return confirm("Use your camera to take a picture of a QR code.");
}

</script>
</head>

<body style="background-image: url('bg.png');">
  <center>
<form action="index.php" method="post">
  <input type=text size=16 placeholder="Tracking Code" class="qrcode-text topo" name="qrstring"><label class="qrcode-text-btn topo" ><input type=file accept="image/*" capture=environment onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex=-1></label> 
<input type="submit" value="Go"  class="topo" name="submit">
</form>
<h3 style="color: blue;">click on qr image to scan</h3><br>
<h3>the scanned data will appear in text field</h3>
<?php
if(isset($status)){
echo "Your QR code is  ".$status;
}
?>
</center>
</body>
</body>
</html>

