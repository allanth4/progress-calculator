<?php

namespace Tests\Unit;

use App\Http\Controllers\ProgressController;
use PHPUnit\Framework\TestCase;

class ProgressControllerTest extends TestCase
{
    private ProgressController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new ProgressController();
    }

}
