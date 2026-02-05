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

    public function test_calculate_with_positive_numbers(): void
    {
        // 3 * (2 + 3) + 400 = 3 * 5 + 400 = 415
        $result = $this->controller->calculate(2, 3);
        $this->assertEquals(415, $result);
    }

    public function test_calculate_with_zeros(): void
    {
        // 0 * (0 + 0) + 400 = 400
        $result = $this->controller->calculate(0, 0);
        $this->assertEquals(400, $result);
    }

    public function test_calculate_with_larger_numbers(): void
    {
        // 10 * (5 + 10) + 400 = 10 * 15 + 400 = 550
        $result = $this->controller->calculate(5, 10);
        $this->assertEquals(550, $result);
    }

    public function test_calculate_with_negative_numbers(): void
    {
        // -2 * (-3 + -2) + 400 = -2 * -5 + 400 = 10 + 400 = 410
        $result = $this->controller->calculate(-3, -2);
        $this->assertEquals(410, $result);
    }

    public function test_calculate_with_mixed_sign_numbers(): void
    {
        // 5 * (-3 + 5) + 400 = 5 * 2 + 400 = 410
        $result = $this->controller->calculate(-3, 5);
        $this->assertEquals(410, $result);
    }
}
