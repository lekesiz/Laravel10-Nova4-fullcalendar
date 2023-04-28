<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;

class UpdateInvoiceStatusCommand extends Command
{
    protected $signature = 'update:invoice-status';

    protected $description = 'Update invoice status for overdue invoices';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = now();
        $invoices = Invoice::where('status', '=', 'Créé')->get();
        foreach ($invoices as $invoice) {
            $deadline = $invoice->created_at->addDays($invoice->client->payment_deadline);
            if ($now->greaterThan($deadline)) {
                $invoice->update(['status' => 'Non payé']);
            }
        }
    }
}
