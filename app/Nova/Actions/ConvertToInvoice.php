<?php

namespace App\Nova\Actions;

use Illuminate\Support\Str;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Http\Requests\NovaRequest;

class ConvertToInvoice extends Action
{
    use InteractsWithQueue, Queueable;

    public function name()
    {
        return __('Convertir en facture');
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        if (count($models) > 1) {
            return Action::danger("Vous ne pouvez convertir qu'un seul devis en facture à la fois.");
        }
        
        $quote = $models->first();
        
        // Daha önce "Facturé" durumuna getirilmiş tekliflerin tekrar işleme alınmasını önleme
        if ($quote->status === 'Facturé') {
            return Action::danger('Le devis n°' . $quote->id . ' a déjà été converti en facture.');
        }
        
        $invoice = Invoice::create([
            'client_id' => $quote->client_id,
            'object' => '(Converti à partir du devis n°' . $quote->reference . ')' . $quote->object,
            'status' => 'Crée',
            'total_ht' => $quote->total_ht,
            'total_ttc' => $quote->total_ttc,
        ]);
        
        foreach ($quote->articles as $article) {
            $invoice->articles()->attach($article->id, ['quantity' => $article->pivot->quantity]);
        }
        
        $quote->status = 'Facturé';
        $quote->save();
        
        return Action::message('Le devis a été converti en facture avec succès. Vérifiez la facture n°' . $invoice->reference . '.');
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }
}
