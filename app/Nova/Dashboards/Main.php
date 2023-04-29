<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Cards\Help;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\NewClients;
use Netz\OnlineUsers\OnlineUsers;
use App\Nova\Metrics\TotalInvoices;
use App\Nova\Metrics\OnlineUserCount;
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
            (new TotalInvoices)->width('1/4'),
            (new NewUsers)->width('1/4'),
            (new NewClients)->width('1/4'),
            (new OnlineUserCount)->width('1/4'),
            (new OnlineUsers)->width('1/4'),
        ];
    }
}
