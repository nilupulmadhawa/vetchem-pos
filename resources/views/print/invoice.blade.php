<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Invoive</title>
  <style type="text/css">
    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    a {
      color: black;
      text-decoration: underline;
    }

    body {
      position: relative;
      width: 8cm;
      margin: auto;
      color: #001028;
      background: #FFFFFF;
      font-family: Arial, sans-serif;
      font-size: 13px;
      font-family: Arial;
      padding: 0 20px;
    }

    main {
      margin: -10px;
    }

    header {
      margin: -10px;
      padding: 10px 0;
      margin-bottom: 5px;
    }

    #logo {
      text-align: center;
      font-weight: 800px;
    }

    #logo img {
      width: 4cm;
    }

    h1 {
      /* border-top: 1px solid black;
      border-bottom: 1px solid black; */
      color: black;
      font-size: 2em;
      line-height: 1.4em;
      font-weight: normal;
      text-align: center;
      margin: 0;
    }


    #project {
      float: left;
    }

    #project span {
      color: black;
      text-align: right;
      width: 70px;
      margin-right: 10px;
      display: inline-block;
      font-size: 12px;
    }

    #company {
      /* float: right; */
      /* text-align: right; */
      /* display: flex;
      justify-content: center;
      flex-direction: column; */
      margin-bottom: 10px;

    }

    #project div,
    #company div {
      white-space: nowrap;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 20px;
    }

    table th,
    table td {
      text-align: center;
    }


    table th {
      padding: 5px 5px;
      color: black;
      border-bottom: 1px solid black;
      white-space: nowrap;
      font-weight: normal;
      font-weight: bold;
    }

    table .service,
    table .desc {
      text-align: left;
    }

    table td {
      padding: 2px;
      text-align: right;
    }

    table td.service,
    table td.desc {
      vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
      font-size: 13px;
    }

    table td.grand {
      border-top: 1px solid black;
    }

    /* tbody{
      margin-right: 3px;
    } */


    #notices .notice {
      text-align: center;
      color: black;
      font-size: 13px;
    }

    footer {
      color: black;
      width: 100%;
      position: absolute;
      bottom: 0;
      border-top: 1px solid #C1CED9;
      padding: 8px 0;
      text-align: center;
    }
  </style>
</head>

<body>
  <header class="clearfix">
    <div id="logo">
      <!-- <img src="{{ asset('dist/img/logo1.png') }}"> -->
      <!-- {{-- <div class="notice" style="font-size: 12px;">Supply Of Heavy Machinary Cylinder Repair Kits, Oilseals,O-rings,
        Dust seal,Pressure seal, Floating seals & Every kind of NOK Seals.</div> --}} -->
      <h1>Vet Chem Farm Needs (Pvt) Ltd</h1>
      <p>Reg.No: 00203573</p>
    </div>

    <div id="company" class="clearfix ">

      <!-- <div>THUSHARA CELLULAR SERVICE</div> -->
      <div>Madampe rd, Kuliyapitiya.Sri Lanka</div>
      <div>Branches: Chilaw rd,Malwana,Wariyapola.</div>
      <div>Tel :077 7236829 / 0372057564</div>
      <!-- <div>E-mail :<a href="#">thusharacom4@gmail.com</a></div> -->

    </div>
    <div id="project">
      <div><span>INVOICE NO :</span> #{{$data->id}}</div>
      <div><span>DATE :</span>{{$data->created_at}}</div>
    </div>
  </header>
  <main>
    <table>
      <thead>
        <tr>
          <div class="mt-4">
            <div class="row text-600 text-white bgc-default-tp1 py-25">
              <th>
                <div class="col-9 col-sm-3">Item</div>
              </th>
              <th>
                <div class="d-none d-sm-block col-4 col-sm-2">Qty</div>
              </th>
              <th>
                <div class="d-none d-sm-block col-4 col-sm-2">Dis</div>
              </th>
              <th>
                <div class="d-none d-sm-block col-sm-2">Price</div>
              </th>
              <th>
                <div class="col-2">Amount</div>
              </th>
            </div>
        </tr>
        @php
        echo "<script>
          var x = ".$data."
        </script>";
        @endphp
        <script>
          var i = 1;
          x.invoice_items.forEach(items => {
            document.write("<tr>");
            document.write("<td style='text-align: start;''>" + items['name'] + "</td>");
            if (items['qty'] % 1 == 0) {
              document.write("<td>" + Math.round(items['qty']) + "</td>");
            } else {
              document.write("<td>" + items['qty'] + "</td>");
            }
            document.write("<td>" + items['discount'] + "</td>");
            document.write("<td>" + items['price'] + "</td>");
            document.write("<td>" + items['sale_price'] + "</td>");
            document.write("</tr>");
            if (items['warranty'] > 0) {
              document.write("<tr>");
              document.write("<td colspan='5' style='text-align: center; padding-top: 0px; font-size: 12px;'>(" + items['warranty'] + " Month Warranty)</td>");
              document.write("</tr>");
            }
            i++;
          });
        </script>
        {{-- <tr>
            <th class="service">NO.</th>
            <th class="desc">ITEM</th>
            <th>PRICE<br>(Rs.)</th>
            <th>QTY</th>
            <th>TOTAL <br>(Rs.)</th>
          </tr> --}}
      </thead>
      <tbody>
        <tr>
          <td colspan="4">SUBTOTAL</td>
          <td class="total">{{$data->sub_total}}</td>
        </tr>
        <tr>
          <td colspan="4">DISCOUNT</td>
          <td class="total">{{$data->discount}}</td>
        </tr>
        <tr>
          <td colspan="4" class="grand total">GRAND TOTAL</td>
          <td class="grand total" style="font-size: 13px;"><strong>{{$data->total}}</strong></td>
        </tr>
        <tr>
          <td colspan="4" class="grand total">Cash Balance</td>
          <td class="grand total" style="font-size: 13px;">{{$data->balance}}</td>
        </tr>
      </tbody>
    </table>





    </div>


    <div id="notices">


      {{-- <div>NOTICE:</div> --}}
      <!-- <div class="notice">All Kinds of Phone models and accessories with company warranty & phone repairs</div> -->

      <div class="notice" style="font-size: 13px;"><strong> THANK YOU COME AGAIN!! <br> ISSUES BILL SHOULD BE PRESENTED WHEN GOODS ARE RETURN BEFORE 3 DAYS!</strong></div>


    </div>
  </main>
  <script>
    window.addEventListener("load", window.print());
    window.onafterprint = function(event) {
      // alert(document.referrer);
      window.location.href = document.referrer;
      window.history.back();
    };
  </script>
</body>

</html>