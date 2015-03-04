<?php

namespace Rx7\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class Rx7UserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
