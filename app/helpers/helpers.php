<?php
function isInCart($id)
{
    $checked = false;
    if (isset($_SESSION["cart_item"])) {
        if (!empty($_SESSION["cart_item"])) {
            foreach ($_SESSION["cart_item"] as $k => $v) {
                if ($id == $v['id']) {
                    $checked = true;
                }
            }
        }
    } else {
        $checked = false;
    }

    return $checked;
}
