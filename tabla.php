<?php

class tabla
{
    // Guarda el nombre de la tabla
    private string $name;
    private array $data;

    public function __construct(string $n, $sql)
    {
        $this->name = $n;
        $this->data = $sql->fetchAll();
    }

    public function imprimeTabla()
    {
        // echo htmlspecialchars($_SERVER["PHP_SELF"]);
        $primer = $this->data[0];
        echo '<table border="1">';
        echo '<tr>';
        foreach ($primer as $key => $val) {
            if (is_string($key)) { // Nombre de columna
                echo "<td>{$key}</td>";
            }
        }
        echo '</tr>';

        foreach ($this->data as $row) {
            echo '<tr>';
            foreach ($row as $k => $v) {
                if (is_int($k)) {
                    echo "<td>{$v}</td>";
                }
            }
            echo '</tr>';
        }
        echo '</table>';
    }
}

?>
