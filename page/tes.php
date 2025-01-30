<?php
function roundUpToAny($n,$x=15) {
    return (ceil($n)%$x === 0) ? ceil($n) : round(($n+$x/2)/$x)*$x;
}

echo roundUpToAny(15);
?>