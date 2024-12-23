@extends('layouts.main')

@section('front-end')
				<x-front-navbar></x-front-navbar>

				<div class="hero-wrap js-fullheight" style="background-image: url('images/bg_5.png');">
								<div class="overlay"></div>
								<div class="container">
												<div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
																<div class="col-md-7 ftco-animate">
																				<h1 class="mb-4">Selamat Datang di TRAVELLER</h1>
																				<p class="caps">Aplikasi berbasis website untuk jasa pemesanan tiket travel</p>
																				<a href="/orders/create" class="btn btn-primary">Pesan Sekarang!</a>
																</div>
												</div>
								</div>
				</div>

				<section class="ftco-section">
								<div class="container">
												<div class="row justify-content-center pb-4">
																<div class="col-md-12 heading-section text-center ftco-animate">
																				<span class="subheading">Destination</span>
																				<h2 class="mb-4">Top Destination</h2>
																</div>
												</div>
												<div class="row">
																<div class="col-md-4 ftco-animate">
																				<div class="project-wrap">
																								<a class="img" style="background-image: url(images/destination-1.jpg);">
																								</a>
																								<div class="text p-4">
																												<h3><a>Bekasi</a></h3>
																												<p class="location"><span class="fa fa-map-marker"></span> Jl. Jend. Ahmad Yani No 200, Kelurahan Marga Jaya, 
																																											Kec. Bekasi Selatan., Kota Bekasi.</p>
																								</div>
																				</div>
																</div>
																<div class="col-md-4 ftco-animate">
																				<div class="project-wrap">
																								<a class="img" style="background-image: url(images/destination-2.jpg);">
																								</a>
																								<div class="text p-4">
																												<h3><a>Bogor</a></h3>
																												<p class="location"><span class="fa fa-map-marker"></span> Jl.Pangeran Sogiri No.100 RT.010 RW.021. Kel.Tanah Baru, 
																																											Kec.Bogor Barat, Kota Bogor</p>

																								</div>
																				</div>
																</div>
																<div class="col-md-4 ftco-animate">
																				<div class="project-wrap">
																								<a class="img" style="background-image: url(images/destination-3.jpg);">
																								</a>
																								<div class="text p-4">
																												<h3><a>Jakarta</a></h3>
																												<p class="location"><span class="fa fa-map-marker"></span> Gambir, Jl. Medan Merdeka, Kecamatan Gambir, Kota
																																Jakarta Pusat, Daerah Khusus Ibukota Jakarta</p>

																								</div>
																				</div>
																</div>

																<div class="col-md-4 ftco-animate">
																				<div class="project-wrap">
																								<a class="img" style="background-image: url(images/destination-4.jpg);">
																								</a>
																								<div class="text p-4">
																												<h3><a>Bandung</a></h3>
																												<p class="location"><span class="fa fa-map-marker"></span> Jl. Ciwastra No. 300, Margasari, Kecamatan Buahbatu, Kota Bandung, Jawa Barat.</p>

																								</div>
																				</div>
																</div>
																<div class="col-md-4 ftco-animate">
																				<div class="project-wrap">
																								<a class="img" style="background-image: url(images/destination-5.jpeg);">
																								</a>
																								<div class="text p-4">
																												<h3><a>Tangerang</a></h3>
																												<p class="location"><span class="fa fa-map-marker"></span> Jl. Dongkal No. 19A, Cipondoh Indah, Cipondoh, Tangerang</p>

																								</div>
																				</div>
																</div>
																<div class="col-md-4 ftco-animate">
																				<div class="project-wrap">
																								<a class="img" style="background-image: url(images/destination-6.jpg);">
																								</a>
																								<div class="text p-4">
																												<h3><a>Depok</a></h3>
																												<p class="location"><span class="fa fa-map-marker"></span> Jl. Lingkar, Pondok Cina, Kecamatan Beji, Kota Depok, Jawa Barat.</p>

																								</div>
																				</div>
																</div>
												</div>
								</div>
				</section>

				<section class="ftco-section testimony-section bg-bottom" style="background-image: url(images/bg_1.png);">
								<div class="overlay"></div>
								<div class="container">
												<div class="row justify-content-center pb-4">
																<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
																				<span class="subheading">Testimonial</span>
																				<h2 class="mb-4">Customer Feedback</h2>
																</div>
												</div>
												<div class="row ftco-animate">
																<div class="col-md-12">
																				<div class="carousel-testimony owl-carousel">
																								<div class="item">
																												<div class="testimony-wrap py-4">
																																<div class="text">
																																				<p class="star">
																																								<span class="fa fa-star checked"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																				</p>
																																				<p class="mb-4">"Pelayanan customer service-nya cepat tanggap dan profesional. 
																																					Ketika ada kesalahan data, langsung dibantu sampai selesai. Jempol untuk timnya!"
																																				</p>
																																				<div class="d-flex align-items-center">
																																								<div class="user-img" style="background-image: url(images/default_profile.jpg)"></div>
																																								<div class="pl-3">
																																												<p class="name">Doni Setiawan</p>
																																								</div>
																																				</div>
																																</div>
																												</div>
																								</div>
																								<div class="item">
																												<div class="testimony-wrap py-4">
																																<div class="text">
																																				<p class="star">
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																				</p>
																																				<p class="mb-4">"Sangat puas dengan pengalaman menggunakan aplikasi ini. 
																																					Pesan tiket jadi lebih praktis, dan saya tidak perlu khawatir soal keberangkatan. Semuanya lancar! Terima kasih Traveller."</p>
																																				<div class="d-flex align-items-center">
																																								<div class="user-img" style="background-image: url(images/default_profile.jpg)"></div>
																																								<div class="pl-3">
																																												<p class="name">Dermawan Setiananda</p>
																																								</div>
																																				</div>
																																</div>
																												</div>
																								</div>
																								<div class="item">
																												<div class="testimony-wrap py-4">
																																<div class="text">
																																				<p class="star">
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																				</p>
																																				<p class="mb-4">"Aplikasi ini luar biasa! Jadwal dan pilihan armadanya lengkap, 
																																					harga tiket terjangkau, dan proses pembayarannya sangat aman. Terbaik deh!"</p>
																																				<div class="d-flex align-items-center">
																																								<div class="user-img" style="background-image: url(images/default_profile.jpg)"></div>
																																								<div class="pl-3">
																																												<p class="name">Rizky Budi</p>
																																								</div>
																																				</div>
																																</div>
																												</div>
																								</div>
																								<div class="item">
																												<div class="testimony-wrap py-4">
																																<div class="text">
																																				<p class="star">
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																				</p>
																																				<p class="mb-4">"Saya tidak perlu repot lagi memesan tiket travel. Dengan aplikasi ini, 
																																					semua prosesnya cepat dan lancar. Ditambah pelayanan yang sangat ramah! 👍" 
																																				</p>
																																				<div class="d-flex align-items-center">
																																								<div class="user-img" style="background-image: url(images/default_profile.jpg)"></div>
																																								<div class="pl-3">
																																												<p class="name">Dewi Amalia</p>
																																								</div>
																																				</div>
																																</div>
																												</div>
																								</div>
																								<div class="item">
																												<div class="testimony-wrap py-4">
																																<div class="text">
																																				<p class="star">
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																								<span class="fa fa-star"></span>
																																				</p>
																																				<p class="mb-4">"Luar biasa! Aplikasi ini sangat memudahkan saya dalam memesan tiket travel. 
																																					Prosesnya cepat, user-friendly, dan pelayanannya ramah. Highly recommended!"</p>
																																				<div class="d-flex align-items-center">
																																								<div class="user-img" style="background-image: url(images/default_profile.jpg)"></div>
																																								<div class="pl-3">
																																												<p class="name">Bambang Supriatna</p>
																																								</div>
																																				</div>
																																</div>
																												</div>
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</section>

				<footer class="ftco-footer bg-bottom ftco-no-pt" style="background-image: url(images/bg_3.jpg);">
								<div class="container">
												<div class="row mb-5">
																<div class="col-md pt-5">
																				<div class="ftco-footer-widget pt-md-5 mb-4">
																								<h2 class="ftco-heading-2">About</h2>
																								<p>Traveller adalah perusahaan penyedia jasa travel antar kota yang berdedikasi untuk memberikan layanan perjalanan yang aman, nyaman, dan terpercaya bagi para pelanggan kami. 
																									Dengan pengalaman bertahun-tahun di industri transportasi, 
																									kami terus berinovasi untuk memenuhi kebutuhan perjalanan modern dengan menghadirkan sistem pemesanan tiket berbasis aplikasi web yang cepat dan praktis.</p>
																								<ul class="ftco-footer-social list-unstyled float-md-left float-lft">
																												<li class="ftco-animate"><a href="" target="_blank"><span
																																								class="fa fa-twitter"></span></a></li>
																												<li class="ftco-animate"><a href=""
																																				target="_blank"><span class="fa fa-facebook"></span></a></li>
																												<li class="ftco-animate"><a href="" target="_blank"><span
																																								class="fa fa-instagram"></span></a></li>
																								</ul>
																				</div>
																</div>
																<div class="col-md pt-5 border-left">
																				<div class="ftco-footer-widget pt-md-5 mb-4">
																								<h2 class="ftco-heading-2">Travel Type</h2>
																								<ul class="list-unstyled">
																												<li><a class="py-2 d-block">Isuzu Elf NMR 71</a></li>
																												<li><a class="py-2 d-block">Isuzu Elf NQR 71</a></li>
																												<li><a class="py-2 d-block">Isuzu Elf NMR 81</a></li>
																												<li><a class="py-2 d-block">Mitsubishi FE 71 BC</a></li>
																												<li><a class="py-2 d-block">Mitsubishi FE 71 LBC</a></li>
																								</ul>
																				</div>
																</div>
																<div class="col-md pt-5 border-left">
																				<div class="ftco-footer-widget pt-md-5 mb-4">
																								<h2 class="ftco-heading-2">Have a Questions?</h2>
																								<div class="block-23 mb-3">
																												<ul>
																																<li><span class="icon fa fa-map-marker"></span><span class="text">Jl. Buah Batu No.22, Turangga, Kec. Lengkong, Kota Bandung 40265</span></li>
																																<li><a href="https://wa.me/6282188227551?text=Ingin%20Melaporkan%20Masalah"><span
																																												class="icon fa fa-whatsapp"></span><span class="text">082188227551 CS
																																												1</span></a></li>
																																<li><a href="https://wa.me/6285426116522?text=Ingin%20Melaporkan%20Masalah"><span
																																												class="icon fa fa-whatsapp"></span><span class="text">085426116522 CS
																																												2</span></a></li>
																																<li><a href="mailto:cstraveller24@gmail.com"><span class="icon fa fa-envelope"></span><span
																																												class="text">cstraveller24@gmail.com</span></a></li>
																												</ul>
																								</div>
																				</div>
																</div>
												</div>
												<div class="row">
																<div class="col-md-12 text-center">

																				<p>
																								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
																								Traveller &copy;
																								<script>
																												document.write(new Date().getFullYear());
																								</script>
																								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
																				</p>
																</div>
												</div>
								</div>
				</footer>



				<!-- loader -->
				<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
												<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
																stroke="#eeeeee" />
												<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
																stroke-miterlimit="10" stroke="#F96D00" />
								</svg></div>
@endsection