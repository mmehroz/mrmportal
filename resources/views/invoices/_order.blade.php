<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
<style>
    body{
      font-family: 'Roboto', sans-serif !important;
      color:   #808080;
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
								<td class="p-0 m-0  text-left ">
									<img src="data:image/png;base64,{{ $invoice_logo }}" alt="{{ $order->brand->name }}" width="250px" />
								</td>
								<td class="p-0 m-0 text-right">
									<h4>INVOICE</h4>
									<p># {{ $order->id }} </p>
								</td>
							</tr>
							<tr><td>
								<h4><strong>{{ $order->brand->name }}</strong></h4>
								<p>Sugarland TX,<br>
                                        281-201-0313</p>
							</td>
						<td class="p-0 m-0 text-right">
									<p  class="m-0"><strong>Date:</strong> {{ $today_date }}</p>
									{{-- <p  class="m-0"><strong>Balance Due:</strong> $ 0.00</p> --}}
								</td></tr>
							<tr>
								<td class="p-0"><h5  class="m-0"><u><strong>Bill To:</strong></u></h5></td>
							</tr>
							<tr>
								<td class="p-0"><strong>First Name:</strong> {{ $order->first_name ?? 'n/a'}}</td>
							</tr>
							<tr>
								<td class="p-0"><strong>Last Name:</strong> {{ $order->last_name ?? 'n/a'}}</td>
							</tr>
							<tr>
								<td class="p-0"><strong>Email:</strong> {{ $order->customer_email ?? 'n/a'}}</td>
							</tr>
							<tr>
								<td class="p-0"><strong>Phone Number:</strong> {{ $order->phone_number ?? 'n/a'}}</td>
								{{-- <td style="padding: 0 0 0 100px;"><h5 class="m-0"><u>Payment Details:</u></h5></td> --}}
							</tr>
							<tr>
								<td class="p-0"><strong>Address:</strong> {{ $order->address ?? 'n/a'}}</td>
								{{-- <td style="padding: 0 0 0 100px;"> <strong>Payment Status:</strong>
                                 @if($order->payment_status == 1)
                                    <span class="badge badge-success">Complete</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td> --}}
							</tr>
							<tr>
								<td class="p-0"><strong>City:</strong> {{ $order->city ?? 'n/a'}}</td>
								{{-- <td style="padding: 0 0 0 100px;"> <strong>Bank Name:</strong> {{ $order->bank_name ?? 'n/a'}}</td> --}}
							</tr>
							<tr>
								<td class="p-0"><strong>Country:</strong> {{ $order->country ?? 'n/a'}}</td>
								{{-- <td style="padding: 0 0 0 100px;"><strong>Card Type:</strong> {{ $order->card_type ?? 'n/a'}}</td> --}}
							</tr>
							<tr>
								<td class="p-0"><strong>State:</strong> {{ $order->state ?? 'n/a'}}</td>
								{{-- <td style="padding: 0 0 0 100px;"><strong>Card Name:</strong> {{ $order->card_name ?? 'n/a'}}</td> --}}
							</tr>
							<tr>
								<td class="p-0"><strong>Zip Code:</strong> {{ $order->zip_code ?? 'n/a'}}</td>
								{{-- <td style="padding: 0 0 0 100px;"><strong>Transection Type:</strong> {{ $order->transection_type ?? 'n/a'}}</td> --}}
							</tr>
						
						</tbody>
					</table>
				</div>
					<div class="row">
						<div class="col-md-12">
							<h5 class="m-0"><u>Order Details:</u></h5><br>
							<table class="table table-striped">
								<thead>
									<tr class="bg-dark text-white">
										<td><strong>Services</strong>
										</td>
										<td><strong>Detail</strong>
										</td>
										<td class="text-right"><strong>Amount</strong>
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
										<td class="text-right">{{ $order->currency }} {{ $order->amount }}</td>
									</tr>
									<tr>
										<td class="no-line"></td>
										<td class="no-line text-right"> <strong>Total:</strong>
										</td>
										<td class="no-line text-right">
											<h4 class="m-0">{{ $order->currency }} {{ $order->amount }}</h4>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
	</body>
</html>