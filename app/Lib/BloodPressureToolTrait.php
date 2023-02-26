<?php

namespace App\Lib;

trait BloodPressureToolTrait {

    private function isNormalSys():bool
    {
        return !((int)$this->sis > 135 || (int)$this->sis < 110);
    }

    private function isNormalDis():bool
    {
        return !((int)$this->dis > 85 || (int)$this->sis < 60);
    }

    public function isNormalPressure():bool
    {
        return $this->isNormalSys() && $this->isNormalDis();
    }

    public function isNormalPulse():bool
    {
        return !((int)$this->pulse > 80 || (int)$this->sis < 45);
    }
}
