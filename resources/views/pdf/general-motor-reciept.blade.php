<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.0.2
* @link https://coreui.io
* Copyright (c) 2021 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<!-- Breadcrumb-->
<html lang="en">
  <head>
    <style>

        *{
            margin:0;
            padding:0;
        }

    body{
        /* padding : 0 30px 0 30px; */

        /* background: url('data:image/jpeg;base64,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'); */
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
        position:relative;
        overflow-x: hidden
    }

    body::before{
        content:"";
        width:100%;
        height:100%;
        background: rgba(255, 255, 255, 0.877);;
        position:absolute;
        top:0;
        right:0;
        left:0;
        bottom:0;
        z-index: -1;
    }

    .logo{
        width:80px;
        height:80px;
        color:#000;
        /* border-radius: 5px; */
        margin: auto;
        background: red;
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
    #metadata{
        margin: 20px auto;
        width:95%;
    }

    #metadata td, #metadata th{
        border-collapse: collapse;
        font-size: 18px;

    }

    #metadata tr td:last-child{
        border-bottom: none;
    }

    #invoice-body {
        width:95%;
        font-size:20px;
        margin: auto;
        border:1px solid #000!important;
        border-collapse: collapse;
    }
    .details-container{
        background: url('data:image/jpeg;base64,aHR0cDovLzEyNy4wLjAuMTo4MDAwL3B1YmxpYy9pbWFnZXMvY29hdF9vZl9hcm1zLmpwZw==');
    }

    #invoice-body thead{
        background:#eee;
    }
    #invoice-body td ,  #invoice-body th{
        padding:3px;
        text-align: left;
        border:1px solid #000;
    }

    #invoice-body table {
        width: 100%;
        font-size:16px;
        border-collapse: collapse;
        font-weight:bolder;
    }

    #invoice-body table td,  #invoice-body table th {
        text-align: left!important;
        border-bottom: 1px solid #000!important;
        border-top: none!important;
        border-right: none!important;
        border-left: none!important;
    }

    .weight-bold{
        font-weight:bolder;
    }


    </style>

  </head>
  <body>

    <div class="invoice">
        <div >
            <p style="text-align:right; text-size-adjust: 10px;">http://ivreg.com.ng/license/reciept</p>
        </div>
        <div class="col-container" style="margin-bottom:10px;">
            <div class="col" style=" transform: translate(50%,50%); ">
              <div class="logo" style="display: inline-block; margin-left: 100px; margin-bottom: 50px; ">
                <img src="data:image/jpeg;base64,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" alt="" srcset="">
              </div>
              <br><br>

              <!-- <div class="logo"style="display:inline-block; margin-left:18px;">
                <img src="data:image/jpeg;base64,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" alt="" srcset="">
              </div> -->


            </div>


            <div style="background:white;  z-index:-1" class="col"></div>
            <div style="background:white;  z-index:-1" class="col"></div>

            <!-- <div class="col text">
             <p>6 Okigwe Rd, Opp. Civil Defense Corps Office, Owerri</p>
             <p>PMB:  460108</p>
             <p>https://iirs.im.gov.ng</p>
             <p>info@birs.bu.gov.ng</p>
            </div> -->
          </div>


        <div class="col-container" style="margin-bottom:2px;">
            <div class="col" >
              <h1 style="color:rgb(99, 6, 6); text-align: center;">IMO STATE GOVERNMENT</h1>
              <h3 style="color:rgb(99, 6, 6); text-align: center;">IMO STATE LICENSING AUTHORITY</h3>


            </div>



            <div class="col text">

            </div>
        </div>
        <!-- <br><br><br><br> -->

        <!-- <div style="padding: 50px;">
            <p style="float: right; ">002159</p>
        </div> -->

        <div  style="display:block; width:65%;padding:20px;margin:0 auto;">
            <div style="padding: 50px; width: auto;">
                <p>
                    <span style="text-align: left;">GENERAL MOTOR RECIEPT</span>
                    <span style="text-align: right; margin-left: 5px">BASG/IRS/RW &nbsp;
                         <span>002159</span>
                    </span>
                </p>
            </div>

            <div class="details-container" style="border: 1px solid black;margin:0 auto; border-radius: 10px; padding: 100px 50px;">
                <div>
                    <div style="float: left;">
                        <h4 style="writing-mode: vertical-rl; margin-top: 50px;">BOOKLET</h4>
                    </div>
                    <div style="display: inline; margin-right: 100px;">
                        <table id="metadata">
                            <tbody>
                                <tr>
                                    <td class="weight-bold">Owner's Name: </td>
                                </tr>
                                <tr>
                                    <!-- <td class="weight-bold">Owner's Email: </td> -->
                                    <td>{{ $reciept->owner_name }}</td>

                                </tr>
                                <tr>
                                    <td class="weight-bold">Address </td>
                                </tr>
                                <tr>

                                    <td>{{ $reciept->address }}</td>

                                </tr>
                                <tr>
                                    <td class="weight-bold">Registration Number: </td>
                                </tr>
                                <tr>
                                    <td>1234567890</td>
                                </tr>
                                <tr>
                                    <td class="weight-bold">Chassis Number: </td>
                                </tr>
                                <tr>
                                    <td>{{ $reciept->chassis_number }}</td>
                                </tr>
                                <tr>
                                    <td class="weight-bold">Engine Number: </td>
                                </tr>
                                <tr>
                                    <td>{{ {{ $reciept->engine_number }} }}</td>
                                </tr>
                                <tr>
                                    <td class="weight-bold">Vehicle Make: </td>
                                </tr>
                                <tr>
                                    <td>{{ $reciept->model }}</td>
                                </tr>
                                <tr>
                                    <td class="weight-bold">Amount: </td>
                                </tr>
                                <tr>
                                    <td>&#8358; {{ $reciept->amount }}</td>
                                </tr>
                                <tr>
                                    <td class="weight-bold">Issue Date: </td>
                                </tr>
                                <tr>
                                    <td>{{ $reciept->issue_date }}</td>
                                </tr>
                                <tr>
                                    <td class="weight-bold">Expiry Date: </td>
                                </tr>
                                <tr>
                                    <td>{{ $reciept->expiry_date }}</td>
                                </tr>
                                <tr>
                                    <td class="weight-bold">State: </td>
                                </tr>
                                <tr>
                                    <td>{{ $reciept->state }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p style="float: right;">
                     IvReg
                </p>

            </div>
        </div>
        </div>
    </div>

    <!-- <h4 style="transform: rotateX(90deg);">ROAD WORTHINESS</h4> -->

  </body>
</html>
