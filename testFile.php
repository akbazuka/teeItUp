<!Bootstrap>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

<!Datepicker css>
<link href="cssFiles/addons/bootstrap-datepicker.standalone.css" rel="stylesheet">

<?php
$array = "10:25";
echo explode(":", $array)[0];
?>
      <div class="form-group">
        <label for="dueDate">Date due</label>
        <div class="input-group date">
            <input autocomplete="off" type="text" class="form-control datepicker" name="dueDate" id="dueDate" required>
        </div>
      </div>

<!jQuery>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!Datepicker js>
<script src="jsFiles/addons/bootstrap-datepicker.js"></script>

<script>
    
    var hawaiiTimeZone = new Date().toLocaleString("en-US", {timezone: "America/Hawaii"});
    hawaiiTimeZone = new Date(hawaiiTimeZone);
    hawaiiTimeZone = hawaiiTimeZone.toLocaleString();
    var hawaiiTime = hawaiiTimeZone.split(", ")[1];
    var hawaiiDate = hawaiiTimeZone.split(", ")[0];
    console.log(hawaiiTime);
    
  $('#dueDate').datepicker({
    format: "yyyy-mm-dd",
    startDate: '0d',
    endDate: '+6d',
    language: "en",
    autoclose: true
  });
</script>

</body>