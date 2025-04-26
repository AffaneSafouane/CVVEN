<?php

function safe($value)
{
    return is_null($value) ? '' : $value;
}
