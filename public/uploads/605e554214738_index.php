<?php
$obj = '{"action":"2M_RED_BTCUSD",
    "ticker":"{{ticker}}",
    "timenow":"{{timenow}}",
    "time":"{{time}}",
    "open":"{{open}}",
    "close":"{{close}}",
    "high":"{{high}}",
    "low":"{{low}}",
    "volume":"{{volume}}",
    "plot_0":"{{plot_0}}",
    "plot_1":"{{plot_1}}",
    "plot_2":"{{plot_2}}",
    "plot_3":"{{plot_3}}",
    "plot_4":"{{plot_4}}",
    "Plot_5":"{{plot_5}}",
    "plot_6":"{{plot_6}}",
    "plot_7":"{{plot_7}}",
    "plot_8":"{{plot_8}}",
    "plot_9":"{{plot_9}}",
    "plot_10":"{{plot_10}}",
    "plot_11":"{{plot_11}}",
    "plot_12":"{{plot_12}}",
    "plot_13":"{{plot_13}}",
    "plot_14":"{{plot_14}}",
    "Plot_15":"{{plot_15}}",
    "Plot_15":"{{plot_16}}",
    "Plot_15":"{{plot_17}}",
    "plot_15":"{{plot_18}}",
    "plot_16":"{{plot_19}}"}';
$data = json_decode($obj);
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");

foreach ($data as $key => $value) {
    // $arr[3] sera mis à jour avec chaque valeur de $arr...
    $val=str_replace(array( '{', '}' ), '',$value);

    echo "{$key} => {$val} <br>";
    fwrite($myfile, "{$key} => {$val}\n");

}
fclose($myfile);

?>