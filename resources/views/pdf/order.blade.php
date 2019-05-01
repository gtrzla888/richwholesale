<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $order->id }}</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    @page {
      margin: 0;
    }
    .page-break {
      page-break-after: always;
    }

  </style>
</head>
<body>

<div class="page-break">
    <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr>
            <td>
                <h4>{{$order->quote->customer_name}}</h4>
            </td>
            <td>
                <h4>{{$order->quote->company->name}}</h4>
            </td>
        </tr>
    </table>

  <div class="invoice">
    <h5>Order# {{ $order->id }} ( {{ $order->product_type }} )</h5>
    @foreach($order->items as $item)
      <h5>Product# {{ $item->id }}</h5>
      <table>
        @foreach($item->product->toArray() as $prop => $value)
          <tr>
            <td style="border: 1px solid; padding:12px;">{{title_case($prop)}}</td>
            <td style="border: 1px solid; padding:12px;">{{$value}}</td>
          </tr>
        @endforeach
      </table>
      <br>
    @endforeach
  </div>
</div>
</body>
</html>
