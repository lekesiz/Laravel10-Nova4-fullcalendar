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
                <svg version="1.0" width="100px"  viewBox="0 0 604.913 751.988" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
                    <g transform="translate(0.000000,978.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                        <path d="M4577 9755 c-173 -48 -317 -195 -356 -365 -15 -65 -13 -177 4 -243 31 -118 95 -209 195 -277 40 -27 64 -53 79 -82 l20 -43 -5 -2595 -5 -2595 -52 -8 c-91 -14 -144 -4 -182 34 -34 33 -271 454 -1135 2004 -233 418 -530 949 -660 1180 -130 231 -348 620 -484 865 -136 245 -260 458 -274 473 -15 16 -45 38 -67 50 -38 20 -54 22 -315 22 -202 0 -285 -3 -312 -13 -47 -17 -95 -71 -105 -119 -4 -21 -8 -1291 -8 -2823 l0 -2785 25 -45 c38 -67 87 -92 176 -88 60 3 77 8 109 32 20 16 46 47 56 70 18 40 19 125 19 2703 l0 2663 28 7 c76 20 140 -2 170 -58 48 -93 641 -1158 1495 -2684 677 -1209 1014 -1802 1039 -1827 20 -20 54 -41 75 -47 52 -15 605 -14 658 0 56 16 92 44 118 92 l22 42 0 2730 0 2730 23 42 c12 24 45 60 75 81 155 115 218 265 195 465 -22 191 -173 362 -363 412 -71 18 -192 18 -258 0z m228 -320 c113 -66 120 -238 12 -316 -80 -58 -182 -45 -251 31 -74 82 -69 186 12 263 63 60 148 69 227 22z" style="fill: rgb(0, 157, 255);"/>
                        <path d="M1001 8948 c-394 -42 -731 -340 -837 -743 l-27 -100 -1 -2635 -1 -2635 22 -40 c41 -77 88 -105 177 -105 67 0 134 40 162 96 19 38 19 97 24 2664 5 2473 6 2628 23 2685 62 210 203 351 412 411 89 25 617 32 725 10 148 -31 296 -130 381 -253 16 -23 182 -316 368 -650 326 -587 831 -1490 1402 -2506 l274 -488 7 588 c3 323 4 1052 0 1618 -6 1185 -16 1071 97 1153 130 94 200 221 209 373 8 153 -36 274 -138 377 -190 192 -482 201 -681 23 -167 -149 -213 -377 -117 -581 24 -51 53 -87 133 -165 73 -72 106 -111 115 -140 11 -32 12 -200 6 -878 -7 -762 -11 -900 -28 -871 -3 5 -146 261 -318 569 -654 1173 -974 1742 -1003 1785 -144 215 -323 346 -553 406 -77 20 -130 27 -239 30 -313 9 -524 9 -594 2z m3004 -347 c146 -66 153 -282 13 -350 -124 -60 -273 22 -285 156 -4 39 1 58 24 103 23 44 39 59 82 82 62 33 109 35 166 9z" style="fill: rgb(0, 157, 255);"/>
                        <path d="M5340 8581 c-89 -29 -141 -60 -206 -125 -118 -118 -167 -286 -133 -448 27 -124 91 -220 203 -303 41 -30 78 -66 85 -82 8 -21 11 -559 9 -2198 -3 -2025 -4 -2174 -20 -2227 -49 -162 -151 -291 -283 -360 -135 -70 -144 -71 -512 -76 -215 -2 -358 0 -404 8 -148 22 -284 102 -374 220 -24 30 -226 384 -450 785 -461 826 -1302 2323 -1451 2582 l-99 172 -6 -242 c-11 -421 -10 -3309 1 -3366 19 -102 82 -151 193 -151 78 0 120 24 157 90 l25 45 5 1065 5 1065 66 -110 c136 -226 407 -703 879 -1545 155 -278 302 -534 326 -570 98 -148 227 -262 377 -335 112 -54 217 -82 356 -95 136 -13 577 -13 701 0 433 45 743 306 863 728 l22 77 5 2215 c4 1766 8 2220 18 2237 7 12 43 47 81 77 37 30 82 72 98 93 120 152 136 367 41 545 -57 107 -191 210 -309 237 -70 16 -207 12 -269 -8z m242 -303 c53 -26 90 -86 96 -153 8 -97 -64 -189 -165 -210 -101 -21 -222 85 -223 196 0 48 43 129 82 156 65 44 138 48 210 11z" style="fill: rgb(0, 157, 255);"/>
                    </g>
                </svg>
            </div>
            <div style="margin-left:300pt; margin-top: 10px;">
                <b>Date: </b> {{ $model->created_at->format('d/m/Y') }}<br />
                <b>Avoir N°: </b> {{ $model->reference }}
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
                                <td>- {{ number_format($model->total_ht, 2) }} €</td>
                            </tr>
                            @foreach ($grouped_vat as $vat_rate => $totals)
                                <tr>
                                    <td>
                                        <b>
                                            TVA {{ $vat_rate }}%:
                                        </b>
                                    </td>
                                    <td>- {{ number_format($totals['total_tva'], 2) }} €</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td><b>TOTAL</b></td>
                                <td><b>- {{ number_format($model->total_ttc, 2) }} €</b></td>
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
            </div>
        </main>
    </body>
</html>
@endforeach