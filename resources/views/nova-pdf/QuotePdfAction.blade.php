@php
    $company = \App\Models\Company::first();
@endphp
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Devis</title>
        <style>
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            h2 { 
                font-family: DejaVu Sans; 
                font-size:20px;
                font-weight: normal;
            }

            h1,h3,h4,h5,h6,p,span,div { 
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
                margin-top: 100px;
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
        <header>
            <div style="position:absolute; left:10pt; width:250pt;">
                <img src="https://netlogiciel.s3.eu-west-3.amazonaws.com/logo.png" style="max-width: 200px;">
            </div>
            <div style="margin-left:300pt; margin-top: 10px;">
                <h2>DEVIS</h2>
                <b>Date: </b> {{ $model->created_at->format('d/m/Y') }}<br />
                <b>Devis N°: </b> {{ $model->reference }}
            </div>
        </header>
        <main>
            <div style="clear:both; position:relative; margin-top: 50px;">
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
            <div style="margin-top: 10px;">
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
                    <div style="position:absolute; left:0pt; width:250pt; margin-top:10px;">
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
            <div>
                @if ($model->client->payment_conditions)
                    <br /><br />
                    <div class="well">
                        {{ $model->client->payment_conditions }}
                    </div>
                @endif
            </div>
        </main>
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
        @endforeach
    </body>
</html>
