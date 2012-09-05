<?php
/*
 * This file is part of SIGTOOLS2.
 * (c) 20011-2012 TOHOURI Romain-Rolland
 * http://www.tohouri.com
 * Tel: +225 03 44 49 44
 * Email: rtohouri@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* Creation: Sat Aug 25 16:43:05 GMT 2012
 * Class definition: Class that house the logic for TohouriUsersBundle forms
 * Class Path: /src/Tohouri/StoreBundle/TohouriUsersBundle.php
 */

namespace Tohouri\UsersBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TohouriUsersBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
