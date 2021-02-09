<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

PrintHead();
PrintJumbo( $title = "Stad OO style");
?>

<div class="container">
    <div class="row">

        <?php

        if ( ! is_numeric( $_GET['img_id']) ) die("Ongeldig argument " . $_GET['img_id'] . " opgegeven");

        $rows = GetData( "select * from images where img_id=" . $_GET['img_id'] );

        if ( $rows ) {
            $row = $rows[0];

            //data to object
            $city = new city();
            $city->setImgId($row['img_id']);
            $city->setImgFilename($row['img_filename']);
            $city->setImgTitle($row['img_title']);
            $city->setImgWidth($row['img_width']);
            $city->setImgHeight($row['img_height']);
            $city->setLanId($row['img_lan_id']);

            //get template
            $template = file_get_contents("templates/column_full.html");

            //merge
            $output = $template;

            $output = str_replace( "@img_id@", $city->getImgId(), $output );
            $output = str_replace( "@img_filename@", $city->getImgFilename(), $output );
            $output = str_replace( "@img_title@", $city->getImgTitle(), $output );
            $output = str_replace( "@img_width@", $city->getImgWidth(), $output );
            $output = str_replace( "@img_height@", $city->getImgHeight(), $output );
            $output = str_replace( "@img_lan_id@", $city->getLanId(), $output );

            //object to array
            $properties = $city->toArray2();
            $properties['title'] = $city->getImgTitle();

            foreach ($properties as $key => $value) {
                $output = str_replace("@img_$key@", $value, $output);
            }

            //output
            print $output;
        }

        ?>

    </div>
</div>

</body>
</html>