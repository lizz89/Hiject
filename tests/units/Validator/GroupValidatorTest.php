<?php

/*
 * This file is part of Hiject.
 *
 * Copyright (C) 2016 Hiject Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../Base.php';

use Hiject\Validator\GroupValidator;

class GroupValidatorTest extends Base
{
    public function testValidateCreation()
    {
        $groupValidator = new GroupValidator($this->container);

        $result = $groupValidator->validateCreation(array('name' => 'Test'));
        $this->assertTrue($result[0]);

        $result = $groupValidator->validateCreation(array('name' => ''));
        $this->assertFalse($result[0]);
    }

    public function testValidateModification()
    {
        $validator = new GroupValidator($this->container);

        $result = $validator->validateModification(array('name' => 'Test', 'id' => 1));
        $this->assertTrue($result[0]);

        $result = $validator->validateModification(array('name' => 'Test'));
        $this->assertFalse($result[0]);
    }
}
