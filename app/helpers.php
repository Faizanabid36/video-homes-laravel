<?php

function dashboardChart($labels, $label, $data)
{
    $Data = [];
    $Data['labels'] = $labels;
    $datasets['data'] = $data;
    $datasets['label'] = $label;
    $Data['datasets'] = [$datasets];
    return $Data;
}
