<?php

namespace App\Nova\Actions;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Laravel\Nova\Fields\ActionFields;
use Padocia\NovaPdf\Actions\ExportToPdf;

class PdfInvoice extends ExportToPdf
{
    public function name()
    {
        return __('PDF');
    }
    /**
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     *
     * @return \Illuminate\View\View
     */
    public function preview(ActionFields $fields, Collection $models) : View
    {
        $resource = $this->resource;
        return view('nova-pdf.PdfInvoice', compact('models','resource'));
    }

}
