<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Text;

class CreditNotePdfAction extends Action
{
    use InteractsWithQueue, Queueable;

    public function name() {
        return __('PDF');
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        $data = [
            'models' => $models,
        ];
        $options = new Options(config('dompdf.options'));
        $dompdf = new Dompdf($options);
        $html = view('nova-pdf.CreditNotePdfAction', $data)->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfOutput = $dompdf->output();
        $firstModel = $models->first();
        $reference = $firstModel->reference;
        $today = date('Y-m-d'); 
        $filename = $reference . '_' . $today . '.pdf';
        $disk = 's3';
        Storage::disk($disk)->put($filename, $pdfOutput);
        $url = Storage::disk($disk)->temporaryUrl($filename, now()->addMinutes(5));
        return Action::download($url, $filename);
    }

    public function fields(NovaRequest $request)
    {
        return [];
    }
}
