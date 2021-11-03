<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
    <style>

        *{
            margin:0;
            padding:0;
        }

        body{
            width: 100%;
            height: 100%;
        }

        

        .logo{
            width:80px;
            height:80px;
            color:#000;
            border-radius: 5px;
        }

        .col-container{
            display: table;
            width: 100%;
            font-size:2rem;
        }

        .col {
            display: table-cell;
            padding: 30px;
            font-size:20px;
        }
        .text{
            font-size:18px;
        }
        .mb-2{
            margin-bottom:10px;
        }
        .mb-3{
            margin-bottom:5px;
        }

        .mb-5{
            margin-bottom:20px;
        }

        .heading-title{
            font-size:25px;
            color:brown;
            font-weight: bolder;
        }

        .col p {
            font-size: 1rem;
        }

        .info-head{
            font-weight:bolder;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #eef;
            
        }
        table thead {
            background:#f1f2f3;
        }

        td {
            padding: 0.4em;
            border-bottom: 1px solid #eef;
        }

        .total{
            background:#FAFAFA;
            font-weight:bolder;
        }




    </style>

<body>

    <div class="invoice-00002">

        <div class="col-container mb-5">
            <div class="col">
              <div class="logo" style="display: inline-block">
                <img src="data:image/jpeg;base64,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" alt="" srcset="">
              </div>
              <div class="logo"style="display:inline-block; margin-left:18px;">
                <img src="data:image/jpeg;base64,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" alt="" srcset="">
              </div>
              
              
            </div>

            <div style="background:white" class="col"></div>
            <div style="background:white" class="col"></div>
            <div style="background:white" class="col"></div>
            <div style="background:white" class="col"></div>
            
            <div class="col text">
             <p>6 Okigwe Rd, opp. Civil Defense Corps Office, Owerri</p>
             <p>PMB:  460108</p>
             <p>https://iirs.im.gov.ng</p>
             <p>info@birs.bu.gov.ng</p>
            </div>
          </div>

          <div class="col-container">
                <div class="col">
                    <div style="margin:0" class="heading-title">
                        Invoice:
                    </div>
                </div>

                <div style="background:white" class="col"></div>
                <div style="background:white" class="col"></div>
                <div style="background:white" class="col"></div>
                <div style="background:white" class="col"></div>
                
                <div style="background:white" class="col text"></div>
            </div>

            <div class="col-container mb-3">

                <div class="col">
                    <div class=" mb-3">
                        <strong> Vehicle Information:</strong>
                    </div>
                    <p class="mb-2"><span class="info-head">Owner's Name</span>: {{ $vehicle->owner_fname . " ". $vehicle->owner_surname }}</p>
                    <p class="mb-2"><span class="info-head">Owner's Email</span>: {{ $vehicle->owner_email ?? "" }}</p>
                    <p class="mb-2"><span class="info-head">Phone Number</span>: {{ $vehicle->owner_phone }}</p>
                    <p class="mb-2"><span class="info-head">Engine Number</span>: {{ $vehicle->engine_number ?? "" }}</p>
                    <p class="mb-2"><span class="info-head">License Number</span>: {{ $vehicle->owner_license_number ?? "" }}</p>
                    <p class="mb-2"><span class="info-head">Chassis Number</span>: {{ $vehicle->chassis_number ?? "" }}</p>
                </div>

                <div style="background:white" class="col"></div>
                <div style="background:white" class="col"></div>
                
                <div style="background:white" class="col text">
                    <p class="mb-2"><span class="info-head">From</span>: Imo State Government, Nigeria</p>
                    <p class="mb-2"><span class="info-head">Invoice No</span>: {{ $vehicle->invoice_nos }}</p>
                    <p class="mb-2"><span class="info-head">Created At</span>: {{ $invoice["date_created"] }}</p>
                    <p class="mb-2"><span class="info-head">Transaction Ref. </span>: {{ $invoice["trans_ref"] }}</p>
                    <p class="mb-2"><span class="info-head">Status</span>: {{ $invoice["status"] }}</p>
                    <p class="mb-2"><span class="info-head">Service</span>: {{ $invoice["service"] }}</p>
                    <p class="mb-2"><span class="info-head">Generated By</span>: {{ $invoice["agent"] }}</p>
                  
                </div>
            </div>

            <div class="col-container">
                <div class="col">
                    <table>
                        <thead>
                            <tr>
                                <td>S/N</td>
                                <td>Description</td>
                                <td>Amount (<del style="text-decoration-style: double;">N</del>)
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ( $invoice_breakdown as $breakdown )
                                <tr>
                                    <td>{{ $breakdown->iteration }}</td>
                                    <td>{{ $breakdown->title }}</td>
                                    <td>{{ $breakdown->amount }}</td>
                                </tr>
                            @endforeach
                            
                            <tr class="total">
                                <td colspan="2">Sub-total</td>
                                <td> <del style="text-decoration-style: double;">N</del> {{ $invoice->total_amount }}</td>
                            </tr>
                            <tr class="total">
                                <td colspan="2">Grand Total</td>
                                <td> <del style="text-decoration-style: double;">N</del> {{ $invoice->total_amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
               
            </div>

    </div>
 
</body>
</html>