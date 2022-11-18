<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
<style>
    body{
      font-family: 'Roboto', sans-serif;
      color:   #808080;
      font-size: 14px;
    }
    .bg-dark{
      background-color: #191919;
      color: #ffffff;
    }
    .text-dark{
      color: #191919;
    }

    table {
      width: 100%;
    }

    table.order-details thead tr > td {
      padding: 5px;
    }
    h1.invoice-heading{
      font-weight: 100;
    }
    .m-0{
      margin: 0;

    }
    .p-0{
      padding: 0;
    }
button.btn.btn-primary.waves-effect.waves-light {
    color: #fff;
}

    </style>

</head>
<body>
	<div class="table-responsive">

					<table class="table table-borderless ">
						<tbody>
							<tr>
								<td >
									<img src="data:image/png;base64,{{ $invoice_logo }}" alt="{{ $order->brand->name }}" width="200px" />
								</td>
								<td align="right">
									<h1 class="invoice-heading m-0 p-0">  INVOICE
                             <p class="m-0 p-0"> #{{ $invoice_code }}{{ $order->id }} </p>
                           </h1>
								</td>
							</tr>
							<tr>
                        <td>
								    <p ><strong class="text-dark">{{ $order->brand->name }}</strong>
                              <br>
                             {!! nl2br($order->brand->detail) !!}
                            </p>
							  </td>
						      <td align="right">
									<p  ><strong>Date:</strong> {{ $today_date }}</p>
								</td>
                     </tr>
							<tr>
								<td >
                           <p>Bill To: <br>
                              <strong class="text-dark"> {{ $order->first_name ?? ''}} {{ $order->last_name ?? ''}} </strong>
                           </p>
                        </td>
							</tr>							
						
						</tbody>
					</table>
				</div>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped order-details">
								<thead>
									<tr class="bg-dark">
										<td><strong>Services</strong>
										</td>
										<td><strong>Detail</strong>
										</td>
										<td ><strong>Amount</strong>
										</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>@foreach ($order->orderLineItem as $service)
										 {{ $service->service_name }}<br>
										 @endforeach
										</td>
										<td>{{ $order->description }}</td>
										<td align="right">{{ $order->currency }} {{ number_format( $order->amount) }}</td>
									</tr>
									<tr>
										<td ></td>
										<td align="right"> <strong>Total:</strong>
										</td>
										<td align="right">
											<p><strong>{{ $order->currency }} {{ number_format( $order->amount) }}</strong></p>
										</td>
									</tr>
								</tbody>
							</table>
                     @if( $order->notes != null)
                     <div>
                        <p><strong>Notes:</strong><br>
                          {!!  nl2br($order->notes) !!}         
                         </p>
                     </div>
                     @endif
                     @if( $order->terms != null)
                     <div>
                        <p><strong>Terms:</strong><br>
                           {!!  nl2br($order->terms) !!}                          
                        </p>
                     </div>
                     @endif
						</div>
					</div>
	</body>
</html>