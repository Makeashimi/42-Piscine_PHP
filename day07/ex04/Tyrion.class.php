<?php
class Tyrion extends Lannister
{
    public function sleepWith($gens)
    {
        if ($gens instanceof Jaime || $gens instanceof Cersei)
            print("Not even if I'm drunk !".PHP_EOL);
        else if ($gens instanceof Sansa)
            print("Let's do this.".PHP_EOL);
    }
}
?>