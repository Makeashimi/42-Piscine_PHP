<?php
class Jaime extends Lannister
{
    public function sleepWith($gens)
    {
        if ($gens instanceof Tyrion)
            print("Not even if I'm drunk !".PHP_EOL);
        else if ($gens instanceof Cersei)
            print("With pleasure, but only in a tower in Winterfell, then.".PHP_EOL);
        else if ($gens instanceof Sansa)
            print("Let's do this.".PHP_EOL);
    }
}
?>