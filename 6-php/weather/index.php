<?php 
 
$weather = "";
 
$errorMessage = "";
 
  
if(array_key_exists('city', $_GET)) {
 
    
        
          $city = str_replace(' ', '-', $_GET['city']);
 
     $country = str_replace(' ', '-', $_GET['country']);
 
      
      $city = strtolower($city);
      
      $country = strtolower($country);
     
     $file_headers = @get_headers("https://www.timeanddate.com/weather/".$country."/".$city."/");
     
if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
    
    $errorMessage = "<b>The Weather Of That City Could Not Be Found!<br> Check The City & Country's Spelling Is Right<br>Check That City Is In That Country</b>";
 
} else {
 
    
    $forecastPage = file_get_contents("https://www.timeanddate.com/weather/".$country."/".$city);
    
$pageArray = explode('<section id=bk-focus class=bk-wt>' , $forecastPage);
 
if(sizeof ($pageArray) > 1) {
 
$secondPageArray = explode('width=320 height=160>' , $pageArray[1]);
 
if(sizeof ($secondPageArray) > 1) {
 
 
$weather = $secondPageArray[0];
    
    
    
} else {
    
     $errorMessage = "<b>The Weather Of That City Could Not Be Found!<br> Check The City & Country's Spelling Is Right<br>Check That City Is In That Country</b>";
    
}
 
} else {
    
    $errorMessage = "<b>The Weather Of That City Could Not Be Found!<br> Check The City & Country's Spelling Is Right<br>Check That City Is In That Country</b>";
    
}
 
} 
 
}
 
 
 
?>
 
<!DOCTYPE html>
 
<html lang="en">
    
  <head>
      
      <title>Weather Forecast</title>
      
      <link rel="icon" type="image/ico" href="title.jpg">
      
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  
  <style type="text/css">
      
      html { 
          
  background: url(background.jpg) no-repeat center center fixed; 
  
  -webkit-background-size: cover;
  
  -moz-background-size: cover;
  
  -o-background-size: cover;
  
  background-size: cover;
}
 
body {
    
    background:none;
    
}
 
.container {
    
    text-align:center;
    margin-top:180px;
    width:600px;
    
}
 
h1 {
    
    color:#E500FF;
    
}
 
label {
    
    margin-top:20px;
    
}
 
#weather {
    
    margin-top:40px;
}
 
 
      
  </style>
  
  </head>
  
  <body>
    
    <div class="container">
        
        <h1><u>What's The Weather?</u></h1>
        
        <form>
            
  <div class="form-group">
      
    <label for="city" style="color:darkgreen;">Enter A Name Of Any City!</label>
    
    <input type="text" class="form-control" id="city" name="city" placeholder="Eg. Washington D.C. , New York , Bangalore" value="<?php 
    
    if(array_key_exists('city', $_GET)) {
    
    echo $_GET['city']; 
    
    }
    
    ?>">
    
  </div>
 
  
  <div class="form-group">
  
      <label for="city" style="color:darkgreen;">Enter The Name Of That Country Whichs City You Have Choosen! Please Put The Name Of America As USA & The Name Of England As UK Otherwise You Will Get A Error! It Is Not Necessary To Put A Name Of City!</label>
    
    <input type="text" class="form-control" id="country" name="country" placeholder="Eg. USA , Italy" value="<?php 
    
    if(array_key_exists('country', $_GET)) {
        
    echo $_GET['country']; 
    
    }
    
    ?>">
    
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
  
  
</form>
 
    <div id="weather"><?php 
    
    if($weather) {
        
    echo   '<div class="alert alert-success" role="alert">
      <b> '.$weather.'
</b></div>';
        
    } else  if($errorMessage) {
        
    echo   '<div class="alert alert-danger" role="alert">
      <b> '.$errorMessage.'
</b></div>';
 
    } 
        
    
    ?></div>
    
        
    
    </div>
    
 
    
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
 
  </body>
 
</html>