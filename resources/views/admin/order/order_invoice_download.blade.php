<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>

<style type="text/css">
    .clreafix:after{
        content: "";
        display: table;
        clear: both;
    }
a {
    color: #5D6975;
    text-decoration: underline;
    }

body{
    position: relative;
    width: 21cm;

    margin: 0 auto;
    color: #001028;
    background: #FFFFFF;
    font-family: Arial, sans-serif;
}

header{
    padding: 10px 0;
    margin-bottom: 30px;
}
#logo{
    text-align: center;
    margin-bottom: 10px;
}

#logo Img{
    width: 90px;
}

h1 {
    border-top: 1px solid #5D6975;
    border-bottom: 1px solid #5D6975;
    color: #5D6975;
    font-size: 2.4em;
    line-height: 1.4em;
    font-weight: normal;
    text-align: center;
    margin: 0 0 20px 0;
    background: url();
}

#project {
    float: left;
}

#project span{
    color: #5D6975;
    text-align: right;
    width: 52px;
    margin-right: 10px;
    display: inline-block;
    font-size: 0.8em;
}

#company {
    float: right;
    text-align: right;
}

#project div,
#company div {
    white-space: nowrap;
}

table {
    width: 100px;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
    background: #F5F5F5;
}

table th,
table td {
    text-align: center;
}

table th {
    padding: 5px 20px;
    color: #5D6975;
    border-bottom: 1px solid #C1CED9;
    white-space: nowrap;
    font-weight: normal;
}

table .service,
table .desc {
    text-align: left;
}

table td {
    padding: 20px;
    text-align: right;
}

table td.service,
table td.desc {
    vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
    font-size: 1.2em;
    margin-right: 350px;
}

table td.grand {
    border-top: 1px solid #5D6975;
}

#notices .notice {
    color: #5D6975;
    font-size: 1.2em;
}

footer {
    color: #5D6975;
    width: 100%;
    height: 30px;
    position: absolute;
    bottom: 0;
    border-top: 1px solid #C1CED9;
    padding: 8px 0;
    text-align: center;
}

</style>

</head>
<body>

<header class="clreafix">
    <div id="logo">
        <img src="">
    </div>
    <h1>INVOICE NO: {{$order->id}}</h1>
    <div id="company" class="clreafix" style="margin-right: 345px">
        <h4>Customer info</h4>
        <div>{{$customer->first_name.' '.$customer->last_name}}</div>
        <div>{{$customer->address}}</div>
        <div>{{$customer->phone_number}}</div>
        <div>{{$customer->email_address}}</div>
    </div>
    <div id="project">
        <h4>Shipping info</h4>
        <div><span>NAME: </span>{{$shipping->full_name}}</div>
        <div><span>PHONE: </span>{{$shipping->phone_number}}</div>
        <div><span>ADDRESS: </span>{{$shipping->address}}</div>
        <div><span>EMAIL: </span>{{$shipping->email_address}}</div>
        <div><span>DATE: </span>{{$shipping->created_at}}</div>
    </div>

</header>

<main>
    <table width:100% style="width: 100%">
        <thead>
            <tr>
                <th>SN</th>
                <!-- <th>PRODUCT IMAGE</th> -->
                <td>PRICE</td>
                <th>QTY</th>
                <th>TOTAL</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($order_details as $order_detail)
            <tr>
                <td style="width: 5%">{{$loop->index+1}}</td>
                <td style="text-align: center;">{{$order_detail->product_name}}</td>
                <td style="width: 80px">${{$order_detail->product_price}}</td>
                <td class="qty">{{$order_detail->product_quantity}}</td>
                <td class="total">${{$order_detail->product_price*$order_detail->product_quantity}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="5">SUBTOTAL</td>
                <td class="total">$ {{$order->total_price}}</td>
            </tr>
            <tr>
                <td colspan="5">TAX 0%</td>
                <td class="total">$ {{$order->total_price}}</td>
            </tr>
            <tr>
                <td colspan="5">GRAND TOTAL</td>
                <td class="grand total">$ {{$order->total_price}}</td>
            </tr>

        </tbody>
    </table>
</main>

<footer>
    All right's reserved to the developers.
</footer>


</body>
</html>