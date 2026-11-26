<?php
declare(strict_types=1);

function validate_required(string $v): bool
{
    // TODO: return true when $v is not empty after trimming
    if(trim($v) !== ''){
        return true;
    }
    return false;
}

function validate_email(string $v): bool
{
    // TODO: return true when $v is a valid email address
    if(filter_var($v, FILTER_VALIDATE_EMAIL) !== false){
        return true;
    }
    return false;
}

function validate_length(string $v, int $min, int $max): bool
{
    // TODO: return true when mb_strlen($v) is within [$min, $max]
    if(strlen($v) >= $min && strlen($v) <= $max){
        return true;
    }
    return false;
}
?>
