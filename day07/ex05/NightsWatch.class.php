<?php
class NightsWatch
{
	private $members = array();


	public function recruit($a)
	{
		array_push($this->members, $a);
	}

	public function fight()
	{
		foreach ($this->members as $m)
		{
			if ($m instanceof IFighter)
				$m->fight();
		}
	}
}
?>