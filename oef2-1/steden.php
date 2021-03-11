<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "lib/autoload.php";

PrintHead();
PrintJumbo( $title = "Leuke plekken in Europa" ,
                        $subtitle = "Tips voor citytrips voor vrolijke vakantiegangers!" );
PrintNavbar();
?>

<div class="container">
    <div class="row">


<?php
    //toon messages als er zijn
    $container->getMessageService()->ShowErrors();
    $container->getMessageService()->ShowInfos();

    //export button
    $output ="";
    $output .= "<a style='margin-left: 10px' class='btn btn-info' role='button' href='export/export_images.php'>Export CSV</a>";
    $output .= "<div><br></div>";

    //get data
    $data = $container->getDBManager()->GetData( "select * from images" );

    foreach ($data as $key=>$row) {
        $apiKey = "c38fdb14afb5675f5595e8a614cac8f4";
        $city = $row['img_weather_location'];
        $url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $city . '&lang=nl&units=metric&APPID=' . $apiKey;;

        $restClient = new RESTClient($authentication = null);

        $restClient->CurlInit($url);
        $response = json_decode($restClient->CurlExec());

        $row['img_weather_description'] = $response->weather[0]->description;
        $row['img_weather_temp'] = round($response->main->temp);
        $row['img_weather_humidity'] = $response->main->humidity;

        $data[$key] = $row;
    }

    //get template
    $template = file_get_contents("templates/column.html");

    //merge
    $output .= MergeViewWithData( $template, $data );
    print $output;
?>

    </div>
</div>

</body>
</html>