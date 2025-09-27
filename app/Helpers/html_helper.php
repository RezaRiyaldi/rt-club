<?php

function generateInput($value, $name, $selectedOption = null)
{
    $parts = explode(',', $value);

    if (count($parts) == 1 && strpos($parts[0], '-') === false) {
        $part = trim($parts[0]);
        if (strlen($part) == 1) {
            return "<input type='text' name='$name' value='$part' readonly class='form-control'>";
        }
    }

    $allOptions = [];
    foreach ($parts as $part) {
        $part = trim($part);
        $range = explode('-', $part);

        if (count($range) == 1) {
            $allOptions[] = $part;
        } else {
            $start = trim($range[0]);
            $end = trim($range[1]);
            $options = range($start, $end);
            $allOptions = array_merge($allOptions, $options);
        }
    }

    $allOptions = array_unique($allOptions);
    sort($allOptions);

    $selectOptions = '';
    $selected = '';
    foreach ($allOptions as $option) {
        if ($selectedOption == $option) {
            $selected = 'selected';
        }

        $selectOptions .= "<option $selected value='$option'>$option</option>";
    }
    $inputHTML = "<select name='$name' class='form-select'>" . $selectOptions . "</select>";

    return $inputHTML;
}
