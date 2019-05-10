<?php
function Parse($link, $start_position, $end_position) {
        $num1 = strpos($link, $start_position);
            if(!$num1) return "Error!"; 
            else $num1  += strlen($start_position);
        $num2 = substr($link, $num1);
        return substr($link, $num1, strpos($num2, $end_position));
    }

    $start_teg = "<div class=\"weather__temp\">";
    $stop_teg = "</div>";
    $link = file_get_contents("https://yandex.ru");

    echo "Температура Яндекс в Ростове-на-Дону: ".Parse($link,$start_teg,$stop_teg)."<br />";
 
 	$start_teg = "<span class=\"hours\" data-prop=\"hours\">";
    $stop_teg = "</span>";
    $link = file_get_contents("https://www.timeserver.ru/cities/ru/rostov-on-don");

    echo "Время TimeServer: ".Parse($link,$start_teg,$stop_teg).":";

 	$start_teg = "<span class=\"minutes\" data-prop=\"minutes\">";
    echo Parse($link,$start_teg,$stop_teg).":";

    $start_teg = "<span class=\"seconds\" data-prop=\"seconds\">";
    echo Parse($link,$start_teg,$stop_teg)."<br />";

    $start_teg = "<span data-prop=\"sunrise\">";
    echo "Восход: ".Parse($link,$start_teg,$stop_teg)."<br />";

    $start_teg = "<span data-prop=\"sunset\">";
    echo "Закат: ".Parse($link,$start_teg,$stop_teg)."<br />";

    $start_teg = "<h2>";
    $stop_teg = "</h2>";
    $link = file_get_contents("https://my-calend.ru/date-and-time-today");
    echo "Текущая дата с сайта my-calend.ru: ".Parse($link,$start_teg,$stop_teg)."<br />";

    echo "<br /><hr /><br />";

    echo "Данные с API: <br />";
    $link = file_get_contents("https://dog.ceo/api/breeds/image/random");
    $data = json_decode($link, TRUE);
    echo "Фотография с сайта https://dog.ceo: <br />";
    if ($data["status"] == "success") {
        echo "<img src=\"".$data["message"]."\" width=500 height=500>";    
    }
    else {
        echo "Error";
    }
    $link = file_get_contents("https://www.metaweather.com/api/location/2122265");
    $data = json_decode($link, TRUE);
    echo "<br />Погода в Москве на: ".$data["consolidated_weather"][0]["applicable_date"]."<br />";
    echo "Минимальная температура: ".$data["consolidated_weather"][0]["min_temp"]."<br />";
    echo "Максимальная температура: ".$data["consolidated_weather"][0]["max_temp"]."<br />";

    $link = file_get_contents("https://date.nager.at/api/v2/publicholidays/2019/RU");
    $data = json_decode($link, TRUE);
    echo "<br />Календарь праздничных дней<br />";
    for($i = 0; $i < count($data); $i++){
        echo $data[$i]["date"]." - ".$data[$i]["localName"]."<br />";
    }

    $link = file_get_contents("https://api.exchangeratesapi.io/history?start_at=2018-08-01&end_at=2018-09-01&symbols=RUB");
    $data = json_decode($link, TRUE);
    echo "<br />EUR к RUB<br />";
    foreach ($data["rates"] as $key => $value) {
        echo $key." : ".$value["RUB"]." RUB<br />";
    }