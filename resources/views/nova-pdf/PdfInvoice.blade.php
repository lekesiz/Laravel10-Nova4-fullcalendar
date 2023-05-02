@php
    $company = \App\Models\Company::first();
@endphp
@foreach ($models as $model)
@php
$grouped_vat = [];
foreach ($model->articles as $article) {
    $vat_rate = $article->vat_rate;
    $quantity = $article->pivot->quantity;
    $selling_price = $article->selling_price;
    $total = $selling_price * $quantity;
    if (!array_key_exists($vat_rate, $grouped_vat)) {
        $grouped_vat[$vat_rate] = [
            'total_ht' => 0,
            'total_tva' => 0,
            'total_ttc' => 0
        ];
    }
    $grouped_vat[$vat_rate]['total_ht'] += $total;
    $grouped_vat[$vat_rate]['total_tva'] += $total * ($vat_rate / 100);
    $grouped_vat[$vat_rate]['total_ttc'] += $total * (1 + $vat_rate / 100);
}
@endphp
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{ $model->client->name }}</title>
        <style>
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            h1,h2,h3,h4,h5,h6,p,span,div { 
                font-family: DejaVu Sans; 
                font-size:10px;
                font-weight: normal;
            }

            th,td { 
                font-family: DejaVu Sans; 
                font-size:10px;
            }

            .panel {
                margin-bottom: 20px;
                background-color: #fff;
                border: 1px solid transparent;
                border-radius: 4px;
                -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
                box-shadow: 0 1px 1px rgba(0,0,0,.05);
            }

            .panel-default {
                border-color: #ddd;
            }

            .panel-body {
                padding: 15px;
            }

            table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 0px;
                border-spacing: 0;
                border-collapse: collapse;
                background-color: transparent;
            }

            thead  {
                text-align: left;
                display: table-header-group;
                vertical-align: middle;
            }

            th, td  {
                border: 1px solid #ddd;
                padding: 6px;
            }

            .well {
                min-height: 20px;
                padding: 19px;
                margin-bottom: 20px;
                background-color: #f5f5f5;
                border: 1px solid #e3e3e3;
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
            }
            .page-break {
                page-break-after: always; /* Bu sınıfı kullanan öğeden sonra sayfa kesme işlemi uygulanır */
            }
            .page-number {
                position: running(pageNumber); /* Sayfa numarasını sayfanın altında çalıştırın */
            }
            @page {
                size: A4; /* Sayfa boyutunu A4 olarak belirleyin */
                margin: 2cm; /* Kenar boşluklarını 2cm olarak belirleyin */
            }
            .page-container {
                display: flex;
                flex-direction: column;
                min-height: 100vh; /* Viewport'un tam yüksekliğini kullanın */
            }
         </style>
    </head>
    <body>
        <header>
            <div style="position:absolute; left:10pt; width:250pt;">
                <svg width="200px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 183.3 98.28"><defs><style>.cls-1{fill:url(#Dégradé_sans_nom_9);}</style><linearGradient id="Dégradé_sans_nom_9" x1="68.19" y1="-5.76" x2="67.28" y2="84.66" gradientUnits="userSpaceOnUse"><stop offset="0.14" stop-color="#d9242c"/><stop offset="0.29" stop-color="#7d1519"/><stop offset="0.45" stop-color="#240607"/><stop offset="0.52"/></linearGradient></defs><g id="Calque_3" data-name="Calque 3"><path class="cls-1" d="M119.06,77.72H101.87c0-.67,0-1.25,0-1.84,0-15,.06-29.92,0-44.88a44,44,0,0,0-.64-7.42c-.84-4.91-3.69-7.64-8.64-8.37a57.6,57.6,0,0,0-6.7-.51c-2.84-.08-5.68.05-8.52-.06-1.31,0-1.69.33-1.69,1.66.07,19.9.07,39.8.1,59.69v1.72H58.5V76q0-29.48.08-58.94c0-2.42,0-2.42-2.44-2.42H35.35c-2,0-2,0-2,2q0,29.39.1,58.79v2.23H16.33c0-.44-.09-.87-.09-1.31q0-36.72.08-73.45c0-1,.09-1.63,1.43-1.63,23,.05,46.06,0,69.09.11,5.76,0,11.59-.17,17.24,1.41C110.82,4.69,115,9.24,117.3,15.7a39.08,39.08,0,0,1,1.8,13c.05,15.8,0,31.61.05,47.42C119.15,76.59,119.1,77.08,119.06,77.72Z"/><path d="M88.15,96.86V89.33c0-1.64.07-3.29,0-4.93-.07-1.22.42-1.5,1.55-1.49,9,0,18-.06,27.07.06,3.81,0,6.44-1.76,8.54-4.62,2.65-3.61,3.43-7.81,3.46-12.17.06-7.43,0-14.86,0-22.29A24.66,24.66,0,0,1,152.4,19.3c9.61-.29,19.24-.12,28.86-.17.79,0,1.19.23,1.16,1.11-.14,4.09-.26,8.18-.32,12.27,0,1.3-.88,1.08-1.65,1.08-9,0-18,.14-27.06-.06-4.65-.11-7.52,2-9.47,5.92a17.88,17.88,0,0,0-2,8.46c.13,8,.18,16.06,0,24.09-.25,10.82-5.52,18.47-15.32,23a24.43,24.43,0,0,1-10.34,2q-13.38,0-26.77,0C89.07,97,88.69,96.91,88.15,96.86Z"/><rect x="0.88" y="86.81" width="81.97" height="8.25"/></g></svg>
            </div>
            <div style="margin-left:300pt; margin-top: 10px;">
                <b>Date: </b> {{ $model->created_at->format('d/m/Y') }}<br />
                <b>Facture N°: </b> {{ $model->reference }}
            </div>
        </header>
        <main class="page-break">
            <div style="clear:both; position:relative; margin-top: 130px;">
                <div style="position:absolute; left:0pt; width:250pt;">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{ $company->name }}<br />
                            {{ $company->address }}<br />
                            {{ $company->city }} {{ $company->postal_code }}
                            {{ $company->country }}<br />
                            {{ $company->phone_number }}<br />
                            {{ $company->email }}<br />
                            {{ $company->website }}<br />
                        </div>
                    </div>
                </div>
                <div style="margin-left: 300pt;">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <b>{{ $model->client->first_name }} {{ $model->client->last_name }}</b><br /><br />
                            @foreach ($model->client->ClientAddress as $ClientAddress)
                                @if($ClientAddress->billing_address)
                                    {{ $ClientAddress->address }}<br />
                                    {{ $ClientAddress->address_complement }}<br />
                                    {{ $ClientAddress->postal_code }}, {{ $ClientAddress->city }}<br />
                                    {{ $model->email }} {{ $model->mobile_phone }} 
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 50px;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Désignation</th>
                            <th>Quantité</th>
                            <th>TVA</th>
                            <th>HT</th>
                            <th>TTC</th>
                            <th>Total HT</th>
                            <th>Total TTC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($model->articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->designation }}</td>
                                <td>{{ $article->pivot->quantity }}</td>
                                <td>{{ $article->vat_rate }}</td>
                                <td>{{ number_format($article->selling_price, 2) }} €</td>
                                <td>{{ number_format($article->price_including_tax, 2) }} €</td>
                                <td>{{ number_format($article->selling_price * $article->pivot->quantity, 2) }} €</td>
                                <td>{{ number_format($article->price_including_tax * $article->pivot->quantity, 2) }} €</td>
                            </tr>
                            @if ($article->description)
                                <tr>
                                    <td></td>
                                    <td colspan="7">{{ $article->description }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                @if($model->client->notes)
                    <div style="position:absolute; left:0pt; width:250pt;">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                {{ $model->client->notes }}
                            </div>
                        </div>
                    </div>
                @endif
                <div style="margin-left: 300pt; margin-top: 50px;">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><b>Subtotal</b></td>
                                <td>{{ number_format($model->total_ht, 2) }} €</td>
                            </tr>
                            @foreach ($grouped_vat as $vat_rate => $totals)
                                <tr>
                                    <td>
                                        <b>
                                            TVA {{ $vat_rate }}%:
                                        </b>
                                    </td>
                                    <td>{{ number_format($totals['total_tva'], 2) }} €</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><b>TOTAL</b></td>
                                <td><b>{{ number_format($model->total_ttc, 2) }} €</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-top: 100px;">
                @if ($model->client->payment_conditions)
                    <br /><br />
                    <div class="well">
                        {{ $model->client->payment_conditions }}
                    </div>
                @endif
            <div>
        </main>
    </body>
</html>
@endforeach