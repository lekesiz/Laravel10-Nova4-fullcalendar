<?php

namespace App\Nova\Actions;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Laravel\Nova\Fields\ActionFields;
use Padocia\NovaPdf\Actions\ExportToPdf;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class PdfQuote extends ExportToPdf
{
    public function __construct()
    {
        $this->withDisk('s3');
    }
    
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
        return view('nova-pdf.PdfQuote', compact('models','resource'));
    }

    protected function getDownloadUrl(): string
    {
        if ($this->getDisk() === 's3') {
            return Storage::disk('s3')->temporaryUrl(
                $this->getFilename(),
                now()->addMinutes($this->downloadUrlExpirationTime),
                ['ResponseContentType' => 'application/pdf']
            );
        }

        return URL::temporarySignedRoute('laravel-nova-pdf.download', now()->addMinutes($this->downloadUrlExpirationTime), [
            'path'     => $this->getFilePathFromDisk($this->getFilename()),
            'filename' => $this->getFilename(),
        ]);
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        $this->handleView($fields, $models);

        $this->addDataToView('stylesContents', $this->allStylesContents());

        $this->saveAsPdf();

        $url = Storage::disk($this->getDisk())->url($this->getFilename()); // PDF dosyasının S3 URL'sini al

        return Action::download($url, $this->getFilename()); // Kullanıcıya PDF dosyasını indirt
    }
}
