<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture</title>
</head>
<style>
    /** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
.invoice-box {
				max-width: 640px;
				margin: auto;
				padding: 50px;
				border: 1px solid #cccccc;
				box-shadow: 0 0 40px rgba(0, 0, 0, 0.15);
				font-size: 15px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #444;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}
      .small-head{ text-transform: uppercase; font-weight: 700; font-size: 10px; line-height: 40px; letter-spacing: 1px;}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				/* padding-bottom: 40px; */
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information  {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
        padding: 10px 10px 8px 10px;

			}

			.invoice-box table tr.details td {
				padding-bottom: 80px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid rgb(170, 162, 162);
                 padding: 10px;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td {
				border-top: 2px solid #eee;
				font-weight: bold;
                padding-bottom: 40px;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information  td {
					width: 100%;
					display: block;
					text-align: center;

				}
			}
</style>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="" style="padding-bottom: 20px;">
                <td>     <img src="https://osborndesign.works/test/assets/Logotype=Color.svg" style="" /></td>
               <td></td>
               <td></td>
                <td colspan=""><strong>Facture N°: {{$paiement->numero_facture}}  </strong><br />
                    Date: {{ date('d-m-Y')}}<br />
                </td>

            </tr>

            <tr class="information">
                <td colspan="2">
                    Union des Restaurateurs et Hôtelier Sarl <br>
                    LOCATION-GERANCE DES HOTELS CASANOVA <br>
                    BP 621 Abeng/Tel:35 903 645 <br>
                    Cél: 45 67 87 25 / 03 13 04 90/09 55 62 18 <br>
                    Route d'Agnibilekro, derrière K.J
                </td>
                <td></td>
               <td></td>
               <td></td>

            </tr>

            <tr class="information" style="padding-bottom: 20px;">
                <td>Bar <img src="{{asset('uploads/images/check.jpg')}}" alt="check" style="margin-left: 20px;" width="20"></td>
               <td></td>
               <td></td>
                <td>Restau <img src="{{asset('uploads/images/checkEmp.png')}}" alt="check" style="margin-left: 20px;" width="20"></td>

            </tr>

            <tr class="heading">
                <td >QTE </td>
                <td style="text-align: center">Designation</td>
                <td>P.U</td>
                <td>Price</td>
            </tr>

            {{-- <tr class="item">
                <td>Photography</td>
                <td>Photography</td>
                <td>Photography</td>
                <td>$250.00</td>
            </tr> --}}

            <tr class="item">
                <td> {{$paiement->quantite}} </td>
                <td style="text-align: center;"> {{$paiement->type_dejeuner}} </td>
                <td> {{$paiement->prix_unitaire}} </td>
                <td> {{$paiement->montant_total}} </td>
            </tr>

            {{-- <tr class="item last">
                <td>Photography</td>
                <td>Photography</td>
                <td>Photography</td>
                <td>$250.00</td>
            </tr> --}}

            <tr class="total">
                <td ></td>
                <td style="text-align: left;">Chambre N°101</td>
                <td style="text-align: right;">Total: </td>

                <td>{{$paiement->montant_total}}</td>
            </tr>
        </table>
    </div>
</body>
</html>
