@extends('layouts.front')

@section('front')
				<div class="wrapper">
								<!-- Main content -->
								<section class="invoice" style="margin: 30px; border: none">
												<!-- title row -->
												<div class="row">
																<div class="col-12">
																				<h2 class="page-header">
																								<img src="{{ asset('dist/img/Logo Traveller2.png') }}" alt="Logo Traveller" width="220">
																				</h2>
																</div>
																<!-- /.col -->
												</div>
												<!-- info row -->
												<div class="row invoice-info">
																<div class="col-sm-4 invoice-col">
																				<br>
																				<br>
																				<address>
																								<strong>Traveller</strong><br>
																								Jl. Buah Batu No.22, Turangga<br>
																								Kec. Lengkong, Kota Bandung 40265<br>
																								Phone CS 1: 082188227551 CS 1<br>
																								Phone CS 2: 085426116522 CS 2<br>
																								Email: 	cstraveller24@gmail.com
																				</address>
																</div>
																<!-- /.col -->
																<div class="col-sm-4 invoice-col">

																				<br>
																				<br>
																				<address>
																								@isset($order->user->phone_number)
																												<strong>{{ $order->user->name }}</strong>
																								@endisset

																								@isset($order->user->phone_number)
																												<br> Phone: {{ $order->user->phone_number }}
																								@endisset

																								@isset($order->user->email)
																												<br> Email: {{ $order->user->email }}
																								@endisset

																				</address>
																</div>
																<!-- /.col -->
																<div class="col-sm-4 invoice-col">
																				<br>
																				<br>
																				<b>Invoice #{{ $order->order_code }}</b><br>
																				<b>Order ID:</b> {{ $order->order_code }}<br>
																				@isset($order->transaction->method->method)
																								<b>Metode Pembayaran :</b> {{ $order->transaction->method->method }}
																								<br>
																				@endisset

																				<b>Payment date:</b> {{ $order->transaction->updated_at }}<br>
																</div>
																<!-- /.col -->
												</div>
												<!-- /.row -->
												<br>
												<!-- Table row -->
												<div class="row">
																<div class="col-12 table-responsive">
																				<table class="table table-striped">
																								<thead>
																												<tr>
																																<th>No</th>
																																<th>Nopol Travel</th>
																																<th>Nama Penumpang</th>
																																<th>Kelas</th>
																																<th>Rute</th>
																																<th>Pool</th>
																																<th>Tanggal Pergi</th>
																																<th>Jam Berangkat</th>
																												</tr>
																								</thead>
																								<tbody>
																												@foreach ($order->passengers as $passenger)
																																<tr>
																																				<td>{{ $loop->iteration }}</td>
																																				<td>{{ $order->ticket->travel->name }}</td>
																																				<td>{{ $passenger->name }}</td>
																																				<td>{{ $order->ticket->type->name }}</td>
																																				<td>{{ $order->ticket->track->from_route }} - {{ $order->ticket->track->to_route }}
																																				</td>
																																				<td>{{ $order->ticket->travel->gate }}</td>
																																				<td>{{ $order->go_date }}</td>
																																				<td>{{ $order->ticket->type->start_at }} WIB</td>
																																</tr>
																												@endforeach
																								</tbody>
																				</table>
																</div>
																<!-- /.col -->
												</div>
												<!-- /.row -->

												<div class="row">
																<!-- accepted payments column -->
																<div class="col-6">

																</div>
																<!-- /.col -->
																<div class="col-6">

																				<div class="table-responsive">
																								<table class="table">
																												<tr>
																																<th>Total:</th>
																																<td style="font-weight: bold">Rp {{ $order->transaction->total }}</td>
																												</tr>
																								</table>
																				</div>
																				<p class="lead">Your Payment Was Successful &nbsp; &nbsp;<i class="fas fa-check"></i> <br></p>

																</div>
																<!-- /.col -->
												</div>
												<!-- /.row -->
								</section>
								<!-- /.content -->
				</div>
				<!-- ./wrapper -->
@endsection

<script type="text/javascript">
				<!--
				window.print();
				//
				-->
</script>
