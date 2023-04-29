<?php

namespace App\Nova\Actions;

use Illuminate\Support\Str;
use App\Models\CreditNote;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Http\Requests\NovaRequest;

class ConvertToCreditNote extends Action
{
    use InteractsWithQueue, Queueable;

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
            return Action::danger("Vous ne pouvez convertir qu'une seule facture en avoir à la fois.");
        }
        
        $invoice = $models->first();
        
        $creditNote = CreditNote::create([
            'reference' => Str::random(8),
            'client_id' => $invoice->client_id,
            'object' => '(Converti à partir de la facture n°' . $invoice->reference . ')' . $invoice->object,
            'status' => 'En Cours',
            'total_ht' => -$invoice->total_ht,
            'total_ttc' => -$invoice->total_ttc,
        ]);
        
        foreach ($invoice->articles as $article) {
            $creditNote->articles()->attach($article->id, [
                'quantity' => $article->pivot->quantity,
                'price' => -$article->price,
            ]);
        }

        $invoice->status = 'Converti en avoir';
        $invoice->save();
        
        return Action::message("La facture a été convertie en avoir avec succès. Vérifiez l'avoir n°" . $creditNote->id . ".");
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
