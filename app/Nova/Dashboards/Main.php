<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Cards\Help;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\NewClients;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            // new Help,
            new NewUsers,
            new NewClients,
        ];
    }
}
