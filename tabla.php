<?php

class tabla
{
    private array $t;

    public function __construct(array $t)
    {
        $this->t = $t;
    }

    public function imprimeTabla()
    {
        echo htmlspecialchars($_SERVER["PHP_SELF"]);
        /*
        foreach ($this->t as $key => $value) {
            echo "{$key} => {$value} <br>";
        } */
    }
}

?>
