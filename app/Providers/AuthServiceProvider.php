<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\BloodPressure;
use App\Models\IndexGlucose;
use App\Models\Medicament;
use App\Models\MySugar;
use App\Policies\BloodPressurePolicy;
use App\Policies\IndexGlucosePolicy;
use App\Policies\MedicamentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        IndexGlucose::class => IndexGlucosePolicy::class,
        MySugar::class => MySugarPolicy::class,
        BloodPressurePolicy::class => BloodPressure::class,
        MedicamentPolicy::class => Medicament::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
