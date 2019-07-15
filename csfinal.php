

<?php
    $host = "208.91.199.11:3306";
    $username = "flik";
    $password = "password";
    $db_name = "Flik";
    
    //connects to host, if that fails then dies.
    $connection=mysql_connect("$host", "$username", "$password")or die("cannot connect");
    
    //selects the database, if not found dies.
    mysql_select_db("$db_name")or die("cannot select DB");
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="stylesheet.css"/>
		<title></title>
        
        
        <script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css"
        href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
       
	</head>
<body>
<div id="header">
    <img src="milton.gif" width="432" height="100">
</div>
<!--<div class="leftCol"></div>-->
<div class="rightCol">
    <div id="title">
        <p class="big">Book Lookup!</p>
        <p>Input the date, name, and classification of a meal.</p>
        <p>(e.g. Date: 2013-11-17, Name of Meal: Tiramisu, Type of Meal: Dessert, Time of Meal: Lunch)</p>
    </div>
    <form action="csfinal.php" method="GET">
        <div id="fields" class="middle">
            
            <div id="mealNameField" class="input">Name of Meal:
                <input type="text" name="mealName" list="mealNames" autocomplete="off" placeholder="Enter Meal Name">
                    <datalist id="mealNames">                
                        <?php 
                            $mealNameStack = array();
                            $mealNameQuery = "SELECT DISTINCT mealName FROM menu";
                            $resultNames = mysql_query($mealNameQuery) or die(mysql_error());
                            while($row = mysql_fetch_array($resultNames)){
                              array_push($mealNameStack, $row['mealName']);
                            }
                            natsort($mealNameStack);
                            foreach($mealNameStack as $mealNames){
                              echo '<option value="' . $mealNames . '">';
                            }
                       ?>
                    </datalist>                
            </div>
                        
            <!--<div id="mealClassField" class="input">Type of Meal: <input type="text" name="mealClass" placeholder="Enter Meal Classification."></div>-->
            <div id="mealClassField" class="input">Type of Meal:<select name="mealClass" size="1">
                <?php 
                    $mealStack = array();
                    $mealQuery = "SELECT * FROM meal_types";
                    $result = mysql_query($mealQuery) or die(mysql_error());
	                while($row = mysql_fetch_array($result)){
		              array_push($mealStack, $row['meal_type']);
	                }

                    foreach($mealStack as $mealTypes){
    		          echo '<option value="' . $mealTypes . '">' . $mealTypes . '</option>';
	                }
	           ?>
            </select></div>  
            <div id="mealTimeField" class="input">Time of Meal:<select name="mealTime" size="1">
                <?php 
                    $mealTimeStack = array();
                    $mealTimeQuery = "SELECT * FROM meal_times";
                    $resultTimes = mysql_query($mealTimeQuery) or die(mysql_error());
	                while($row = mysql_fetch_array($resultTimes)){
		              array_push($mealTimeStack, $row['mealTime']);
	                }

                    foreach($mealTimeStack as $mealTimes){
    		          echo '<option value="' . $mealTimes . '">' . $mealTimes . '</option>';
	                }
	           ?>
            </select></div>              
            <div id="submitField" class="input"> <input type="submit" name="submit" value="ADD"></div>
        </div>
    </form>
    <?php
        if(gettype($_GET['date'])== "string"
            && gettype($_GET['mealName'])== "string" 
            && gettype($_GET['mealClass'])== "string" 
            && gettype($_GET['mealTime'])== "string"){
            
            $menuInsertSQL="INSERT INTO menu (date, mealName, mealClass, mealTime)
            VALUES
            ('$_GET[date]','$_GET[mealName]','$_GET[mealClass]', '$_GET[mealTime]')";
        
            $menuResult = mysql_query($menuInsertSQL) or die(mysql_error());
            //echo "1 record added";
            
            
/*            $nameSQL = "SELECT COUNT(mealName) FROM meals WHERE mealName = '$_GET[mealName]'";
            $nameResult = mysql_query($nameSQL) or die(mysql_error());
        
            if(mysql_fetch_array($nameResult)){
                $inputSQL = "INSERT INTO meals (mealName, mealType) 
                VALUES ('$_GET[mealName]', '$_GET[mealClass]')";
                $insertMealsResult = mysql_query($inputSQL) or die(mysql_error());
            }        
    */     
        
              

        }//long if statement end
    ?>
    <img src="flik.jpg" width="200" height="293"/>
</div>    
<div id = "bottomLink">
    <div id = "leftLink"><a href="http://flik.ma1geek.org/viewMeals.php">Flik Meal Viewer</a></div>
    <div id = "rightLink"><a href="http://flik.ma1geek.org/mealForm.php">Flik Meal Adder</a></div>
</div>     

</body>
</html>    
