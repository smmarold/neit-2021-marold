<!--Footer fort the bottom of each page. Formula for echoing the date is taken 
from the example code provided by Erik in the course modules.  -->

<hr />          
    <?php       
        $file = basename($_SERVER['PHP_SELF']);
        $mod_date=date("F d Y h:i:s A", filemtime($file));
        echo "File last updated $mod_date ";
        //date.timezone = "Europe/Athens"
    ?>
 
</body>

</html>