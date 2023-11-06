<?php
if (!empty($data['variables'])) {
    $variables = array();

    foreach ($data['variables'] as $key => $value) {
        $newarr = array('id' => $value->id, 'name' => $value->name, 'value' => $value->value);

        if (array_key_exists($value->type, $variables)) {
            array_push($variables[$value->type], $newarr);
        } else {
            $variables[$value->type] = array($newarr);
        }
    }

    $location = (isset($variables['location']) && !empty($variables['location'])) ? $variables['location'] : array();
    $collection = (isset($variables['collection']) && !empty($variables['collection'])) ? $variables['collection'] : array();
    $construction = (isset($variables['construction']) && !empty($variables['construction'])) ? $variables['construction'] : array();
    $material = (isset($variables['material']) && !empty($variables['material'])) ? $variables['material'] : array();
    $age = (isset($variables['age']) && !empty($variables['age'])) ? $variables['age'] : array();
    $shape = (isset($variables['shape']) && !empty($variables['shape'])) ? $variables['shape'] : array();
    $colors = (isset($variables['color']) && !empty($variables['color'])) ? $variables['color'] : array();
    $style = (isset($variables['style']) && !empty($variables['style'])) ? $variables['style'] : array();

    // print_r($variables);
}
