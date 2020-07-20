@extends('layouts.main')

@section('content')
                                
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>

							<li>
								<a href="#">Other Pages</a>
							</li>
							<li class="active">Blank Page</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Data Kategori Ruangan
							</h1>
						</div>
						
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                <!-- page specific plugin styles -->
                                <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
                                <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
                                <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
                                <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.min.css') }}" />
                                <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.min.css') }}" />
                                <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
                                <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-colorpicker.min.css') }}" />

                                @if (\Session::has('success'))
                                    <div class="alert alert-success">
                                    <p>{{ \Session::get('success') }}</p>
                                    </div><br/>
                                @endif
								<div class="row">
									<div class="col-xs-12">

										<div class="clearfix">
                                            <div class="pull-left"><a id="tambah-jenis" href="#modal-tambah-jenis" data-toggle="modal" class="btn btn-white btn-info btn-bold"> <i class="fa fa-plus"></i> Tambah Jenis Ruangan</a></div>
											<div class="pull-right tableTools-container"></div>
										</div>
										<!-- <div class="table-header">
											Results for "Latest Registered Domains"
										</div> -->

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">
															<label class="pos-rel">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th>
														<th>Nama Kategori</th>
														<th>Ikom Kategori</th>
														<th>
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															Update
														</th>
														<th></th>
													</tr>
												</thead>

												<tbody>
                                                    @foreach($room_category as $item)
                                                    <tr>
														<td class="center">
															<label class="pos-rel">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</td>

														<td>
															{{$item->nama_kategori}}
														</td>
														<td><i class="ace-icon fa {{$item->gambar_kategori}}"></i></td>
														<td>{{$item->updated_at}}</td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<a class="green" href="#modal-tambah-jenis" id="ubah-jenis-{{$item->id_room_category}}" data-toggle="modal" >
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red" href="{{route('del.room_category',$item->id_room_category)}}">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															</div>

															<div class="hidden-md hidden-lg">
																<div class="inline pos-rel">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<li>
																			<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="ace-icon fa fa-trash-o bigger-120"></i>
																				</span>
																			</a>
																		</li>
																	</ul>
																</div>
                                                            </div>
                                                            <script>
                                                                $("#ubah-jenis-{{$item->id_room_category}}").click(function(){
                                                                    $('h4').text('Ubah Kategori Ruangan');
                                                                    $('form').removeAttr('action');
                                                                    $('form').attr('action', '{{route("up.room_category",$item->id_room_category)}}');
                                                                    $('#form-field-nama').val('{{$item->nama_kategori}}');
                                                                    $('#sel-ikon option').removeAttr('selected');
                                                                    $('#sel-ikon option[value={{$item->gambar_kategori}}]').attr('selected','selected');
                                                                    $('#sel-ikon').val('{{$item->gambar_kategori}}');
                                                                    $('#sel-ikon').trigger("chosen:updated");
                                                                    $('#pre-ikon').removeClass();
                                                                    $('#pre-ikon').addClass('fa '+$('#sel-ikon').val());
                                                                });
                                                            </script>
														</td>
                                                    </tr>
                                                    @endforeach
												</tbody>
											</table>
                                        </div>
                                        
                                        <script>
                                            $("#tambah-jenis").click(function(){
                                                $('h4').text('Tambah Kategori Ruangan');
                                                $('form').removeAttr('action');
                                                $('form').attr('action', '{{route("create.room_category")}}');
                                            });
                                        </script>

                                        <div id="modal-tambah-jenis" class="modal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{route('create.room_category')}}" method="post">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="blue bigger">Tambah Kategori Ruangan</h4>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-5">
                                                                    <p style="text-align:center;font-size:90px;"><i id="pre-ikon" class="fa fa-tags"></i></p>
                                                                    <!-- <input type="file" /> -->
                                                                </div>

                                                                <div class="col-xs-12 col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="form-field-select-3">Ikon Kategori</label>
                                                                        <style>
                                                                            .chosen-container{
                                                                                font-family:fontAwesome !important;
                                                                            }
                                                                        </style>
                                                                        <div>
                                                                            <select name="gambar_kategori" id="sel-ikon" class="chosen-select">
                                                                                <option value='fa-500px'>&#xf26e; fa-500px</option>
                                                                                <option value='fa-address-book'>&#xf2b9; fa-address-book</option>
                                                                                <option value='fa-address-book-o'>&#xf2ba; fa-address-book-o</option>
                                                                                <option value='fa-address-card'>&#xf2bb; fa-address-card</option>
                                                                                <option value='fa-address-card-o'>&#xf2bc; fa-address-card-o</option>
                                                                                <option value='fa-adjust'>&#xf042; fa-adjust</option>
                                                                                <option value='fa-adn'>&#xf170; fa-adn</option>
                                                                                <option value='fa-align-center'>&#xf037; fa-align-center</option>
                                                                                <option value='fa-align-justify'>&#xf039; fa-align-justify</option>
                                                                                <option value='fa-align-left'>&#xf036; fa-align-left</option>
                                                                                <option value='fa-align-right'>&#xf038; fa-align-right</option>
                                                                                <option value='fa-amazon'>&#xf270; fa-amazon</option>
                                                                                <option value='fa-ambulance'>&#xf0f9; fa-ambulance</option>
                                                                                <option value='fa-american-sign-language-interpreting'>&#xf2a3; fa-american-sign-language-interpreting</option>
                                                                                <option value='fa-anchor'>&#xf13d; fa-anchor</option>
                                                                                <option value='fa-android'>&#xf17b; fa-android</option>
                                                                                <option value='fa-angellist'>&#xf209; fa-angellist</option>
                                                                                <option value='fa-angle-double-down'>&#xf103; fa-angle-double-down</option>
                                                                                <option value='fa-angle-double-left'>&#xf100; fa-angle-double-left</option>
                                                                                <option value='fa-angle-double-right'>&#xf101; fa-angle-double-right</option>
                                                                                <option value='fa-angle-double-up'>&#xf102; fa-angle-double-up</option>
                                                                                <option value='fa-angle-down'>&#xf107; fa-angle-down</option>
                                                                                <option value='fa-angle-left'>&#xf104; fa-angle-left</option>
                                                                                <option value='fa-angle-right'>&#xf105; fa-angle-right</option>
                                                                                <option value='fa-angle-up'>&#xf106; fa-angle-up</option>
                                                                                <option value='fa-apple'>&#xf179; fa-apple</option>
                                                                                <option value='fa-archive'>&#xf187; fa-archive</option>
                                                                                <option value='fa-area-chart'>&#xf1fe; fa-area-chart</option>
                                                                                <option value='fa-arrow-circle-down'>&#xf0ab; fa-arrow-circle-down</option>
                                                                                <option value='fa-arrow-circle-left'>&#xf0a8; fa-arrow-circle-left</option>
                                                                                <option value='fa-arrow-circle-o-down'>&#xf01a; fa-arrow-circle-o-down</option>
                                                                                <option value='fa-arrow-circle-o-left'>&#xf190; fa-arrow-circle-o-left</option>
                                                                                <option value='fa-arrow-circle-o-right'>&#xf18e; fa-arrow-circle-o-right</option>
                                                                                <option value='fa-arrow-circle-o-up'>&#xf01b; fa-arrow-circle-o-up</option>
                                                                                <option value='fa-arrow-circle-right'>&#xf0a9; fa-arrow-circle-right</option>
                                                                                <option value='fa-arrow-circle-up'>&#xf0aa; fa-arrow-circle-up</option>
                                                                                <option value='fa-arrow-down'>&#xf063; fa-arrow-down</option>
                                                                                <option value='fa-arrow-left'>&#xf060; fa-arrow-left</option>
                                                                                <option value='fa-arrow-right'>&#xf061; fa-arrow-right</option>
                                                                                <option value='fa-arrow-up'>&#xf062; fa-arrow-up</option>
                                                                                <option value='fa-arrows'>&#xf047; fa-arrows</option>
                                                                                <option value='fa-arrows-alt'>&#xf0b2; fa-arrows-alt</option>
                                                                                <option value='fa-arrows-h'>&#xf07e; fa-arrows-h</option>
                                                                                <option value='fa-arrows-v'>&#xf07d; fa-arrows-v</option>
                                                                                <option value='fa-asl-interpreting'>&#xf2a3; fa-asl-interpreting</option>
                                                                                <option value='fa-assistive-listening-systems'>&#xf2a2; fa-assistive-listening-systems</option>
                                                                                <option value='fa-asterisk'>&#xf069; fa-asterisk</option>
                                                                                <option value='fa-at'>&#xf1fa; fa-at</option>
                                                                                <option value='fa-audio-description'>&#xf29e; fa-audio-description</option>
                                                                                <option value='fa-automobile'>&#xf1b9; fa-automobile</option>
                                                                                <option value='fa-backward'>&#xf04a; fa-backward</option>
                                                                                <option value='fa-balance-scale'>&#xf24e; fa-balance-scale</option>
                                                                                <option value='fa-ban'>&#xf05e; fa-ban</option>
                                                                                <option value='fa-bandcamp'>&#xf2d5; fa-bandcamp</option>
                                                                                <option value='fa-bank'>&#xf19c; fa-bank</option>
                                                                                <option value='fa-bar-chart'>&#xf080; fa-bar-chart</option>
                                                                                <option value='fa-bar-chart-o'>&#xf080; fa-bar-chart-o</option>
                                                                                <option value='fa-barcode'>&#xf02a; fa-barcode</option>
                                                                                <option value='fa-bars'>&#xf0c9; fa-bars</option>
                                                                                <option value='fa-bath'>&#xf2cd; fa-bath</option>
                                                                                <option value='fa-bathtub'>&#xf2cd; fa-bathtub</option>
                                                                                <option value='fa-battery'>&#xf240; fa-battery</option>
                                                                                <option value='fa-battery-0'>&#xf244; fa-battery-0</option>
                                                                                <option value='fa-battery-1'>&#xf243; fa-battery-1</option>
                                                                                <option value='fa-battery-2'>&#xf242; fa-battery-2</option>
                                                                                <option value='fa-battery-3'>&#xf241; fa-battery-3</option>
                                                                                <option value='fa-battery-4'>&#xf240; fa-battery-4</option>
                                                                                <option value='fa-battery-empty'>&#xf244; fa-battery-empty</option>
                                                                                <option value='fa-battery-full'>&#xf240; fa-battery-full</option>
                                                                                <option value='fa-battery-half'>&#xf242; fa-battery-half</option>
                                                                                <option value='fa-battery-quarter'>&#xf243; fa-battery-quarter</option>
                                                                                <option value='fa-battery-three-quarters'>&#xf241; fa-battery-three-quarters</option>
                                                                                <option value='fa-bed'>&#xf236; fa-bed</option>
                                                                                <option value='fa-beer'>&#xf0fc; fa-beer</option>
                                                                                <option value='fa-behance'>&#xf1b4; fa-behance</option>
                                                                                <option value='fa-behance-square'>&#xf1b5; fa-behance-square</option>
                                                                                <option value='fa-bell'>&#xf0f3; fa-bell</option>
                                                                                <option value='fa-bell-o'>&#xf0a2; fa-bell-o</option>
                                                                                <option value='fa-bell-slash'>&#xf1f6; fa-bell-slash</option>
                                                                                <option value='fa-bell-slash-o'>&#xf1f7; fa-bell-slash-o</option>
                                                                                <option value='fa-bicycle'>&#xf206; fa-bicycle</option>
                                                                                <option value='fa-binoculars'>&#xf1e5; fa-binoculars</option>
                                                                                <option value='fa-birthday-cake'>&#xf1fd; fa-birthday-cake</option>
                                                                                <option value='fa-bitbucket'>&#xf171; fa-bitbucket</option>
                                                                                <option value='fa-bitbucket-square'>&#xf172; fa-bitbucket-square</option>
                                                                                <option value='fa-bitcoin'>&#xf15a; fa-bitcoin</option>
                                                                                <option value='fa-black-tie'>&#xf27e; fa-black-tie</option>
                                                                                <option value='fa-blind'>&#xf29d; fa-blind</option>
                                                                                <option value='fa-bluetooth'>&#xf293; fa-bluetooth</option>
                                                                                <option value='fa-bluetooth-b'>&#xf294; fa-bluetooth-b</option>
                                                                                <option value='fa-bold'>&#xf032; fa-bold</option>
                                                                                <option value='fa-bolt'>&#xf0e7; fa-bolt</option>
                                                                                <option value='fa-bomb'>&#xf1e2; fa-bomb</option>
                                                                                <option value='fa-book'>&#xf02d; fa-book</option>
                                                                                <option value='fa-bookmark'>&#xf02e; fa-bookmark</option>
                                                                                <option value='fa-bookmark-o'>&#xf097; fa-bookmark-o</option>
                                                                                <option value='fa-braille'>&#xf2a1; fa-braille</option>
                                                                                <option value='fa-briefcase'>&#xf0b1; fa-briefcase</option>
                                                                                <option value='fa-btc'>&#xf15a; fa-btc</option>
                                                                                <option value='fa-bug'>&#xf188; fa-bug</option>
                                                                                <option value='fa-building'>&#xf1ad; fa-building</option>
                                                                                <option value='fa-building-o'>&#xf0f7; fa-building-o</option>
                                                                                <option value='fa-bullhorn'>&#xf0a1; fa-bullhorn</option>
                                                                                <option value='fa-bullseye'>&#xf140; fa-bullseye</option>
                                                                                <option value='fa-bus'>&#xf207; fa-bus</option>
                                                                                <option value='fa-buysellads'>&#xf20d; fa-buysellads</option>
                                                                                <option value='fa-cab'>&#xf1ba; fa-cab</option>
                                                                                <option value='fa-calculator'>&#xf1ec; fa-calculator</option>
                                                                                <option value='fa-calendar'>&#xf073; fa-calendar</option>
                                                                                <option value='fa-calendar-check-o'>&#xf274; fa-calendar-check-o</option>
                                                                                <option value='fa-calendar-minus-o'>&#xf272; fa-calendar-minus-o</option>
                                                                                <option value='fa-calendar-o'>&#xf133; fa-calendar-o</option>
                                                                                <option value='fa-calendar-plus-o'>&#xf271; fa-calendar-plus-o</option>
                                                                                <option value='fa-calendar-times-o'>&#xf273; fa-calendar-times-o</option>
                                                                                <option value='fa-camera'>&#xf030; fa-camera</option>
                                                                                <option value='fa-camera-retro'>&#xf083; fa-camera-retro</option>
                                                                                <option value='fa-car'>&#xf1b9; fa-car</option>
                                                                                <option value='fa-caret-down'>&#xf0d7; fa-caret-down</option>
                                                                                <option value='fa-caret-left'>&#xf0d9; fa-caret-left</option>
                                                                                <option value='fa-caret-right'>&#xf0da; fa-caret-right</option>
                                                                                <option value='fa-caret-square-o-down'>&#xf150; fa-caret-square-o-down</option>
                                                                                <option value='fa-caret-square-o-left'>&#xf191; fa-caret-square-o-left</option>
                                                                                <option value='fa-caret-square-o-right'>&#xf152; fa-caret-square-o-right</option>
                                                                                <option value='fa-caret-square-o-up'>&#xf151; fa-caret-square-o-up</option>
                                                                                <option value='fa-caret-up'>&#xf0d8; fa-caret-up</option>
                                                                                <option value='fa-cart-arrow-down'>&#xf218; fa-cart-arrow-down</option>
                                                                                <option value='fa-cart-plus'>&#xf217; fa-cart-plus</option>
                                                                                <option value='fa-cc'>&#xf20a; fa-cc</option>
                                                                                <option value='fa-cc-amex'>&#xf1f3; fa-cc-amex</option>
                                                                                <option value='fa-cc-diners-club'>&#xf24c; fa-cc-diners-club</option>
                                                                                <option value='fa-cc-discover'>&#xf1f2; fa-cc-discover</option>
                                                                                <option value='fa-cc-jcb'>&#xf24b; fa-cc-jcb</option>
                                                                                <option value='fa-cc-mastercard'>&#xf1f1; fa-cc-mastercard</option>
                                                                                <option value='fa-cc-paypal'>&#xf1f4; fa-cc-paypal</option>
                                                                                <option value='fa-cc-stripe'>&#xf1f5; fa-cc-stripe</option>
                                                                                <option value='fa-cc-visa'>&#xf1f0; fa-cc-visa</option>
                                                                                <option value='fa-certificate'>&#xf0a3; fa-certificate</option>
                                                                                <option value='fa-chain'>&#xf0c1; fa-chain</option>
                                                                                <option value='fa-chain-broken'>&#xf127; fa-chain-broken</option>
                                                                                <option value='fa-check'>&#xf00c; fa-check</option>
                                                                                <option value='fa-check-circle'>&#xf058; fa-check-circle</option>
                                                                                <option value='fa-check-circle-o'>&#xf05d; fa-check-circle-o</option>
                                                                                <option value='fa-check-square'>&#xf14a; fa-check-square</option>
                                                                                <option value='fa-check-square-o'>&#xf046; fa-check-square-o</option>
                                                                                <option value='fa-chevron-circle-down'>&#xf13a; fa-chevron-circle-down</option>
                                                                                <option value='fa-chevron-circle-left'>&#xf137; fa-chevron-circle-left</option>
                                                                                <option value='fa-chevron-circle-right'>&#xf138; fa-chevron-circle-right</option>
                                                                                <option value='fa-chevron-circle-up'>&#xf139; fa-chevron-circle-up</option>
                                                                                <option value='fa-chevron-down'>&#xf078; fa-chevron-down</option>
                                                                                <option value='fa-chevron-left'>&#xf053; fa-chevron-left</option>
                                                                                <option value='fa-chevron-right'>&#xf054; fa-chevron-right</option>
                                                                                <option value='fa-chevron-up'>&#xf077; fa-chevron-up</option>
                                                                                <option value='fa-child'>&#xf1ae; fa-child</option>
                                                                                <option value='fa-chrome'>&#xf268; fa-chrome</option>
                                                                                <option value='fa-circle'>&#xf111; fa-circle</option>
                                                                                <option value='fa-circle-o'>&#xf10c; fa-circle-o</option>
                                                                                <option value='fa-circle-o-notch'>&#xf1ce; fa-circle-o-notch</option>
                                                                                <option value='fa-circle-thin'>&#xf1db; fa-circle-thin</option>
                                                                                <option value='fa-clipboard'>&#xf0ea; fa-clipboard</option>
                                                                                <option value='fa-clock-o'>&#xf017; fa-clock-o</option>
                                                                                <option value='fa-clone'>&#xf24d; fa-clone</option>
                                                                                <option value='fa-close'>&#xf00d; fa-close</option>
                                                                                <option value='fa-cloud'>&#xf0c2; fa-cloud</option>
                                                                                <option value='fa-cloud-download'>&#xf0ed; fa-cloud-download</option>
                                                                                <option value='fa-cloud-upload'>&#xf0ee; fa-cloud-upload</option>
                                                                                <option value='fa-cny'>&#xf157; fa-cny</option>
                                                                                <option value='fa-code'>&#xf121; fa-code</option>
                                                                                <option value='fa-code-fork'>&#xf126; fa-code-fork</option>
                                                                                <option value='fa-codepen'>&#xf1cb; fa-codepen</option>
                                                                                <option value='fa-codiepie'>&#xf284; fa-codiepie</option>
                                                                                <option value='fa-coffee'>&#xf0f4; fa-coffee</option>
                                                                                <option value='fa-cog'>&#xf013; fa-cog</option>
                                                                                <option value='fa-cogs'>&#xf085; fa-cogs</option>
                                                                                <option value='fa-columns'>&#xf0db; fa-columns</option>
                                                                                <option value='fa-comment'>&#xf075; fa-comment</option>
                                                                                <option value='fa-comment-o'>&#xf0e5; fa-comment-o</option>
                                                                                <option value='fa-commenting'>&#xf27a; fa-commenting</option>
                                                                                <option value='fa-commenting-o'>&#xf27b; fa-commenting-o</option>
                                                                                <option value='fa-comments'>&#xf086; fa-comments</option>
                                                                                <option value='fa-comments-o'>&#xf0e6; fa-comments-o</option>
                                                                                <option value='fa-compass'>&#xf14e; fa-compass</option>
                                                                                <option value='fa-compress'>&#xf066; fa-compress</option>
                                                                                <option value='fa-connectdevelop'>&#xf20e; fa-connectdevelop</option>
                                                                                <option value='fa-contao'>&#xf26d; fa-contao</option>
                                                                                <option value='fa-copy'>&#xf0c5; fa-copy</option>
                                                                                <option value='fa-copyright'>&#xf1f9; fa-copyright</option>
                                                                                <option value='fa-creative-commons'>&#xf25e; fa-creative-commons</option>
                                                                                <option value='fa-credit-card'>&#xf09d; fa-credit-card</option>
                                                                                <option value='fa-credit-card-alt'>&#xf283; fa-credit-card-alt</option>
                                                                                <option value='fa-crop'>&#xf125; fa-crop</option>
                                                                                <option value='fa-crosshairs'>&#xf05b; fa-crosshairs</option>
                                                                                <option value='fa-css3'>&#xf13c; fa-css3</option>
                                                                                <option value='fa-cube'>&#xf1b2; fa-cube</option>
                                                                                <option value='fa-cubes'>&#xf1b3; fa-cubes</option>
                                                                                <option value='fa-cut'>&#xf0c4; fa-cut</option>
                                                                                <option value='fa-cutlery'>&#xf0f5; fa-cutlery</option>
                                                                                <option value='fa-dashboard'>&#xf0e4; fa-dashboard</option>
                                                                                <option value='fa-dashcube'>&#xf210; fa-dashcube</option>
                                                                                <option value='fa-database'>&#xf1c0; fa-database</option>
                                                                                <option value='fa-deaf'>&#xf2a4; fa-deaf</option>
                                                                                <option value='fa-deafness'>&#xf2a4; fa-deafness</option>
                                                                                <option value='fa-dedent'>&#xf03b; fa-dedent</option>
                                                                                <option value='fa-delicious'>&#xf1a5; fa-delicious</option>
                                                                                <option value='fa-desktop'>&#xf108; fa-desktop</option>
                                                                                <option value='fa-deviantart'>&#xf1bd; fa-deviantart</option>
                                                                                <option value='fa-diamond'>&#xf219; fa-diamond</option>
                                                                                <option value='fa-digg'>&#xf1a6; fa-digg</option>
                                                                                <option value='fa-dollar'>&#xf155; fa-dollar</option>
                                                                                <option value='fa-dot-circle-o'>&#xf192; fa-dot-circle-o</option>
                                                                                <option value='fa-download'>&#xf019; fa-download</option>
                                                                                <option value='fa-dribbble'>&#xf17d; fa-dribbble</option>
                                                                                <option value='fa-drivers-license'>&#xf2c2; fa-drivers-license</option>
                                                                                <option value='fa-drivers-license-o'>&#xf2c3; fa-drivers-license-o</option>
                                                                                <option value='fa-dropbox'>&#xf16b; fa-dropbox</option>
                                                                                <option value='fa-drupal'>&#xf1a9; fa-drupal</option>
                                                                                <option value='fa-edge'>&#xf282; fa-edge</option>
                                                                                <option value='fa-edit'>&#xf044; fa-edit</option>
                                                                                <option value='fa-eercast'>&#xf2da; fa-eercast</option>
                                                                                <option value='fa-eject'>&#xf052; fa-eject</option>
                                                                                <option value='fa-ellipsis-h'>&#xf141; fa-ellipsis-h</option>
                                                                                <option value='fa-ellipsis-v'>&#xf142; fa-ellipsis-v</option>
                                                                                <option value='fa-empire'>&#xf1d1; fa-empire</option>
                                                                                <option value='fa-envelope'>&#xf0e0; fa-envelope</option>
                                                                                <option value='fa-envelope-o'>&#xf003; fa-envelope-o</option>
                                                                                <option value='fa-envelope-open'>&#xf2b6; fa-envelope-open</option>
                                                                                <option value='fa-envelope-open-o'>&#xf2b7; fa-envelope-open-o</option>
                                                                                <option value='fa-envelope-square'>&#xf199; fa-envelope-square</option>
                                                                                <option value='fa-envira'>&#xf299; fa-envira</option>
                                                                                <option value='fa-eraser'>&#xf12d; fa-eraser</option>
                                                                                <option value='fa-etsy'>&#xf2d7; fa-etsy</option>
                                                                                <option value='fa-eur'>&#xf153; fa-eur</option>
                                                                                <option value='fa-euro'>&#xf153; fa-euro</option>
                                                                                <option value='fa-exchange'>&#xf0ec; fa-exchange</option>
                                                                                <option value='fa-exclamation'>&#xf12a; fa-exclamation</option>
                                                                                <option value='fa-exclamation-circle'>&#xf06a; fa-exclamation-circle</option>
                                                                                <option value='fa-exclamation-triangle'>&#xf071; fa-exclamation-triangle</option>
                                                                                <option value='fa-expand'>&#xf065; fa-expand</option>
                                                                                <option value='fa-expeditedssl'>&#xf23e; fa-expeditedssl</option>
                                                                                <option value='fa-external-link'>&#xf08e; fa-external-link</option>
                                                                                <option value='fa-external-link-square'>&#xf14c; fa-external-link-square</option>
                                                                                <option value='fa-eye'>&#xf06e; fa-eye</option>
                                                                                <option value='fa-eye-slash'>&#xf070; fa-eye-slash</option>
                                                                                <option value='fa-eyedropper'>&#xf1fb; fa-eyedropper</option>
                                                                                <option value='fa-fa'>&#xf2b4; fa-fa</option>
                                                                                <option value='fa-facebook'>&#xf09a; fa-facebook</option>
                                                                                <option value='fa-facebook-f'>&#xf09a; fa-facebook-f</option>
                                                                                <option value='fa-facebook-official'>&#xf230; fa-facebook-official</option>
                                                                                <option value='fa-facebook-square'>&#xf082; fa-facebook-square</option>
                                                                                <option value='fa-fast-backward'>&#xf049; fa-fast-backward</option>
                                                                                <option value='fa-fast-forward'>&#xf050; fa-fast-forward</option>
                                                                                <option value='fa-fax'>&#xf1ac; fa-fax</option>
                                                                                <option value='fa-feed'>&#xf09e; fa-feed</option>
                                                                                <option value='fa-female'>&#xf182; fa-female</option>
                                                                                <option value='fa-fighter-jet'>&#xf0fb; fa-fighter-jet</option>
                                                                                <option value='fa-file'>&#xf15b; fa-file</option>
                                                                                <option value='fa-file-archive-o'>&#xf1c6; fa-file-archive-o</option>
                                                                                <option value='fa-file-audio-o'>&#xf1c7; fa-file-audio-o</option>
                                                                                <option value='fa-file-code-o'>&#xf1c9; fa-file-code-o</option>
                                                                                <option value='fa-file-excel-o'>&#xf1c3; fa-file-excel-o</option>
                                                                                <option value='fa-file-image-o'>&#xf1c5; fa-file-image-o</option>
                                                                                <option value='fa-file-movie-o'>&#xf1c8; fa-file-movie-o</option>
                                                                                <option value='fa-file-o'>&#xf016; fa-file-o</option>
                                                                                <option value='fa-file-pdf-o'>&#xf1c1; fa-file-pdf-o</option>
                                                                                <option value='fa-file-photo-o'>&#xf1c5; fa-file-photo-o</option>
                                                                                <option value='fa-file-picture-o'>&#xf1c5; fa-file-picture-o</option>
                                                                                <option value='fa-file-powerpoint-o'>&#xf1c4; fa-file-powerpoint-o</option>
                                                                                <option value='fa-file-sound-o'>&#xf1c7; fa-file-sound-o</option>
                                                                                <option value='fa-file-text'>&#xf15c; fa-file-text</option>
                                                                                <option value='fa-file-text-o'>&#xf0f6; fa-file-text-o</option>
                                                                                <option value='fa-file-video-o'>&#xf1c8; fa-file-video-o</option>
                                                                                <option value='fa-file-word-o'>&#xf1c2; fa-file-word-o</option>
                                                                                <option value='fa-file-zip-o'>&#xf1c6; fa-file-zip-o</option>
                                                                                <option value='fa-files-o'>&#xf0c5; fa-files-o</option>
                                                                                <option value='fa-film'>&#xf008; fa-film</option>
                                                                                <option value='fa-filter'>&#xf0b0; fa-filter</option>
                                                                                <option value='fa-fire'>&#xf06d; fa-fire</option>
                                                                                <option value='fa-fire-extinguisher'>&#xf134; fa-fire-extinguisher</option>
                                                                                <option value='fa-firefox'>&#xf269; fa-firefox</option>
                                                                                <option value='fa-first-order'>&#xf2b0; fa-first-order</option>
                                                                                <option value='fa-flag'>&#xf024; fa-flag</option>
                                                                                <option value='fa-flag-checkered'>&#xf11e; fa-flag-checkered</option>
                                                                                <option value='fa-flag-o'>&#xf11d; fa-flag-o</option>
                                                                                <option value='fa-flash'>&#xf0e7; fa-flash</option>
                                                                                <option value='fa-flask'>&#xf0c3; fa-flask</option>
                                                                                <option value='fa-flickr'>&#xf16e; fa-flickr</option>
                                                                                <option value='fa-floppy-o'>&#xf0c7; fa-floppy-o</option>
                                                                                <option value='fa-folder'>&#xf07b; fa-folder</option>
                                                                                <option value='fa-folder-o'>&#xf114; fa-folder-o</option>
                                                                                <option value='fa-folder-open'>&#xf07c; fa-folder-open</option>
                                                                                <option value='fa-folder-open-o'>&#xf115; fa-folder-open-o</option>
                                                                                <option value='fa-font'>&#xf031; fa-font</option>
                                                                                <option value='fa-font-awesome'>&#xf2b4; fa-font-awesome</option>
                                                                                <option value='fa-fonticons'>&#xf280; fa-fonticons</option>
                                                                                <option value='fa-fort-awesome'>&#xf286; fa-fort-awesome</option>
                                                                                <option value='fa-forumbee'>&#xf211; fa-forumbee</option>
                                                                                <option value='fa-forward'>&#xf04e; fa-forward</option>
                                                                                <option value='fa-foursquare'>&#xf180; fa-foursquare</option>
                                                                                <option value='fa-free-code-camp'>&#xf2c5; fa-free-code-camp</option>
                                                                                <option value='fa-frown-o'>&#xf119; fa-frown-o</option>
                                                                                <option value='fa-futbol-o'>&#xf1e3; fa-futbol-o</option>
                                                                                <option value='fa-gamepad'>&#xf11b; fa-gamepad</option>
                                                                                <option value='fa-gavel'>&#xf0e3; fa-gavel</option>
                                                                                <option value='fa-gbp'>&#xf154; fa-gbp</option>
                                                                                <option value='fa-ge'>&#xf1d1; fa-ge</option>
                                                                                <option value='fa-gear'>&#xf013; fa-gear</option>
                                                                                <option value='fa-gears'>&#xf085; fa-gears</option>
                                                                                <option value='fa-genderless'>&#xf22d; fa-genderless</option>
                                                                                <option value='fa-get-pocket'>&#xf265; fa-get-pocket</option>
                                                                                <option value='fa-gg'>&#xf260; fa-gg</option>
                                                                                <option value='fa-gg-circle'>&#xf261; fa-gg-circle</option>
                                                                                <option value='fa-gift'>&#xf06b; fa-gift</option>
                                                                                <option value='fa-git'>&#xf1d3; fa-git</option>
                                                                                <option value='fa-git-square'>&#xf1d2; fa-git-square</option>
                                                                                <option value='fa-github'>&#xf09b; fa-github</option>
                                                                                <option value='fa-github-alt'>&#xf113; fa-github-alt</option>
                                                                                <option value='fa-github-square'>&#xf092; fa-github-square</option>
                                                                                <option value='fa-gitlab'>&#xf296; fa-gitlab</option>
                                                                                <option value='fa-gittip'>&#xf184; fa-gittip</option>
                                                                                <option value='fa-glass'>&#xf000; fa-glass</option>
                                                                                <option value='fa-glide'>&#xf2a5; fa-glide</option>
                                                                                <option value='fa-glide-g'>&#xf2a6; fa-glide-g</option>
                                                                                <option value='fa-globe'>&#xf0ac; fa-globe</option>
                                                                                <option value='fa-google'>&#xf1a0; fa-google</option>
                                                                                <option value='fa-google-plus'>&#xf0d5; fa-google-plus</option>
                                                                                <option value='fa-google-plus-circle'>&#xf2b3; fa-google-plus-circle</option>
                                                                                <option value='fa-google-plus-official'>&#xf2b3; fa-google-plus-official</option>
                                                                                <option value='fa-google-plus-square'>&#xf0d4; fa-google-plus-square</option>
                                                                                <option value='fa-google-wallet'>&#xf1ee; fa-google-wallet</option>
                                                                                <option value='fa-graduation-cap'>&#xf19d; fa-graduation-cap</option>
                                                                                <option value='fa-gratipay'>&#xf184; fa-gratipay</option>
                                                                                <option value='fa-grav'>&#xf2d6; fa-grav</option>
                                                                                <option value='fa-group'>&#xf0c0; fa-group</option>
                                                                                <option value='fa-h-square'>&#xf0fd; fa-h-square</option>
                                                                                <option value='fa-hacker-news'>&#xf1d4; fa-hacker-news</option>
                                                                                <option value='fa-hand-grab-o'>&#xf255; fa-hand-grab-o</option>
                                                                                <option value='fa-hand-lizard-o'>&#xf258; fa-hand-lizard-o</option>
                                                                                <option value='fa-hand-o-down'>&#xf0a7; fa-hand-o-down</option>
                                                                                <option value='fa-hand-o-left'>&#xf0a5; fa-hand-o-left</option>
                                                                                <option value='fa-hand-o-right'>&#xf0a4; fa-hand-o-right</option>
                                                                                <option value='fa-hand-o-up'>&#xf0a6; fa-hand-o-up</option>
                                                                                <option value='fa-hand-paper-o'>&#xf256; fa-hand-paper-o</option>
                                                                                <option value='fa-hand-peace-o'>&#xf25b; fa-hand-peace-o</option>
                                                                                <option value='fa-hand-pointer-o'>&#xf25a; fa-hand-pointer-o</option>
                                                                                <option value='fa-hand-rock-o'>&#xf255; fa-hand-rock-o</option>
                                                                                <option value='fa-hand-scissors-o'>&#xf257; fa-hand-scissors-o</option>
                                                                                <option value='fa-hand-spock-o'>&#xf259; fa-hand-spock-o</option>
                                                                                <option value='fa-hand-stop-o'>&#xf256; fa-hand-stop-o</option>
                                                                                <option value='fa-handshake-o'>&#xf2b5; fa-handshake-o</option>
                                                                                <option value='fa-hard-of-hearing'>&#xf2a4; fa-hard-of-hearing</option>
                                                                                <option value='fa-hashtag'>&#xf292; fa-hashtag</option>
                                                                                <option value='fa-hdd-o'>&#xf0a0; fa-hdd-o</option>
                                                                                <option value='fa-header'>&#xf1dc; fa-header</option>
                                                                                <option value='fa-headphones'>&#xf025; fa-headphones</option>
                                                                                <option value='fa-heart'>&#xf004; fa-heart</option>
                                                                                <option value='fa-heart-o'>&#xf08a; fa-heart-o</option>
                                                                                <option value='fa-heartbeat'>&#xf21e; fa-heartbeat</option>
                                                                                <option value='fa-history'>&#xf1da; fa-history</option>
                                                                                <option value='fa-home'>&#xf015; fa-home</option>
                                                                                <option value='fa-hospital-o'>&#xf0f8; fa-hospital-o</option>
                                                                                <option value='fa-hotel'>&#xf236; fa-hotel</option>
                                                                                <option value='fa-hourglass'>&#xf254; fa-hourglass</option>
                                                                                <option value='fa-hourglass-1'>&#xf251; fa-hourglass-1</option>
                                                                                <option value='fa-hourglass-2'>&#xf252; fa-hourglass-2</option>
                                                                                <option value='fa-hourglass-3'>&#xf253; fa-hourglass-3</option>
                                                                                <option value='fa-hourglass-end'>&#xf253; fa-hourglass-end</option>
                                                                                <option value='fa-hourglass-half'>&#xf252; fa-hourglass-half</option>
                                                                                <option value='fa-hourglass-o'>&#xf250; fa-hourglass-o</option>
                                                                                <option value='fa-hourglass-start'>&#xf251; fa-hourglass-start</option>
                                                                                <option value='fa-houzz'>&#xf27c; fa-houzz</option>
                                                                                <option value='fa-html5'>&#xf13b; fa-html5</option>
                                                                                <option value='fa-i-cursor'>&#xf246; fa-i-cursor</option>
                                                                                <option value='fa-id-badge'>&#xf2c1; fa-id-badge</option>
                                                                                <option value='fa-id-card'>&#xf2c2; fa-id-card</option>
                                                                                <option value='fa-id-card-o'>&#xf2c3; fa-id-card-o</option>
                                                                                <option value='fa-ils'>&#xf20b; fa-ils</option>
                                                                                <option value='fa-image'>&#xf03e; fa-image</option>
                                                                                <option value='fa-imdb'>&#xf2d8; fa-imdb</option>
                                                                                <option value='fa-inbox'>&#xf01c; fa-inbox</option>
                                                                                <option value='fa-indent'>&#xf03c; fa-indent</option>
                                                                                <option value='fa-industry'>&#xf275; fa-industry</option>
                                                                                <option value='fa-info'>&#xf129; fa-info</option>
                                                                                <option value='fa-info-circle'>&#xf05a; fa-info-circle</option>
                                                                                <option value='fa-inr'>&#xf156; fa-inr</option>
                                                                                <option value='fa-instagram'>&#xf16d; fa-instagram</option>
                                                                                <option value='fa-institution'>&#xf19c; fa-institution</option>
                                                                                <option value='fa-internet-explorer'>&#xf26b; fa-internet-explorer</option>
                                                                                <option value='fa-intersex'>&#xf224; fa-intersex</option>
                                                                                <option value='fa-ioxhost'>&#xf208; fa-ioxhost</option>
                                                                                <option value='fa-italic'>&#xf033; fa-italic</option>
                                                                                <option value='fa-joomla'>&#xf1aa; fa-joomla</option>
                                                                                <option value='fa-jpy'>&#xf157; fa-jpy</option>
                                                                                <option value='fa-jsfiddle'>&#xf1cc; fa-jsfiddle</option>
                                                                                <option value='fa-key'>&#xf084; fa-key</option>
                                                                                <option value='fa-keyboard-o'>&#xf11c; fa-keyboard-o</option>
                                                                                <option value='fa-krw'>&#xf159; fa-krw</option>
                                                                                <option value='fa-language'>&#xf1ab; fa-language</option>
                                                                                <option value='fa-laptop'>&#xf109; fa-laptop</option>
                                                                                <option value='fa-lastfm'>&#xf202; fa-lastfm</option>
                                                                                <option value='fa-lastfm-square'>&#xf203; fa-lastfm-square</option>
                                                                                <option value='fa-leaf'>&#xf06c; fa-leaf</option>
                                                                                <option value='fa-leanpub'>&#xf212; fa-leanpub</option>
                                                                                <option value='fa-legal'>&#xf0e3; fa-legal</option>
                                                                                <option value='fa-lemon-o'>&#xf094; fa-lemon-o</option>
                                                                                <option value='fa-level-down'>&#xf149; fa-level-down</option>
                                                                                <option value='fa-level-up'>&#xf148; fa-level-up</option>
                                                                                <option value='fa-life-bouy'>&#xf1cd; fa-life-bouy</option>
                                                                                <option value='fa-life-buoy'>&#xf1cd; fa-life-buoy</option>
                                                                                <option value='fa-life-ring'>&#xf1cd; fa-life-ring</option>
                                                                                <option value='fa-life-saver'>&#xf1cd; fa-life-saver</option>
                                                                                <option value='fa-lightbulb-o'>&#xf0eb; fa-lightbulb-o</option>
                                                                                <option value='fa-line-chart'>&#xf201; fa-line-chart</option>
                                                                                <option value='fa-link'>&#xf0c1; fa-link</option>
                                                                                <option value='fa-linkedin'>&#xf0e1; fa-linkedin</option>
                                                                                <option value='fa-linkedin-square'>&#xf08c; fa-linkedin-square</option>
                                                                                <option value='fa-linode'>&#xf2b8; fa-linode</option>
                                                                                <option value='fa-linux'>&#xf17c; fa-linux</option>
                                                                                <option value='fa-list'>&#xf03a; fa-list</option>
                                                                                <option value='fa-list-alt'>&#xf022; fa-list-alt</option>
                                                                                <option value='fa-list-ol'>&#xf0cb; fa-list-ol</option>
                                                                                <option value='fa-list-ul'>&#xf0ca; fa-list-ul</option>
                                                                                <option value='fa-location-arrow'>&#xf124; fa-location-arrow</option>
                                                                                <option value='fa-lock'>&#xf023; fa-lock</option>
                                                                                <option value='fa-long-arrow-down'>&#xf175; fa-long-arrow-down</option>
                                                                                <option value='fa-long-arrow-left'>&#xf177; fa-long-arrow-left</option>
                                                                                <option value='fa-long-arrow-right'>&#xf178; fa-long-arrow-right</option>
                                                                                <option value='fa-long-arrow-up'>&#xf176; fa-long-arrow-up</option>
                                                                                <option value='fa-low-vision'>&#xf2a8; fa-low-vision</option>
                                                                                <option value='fa-magic'>&#xf0d0; fa-magic</option>
                                                                                <option value='fa-magnet'>&#xf076; fa-magnet</option>
                                                                                <option value='fa-mail-forward'>&#xf064; fa-mail-forward</option>
                                                                                <option value='fa-mail-reply'>&#xf112; fa-mail-reply</option>
                                                                                <option value='fa-mail-reply-all'>&#xf122; fa-mail-reply-all</option>
                                                                                <option value='fa-male'>&#xf183; fa-male</option>
                                                                                <option value='fa-map'>&#xf279; fa-map</option>
                                                                                <option value='fa-map-marker'>&#xf041; fa-map-marker</option>
                                                                                <option value='fa-map-o'>&#xf278; fa-map-o</option>
                                                                                <option value='fa-map-pin'>&#xf276; fa-map-pin</option>
                                                                                <option value='fa-map-signs'>&#xf277; fa-map-signs</option>
                                                                                <option value='fa-mars'>&#xf222; fa-mars</option>
                                                                                <option value='fa-mars-double'>&#xf227; fa-mars-double</option>
                                                                                <option value='fa-mars-stroke'>&#xf229; fa-mars-stroke</option>
                                                                                <option value='fa-mars-stroke-h'>&#xf22b; fa-mars-stroke-h</option>
                                                                                <option value='fa-mars-stroke-v'>&#xf22a; fa-mars-stroke-v</option>
                                                                                <option value='fa-maxcdn'>&#xf136; fa-maxcdn</option>
                                                                                <option value='fa-meanpath'>&#xf20c; fa-meanpath</option>
                                                                                <option value='fa-medium'>&#xf23a; fa-medium</option>
                                                                                <option value='fa-medkit'>&#xf0fa; fa-medkit</option>
                                                                                <option value='fa-meetup'>&#xf2e0; fa-meetup</option>
                                                                                <option value='fa-meh-o'>&#xf11a; fa-meh-o</option>
                                                                                <option value='fa-mercury'>&#xf223; fa-mercury</option>
                                                                                <option value='fa-microchip'>&#xf2db; fa-microchip</option>
                                                                                <option value='fa-microphone'>&#xf130; fa-microphone</option>
                                                                                <option value='fa-microphone-slash'>&#xf131; fa-microphone-slash</option>
                                                                                <option value='fa-minus'>&#xf068; fa-minus</option>
                                                                                <option value='fa-minus-circle'>&#xf056; fa-minus-circle</option>
                                                                                <option value='fa-minus-square'>&#xf146; fa-minus-square</option>
                                                                                <option value='fa-minus-square-o'>&#xf147; fa-minus-square-o</option>
                                                                                <option value='fa-mixcloud'>&#xf289; fa-mixcloud</option>
                                                                                <option value='fa-mobile'>&#xf10b; fa-mobile</option>
                                                                                <option value='fa-mobile-phone'>&#xf10b; fa-mobile-phone</option>
                                                                                <option value='fa-modx'>&#xf285; fa-modx</option>
                                                                                <option value='fa-money'>&#xf0d6; fa-money</option>
                                                                                <option value='fa-moon-o'>&#xf186; fa-moon-o</option>
                                                                                <option value='fa-mortar-board'>&#xf19d; fa-mortar-board</option>
                                                                                <option value='fa-motorcycle'>&#xf21c; fa-motorcycle</option>
                                                                                <option value='fa-mouse-pointer'>&#xf245; fa-mouse-pointer</option>
                                                                                <option value='fa-music'>&#xf001; fa-music</option>
                                                                                <option value='fa-navicon'>&#xf0c9; fa-navicon</option>
                                                                                <option value='fa-neuter'>&#xf22c; fa-neuter</option>
                                                                                <option value='fa-newspaper-o'>&#xf1ea; fa-newspaper-o</option>
                                                                                <option value='fa-object-group'>&#xf247; fa-object-group</option>
                                                                                <option value='fa-object-ungroup'>&#xf248; fa-object-ungroup</option>
                                                                                <option value='fa-odnoklassniki'>&#xf263; fa-odnoklassniki</option>
                                                                                <option value='fa-odnoklassniki-square'>&#xf264; fa-odnoklassniki-square</option>
                                                                                <option value='fa-opencart'>&#xf23d; fa-opencart</option>
                                                                                <option value='fa-openid'>&#xf19b; fa-openid</option>
                                                                                <option value='fa-opera'>&#xf26a; fa-opera</option>
                                                                                <option value='fa-optin-monster'>&#xf23c; fa-optin-monster</option>
                                                                                <option value='fa-outdent'>&#xf03b; fa-outdent</option>
                                                                                <option value='fa-pagelines'>&#xf18c; fa-pagelines</option>
                                                                                <option value='fa-paint-brush'>&#xf1fc; fa-paint-brush</option>
                                                                                <option value='fa-paper-plane'>&#xf1d8; fa-paper-plane</option>
                                                                                <option value='fa-paper-plane-o'>&#xf1d9; fa-paper-plane-o</option>
                                                                                <option value='fa-paperclip'>&#xf0c6; fa-paperclip</option>
                                                                                <option value='fa-paragraph'>&#xf1dd; fa-paragraph</option>
                                                                                <option value='fa-paste'>&#xf0ea; fa-paste</option>
                                                                                <option value='fa-pause'>&#xf04c; fa-pause</option>
                                                                                <option value='fa-pause-circle'>&#xf28b; fa-pause-circle</option>
                                                                                <option value='fa-pause-circle-o'>&#xf28c; fa-pause-circle-o</option>
                                                                                <option value='fa-paw'>&#xf1b0; fa-paw</option>
                                                                                <option value='fa-paypal'>&#xf1ed; fa-paypal</option>
                                                                                <option value='fa-pencil'>&#xf040; fa-pencil</option>
                                                                                <option value='fa-pencil-square'>&#xf14b; fa-pencil-square</option>
                                                                                <option value='fa-pencil-square-o'>&#xf044; fa-pencil-square-o</option>
                                                                                <option value='fa-percent'>&#xf295; fa-percent</option>
                                                                                <option value='fa-phone'>&#xf095; fa-phone</option>
                                                                                <option value='fa-phone-square'>&#xf098; fa-phone-square</option>
                                                                                <option value='fa-photo'>&#xf03e; fa-photo</option>
                                                                                <option value='fa-picture-o'>&#xf03e; fa-picture-o</option>
                                                                                <option value='fa-pie-chart'>&#xf200; fa-pie-chart</option>
                                                                                <option value='fa-pied-piper'>&#xf2ae; fa-pied-piper</option>
                                                                                <option value='fa-pied-piper-alt'>&#xf1a8; fa-pied-piper-alt</option>
                                                                                <option value='fa-pied-piper-pp'>&#xf1a7; fa-pied-piper-pp</option>
                                                                                <option value='fa-pinterest'>&#xf0d2; fa-pinterest</option>
                                                                                <option value='fa-pinterest-p'>&#xf231; fa-pinterest-p</option>
                                                                                <option value='fa-pinterest-square'>&#xf0d3; fa-pinterest-square</option>
                                                                                <option value='fa-plane'>&#xf072; fa-plane</option>
                                                                                <option value='fa-play'>&#xf04b; fa-play</option>
                                                                                <option value='fa-play-circle'>&#xf144; fa-play-circle</option>
                                                                                <option value='fa-play-circle-o'>&#xf01d; fa-play-circle-o</option>
                                                                                <option value='fa-plug'>&#xf1e6; fa-plug</option>
                                                                                <option value='fa-plus'>&#xf067; fa-plus</option>
                                                                                <option value='fa-plus-circle'>&#xf055; fa-plus-circle</option>
                                                                                <option value='fa-plus-square'>&#xf0fe; fa-plus-square</option>
                                                                                <option value='fa-plus-square-o'>&#xf196; fa-plus-square-o</option>
                                                                                <option value='fa-podcast'>&#xf2ce; fa-podcast</option>
                                                                                <option value='fa-power-off'>&#xf011; fa-power-off</option>
                                                                                <option value='fa-print'>&#xf02f; fa-print</option>
                                                                                <option value='fa-product-hunt'>&#xf288; fa-product-hunt</option>
                                                                                <option value='fa-puzzle-piece'>&#xf12e; fa-puzzle-piece</option>
                                                                                <option value='fa-qq'>&#xf1d6; fa-qq</option>
                                                                                <option value='fa-qrcode'>&#xf029; fa-qrcode</option>
                                                                                <option value='fa-question'>&#xf128; fa-question</option>
                                                                                <option value='fa-question-circle'>&#xf059; fa-question-circle</option>
                                                                                <option value='fa-question-circle-o'>&#xf29c; fa-question-circle-o</option>
                                                                                <option value='fa-quora'>&#xf2c4; fa-quora</option>
                                                                                <option value='fa-quote-left'>&#xf10d; fa-quote-left</option>
                                                                                <option value='fa-quote-right'>&#xf10e; fa-quote-right</option>
                                                                                <option value='fa-ra'>&#xf1d0; fa-ra</option>
                                                                                <option value='fa-random'>&#xf074; fa-random</option>
                                                                                <option value='fa-ravelry'>&#xf2d9; fa-ravelry</option>
                                                                                <option value='fa-rebel'>&#xf1d0; fa-rebel</option>
                                                                                <option value='fa-recycle'>&#xf1b8; fa-recycle</option>
                                                                                <option value='fa-reddit'>&#xf1a1; fa-reddit</option>
                                                                                <option value='fa-reddit-alien'>&#xf281; fa-reddit-alien</option>
                                                                                <option value='fa-reddit-square'>&#xf1a2; fa-reddit-square</option>
                                                                                <option value='fa-refresh'>&#xf021; fa-refresh</option>
                                                                                <option value='fa-registered'>&#xf25d; fa-registered</option>
                                                                                <option value='fa-remove'>&#xf00d; fa-remove</option>
                                                                                <option value='fa-renren'>&#xf18b; fa-renren</option>
                                                                                <option value='fa-reorder'>&#xf0c9; fa-reorder</option>
                                                                                <option value='fa-repeat'>&#xf01e; fa-repeat</option>
                                                                                <option value='fa-reply'>&#xf112; fa-reply</option>
                                                                                <option value='fa-reply-all'>&#xf122; fa-reply-all</option>
                                                                                <option value='fa-resistance'>&#xf1d0; fa-resistance</option>
                                                                                <option value='fa-retweet'>&#xf079; fa-retweet</option>
                                                                                <option value='fa-rmb'>&#xf157; fa-rmb</option>
                                                                                <option value='fa-road'>&#xf018; fa-road</option>
                                                                                <option value='fa-rocket'>&#xf135; fa-rocket</option>
                                                                                <option value='fa-rotate-left'>&#xf0e2; fa-rotate-left</option>
                                                                                <option value='fa-rotate-right'>&#xf01e; fa-rotate-right</option>
                                                                                <option value='fa-rouble'>&#xf158; fa-rouble</option>
                                                                                <option value='fa-rss'>&#xf09e; fa-rss</option>
                                                                                <option value='fa-rss-square'>&#xf143; fa-rss-square</option>
                                                                                <option value='fa-rub'>&#xf158; fa-rub</option>
                                                                                <option value='fa-ruble'>&#xf158; fa-ruble</option>
                                                                                <option value='fa-rupee'>&#xf156; fa-rupee</option>
                                                                                <option value='fa-s15'>&#xf2cd; fa-s15</option>
                                                                                <option value='fa-safari'>&#xf267; fa-safari</option>
                                                                                <option value='fa-save'>&#xf0c7; fa-save</option>
                                                                                <option value='fa-scissors'>&#xf0c4; fa-scissors</option>
                                                                                <option value='fa-scribd'>&#xf28a; fa-scribd</option>
                                                                                <option value='fa-search'>&#xf002; fa-search</option>
                                                                                <option value='fa-search-minus'>&#xf010; fa-search-minus</option>
                                                                                <option value='fa-search-plus'>&#xf00e; fa-search-plus</option>
                                                                                <option value='fa-sellsy'>&#xf213; fa-sellsy</option>
                                                                                <option value='fa-send'>&#xf1d8; fa-send</option>
                                                                                <option value='fa-send-o'>&#xf1d9; fa-send-o</option>
                                                                                <option value='fa-server'>&#xf233; fa-server</option>
                                                                                <option value='fa-share'>&#xf064; fa-share</option>
                                                                                <option value='fa-share-alt'>&#xf1e0; fa-share-alt</option>
                                                                                <option value='fa-share-alt-square'>&#xf1e1; fa-share-alt-square</option>
                                                                                <option value='fa-share-square'>&#xf14d; fa-share-square</option>
                                                                                <option value='fa-share-square-o'>&#xf045; fa-share-square-o</option>
                                                                                <option value='fa-shekel'>&#xf20b; fa-shekel</option>
                                                                                <option value='fa-sheqel'>&#xf20b; fa-sheqel</option>
                                                                                <option value='fa-shield'>&#xf132; fa-shield</option>
                                                                                <option value='fa-ship'>&#xf21a; fa-ship</option>
                                                                                <option value='fa-shirtsinbulk'>&#xf214; fa-shirtsinbulk</option>
                                                                                <option value='fa-shopping-bag'>&#xf290; fa-shopping-bag</option>
                                                                                <option value='fa-shopping-basket'>&#xf291; fa-shopping-basket</option>
                                                                                <option value='fa-shopping-cart'>&#xf07a; fa-shopping-cart</option>
                                                                                <option value='fa-shower'>&#xf2cc; fa-shower</option>
                                                                                <option value='fa-sign-in'>&#xf090; fa-sign-in</option>
                                                                                <option value='fa-sign-language'>&#xf2a7; fa-sign-language</option>
                                                                                <option value='fa-sign-out'>&#xf08b; fa-sign-out</option>
                                                                                <option value='fa-signal'>&#xf012; fa-signal</option>
                                                                                <option value='fa-signing'>&#xf2a7; fa-signing</option>
                                                                                <option value='fa-simplybuilt'>&#xf215; fa-simplybuilt</option>
                                                                                <option value='fa-sitemap'>&#xf0e8; fa-sitemap</option>
                                                                                <option value='fa-skyatlas'>&#xf216; fa-skyatlas</option>
                                                                                <option value='fa-skype'>&#xf17e; fa-skype</option>
                                                                                <option value='fa-slack'>&#xf198; fa-slack</option>
                                                                                <option value='fa-sliders'>&#xf1de; fa-sliders</option>
                                                                                <option value='fa-slideshare'>&#xf1e7; fa-slideshare</option>
                                                                                <option value='fa-smile-o'>&#xf118; fa-smile-o</option>
                                                                                <option value='fa-snapchat'>&#xf2ab; fa-snapchat</option>
                                                                                <option value='fa-snapchat-ghost'>&#xf2ac; fa-snapchat-ghost</option>
                                                                                <option value='fa-snapchat-square'>&#xf2ad; fa-snapchat-square</option>
                                                                                <option value='fa-snowflake-o'>&#xf2dc; fa-snowflake-o</option>
                                                                                <option value='fa-soccer-ball-o'>&#xf1e3; fa-soccer-ball-o</option>
                                                                                <option value='fa-sort'>&#xf0dc; fa-sort</option>
                                                                                <option value='fa-sort-alpha-asc'>&#xf15d; fa-sort-alpha-asc</option>
                                                                                <option value='fa-sort-alpha-desc'>&#xf15e; fa-sort-alpha-desc</option>
                                                                                <option value='fa-sort-amount-asc'>&#xf160; fa-sort-amount-asc</option>
                                                                                <option value='fa-sort-amount-desc'>&#xf161; fa-sort-amount-desc</option>
                                                                                <option value='fa-sort-asc'>&#xf0de; fa-sort-asc</option>
                                                                                <option value='fa-sort-desc'>&#xf0dd; fa-sort-desc</option>
                                                                                <option value='fa-sort-down'>&#xf0dd; fa-sort-down</option>
                                                                                <option value='fa-sort-numeric-asc'>&#xf162; fa-sort-numeric-asc</option>
                                                                                <option value='fa-sort-numeric-desc'>&#xf163; fa-sort-numeric-desc</option>
                                                                                <option value='fa-sort-up'>&#xf0de; fa-sort-up</option>
                                                                                <option value='fa-soundcloud'>&#xf1be; fa-soundcloud</option>
                                                                                <option value='fa-space-shuttle'>&#xf197; fa-space-shuttle</option>
                                                                                <option value='fa-spinner'>&#xf110; fa-spinner</option>
                                                                                <option value='fa-spoon'>&#xf1b1; fa-spoon</option>
                                                                                <option value='fa-spotify'>&#xf1bc; fa-spotify</option>
                                                                                <option value='fa-square'>&#xf0c8; fa-square</option>
                                                                                <option value='fa-square-o'>&#xf096; fa-square-o</option>
                                                                                <option value='fa-stack-exchange'>&#xf18d; fa-stack-exchange</option>
                                                                                <option value='fa-stack-overflow'>&#xf16c; fa-stack-overflow</option>
                                                                                <option value='fa-star'>&#xf005; fa-star</option>
                                                                                <option value='fa-star-half'>&#xf089; fa-star-half</option>
                                                                                <option value='fa-star-half-empty'>&#xf123; fa-star-half-empty</option>
                                                                                <option value='fa-star-half-full'>&#xf123; fa-star-half-full</option>
                                                                                <option value='fa-star-half-o'>&#xf123; fa-star-half-o</option>
                                                                                <option value='fa-star-o'>&#xf006; fa-star-o</option>
                                                                                <option value='fa-steam'>&#xf1b6; fa-steam</option>
                                                                                <option value='fa-steam-square'>&#xf1b7; fa-steam-square</option>
                                                                                <option value='fa-step-backward'>&#xf048; fa-step-backward</option>
                                                                                <option value='fa-step-forward'>&#xf051; fa-step-forward</option>
                                                                                <option value='fa-stethoscope'>&#xf0f1; fa-stethoscope</option>
                                                                                <option value='fa-sticky-note'>&#xf249; fa-sticky-note</option>
                                                                                <option value='fa-sticky-note-o'>&#xf24a; fa-sticky-note-o</option>
                                                                                <option value='fa-stop'>&#xf04d; fa-stop</option>
                                                                                <option value='fa-stop-circle'>&#xf28d; fa-stop-circle</option>
                                                                                <option value='fa-stop-circle-o'>&#xf28e; fa-stop-circle-o</option>
                                                                                <option value='fa-street-view'>&#xf21d; fa-street-view</option>
                                                                                <option value='fa-strikethrough'>&#xf0cc; fa-strikethrough</option>
                                                                                <option value='fa-stumbleupon'>&#xf1a4; fa-stumbleupon</option>
                                                                                <option value='fa-stumbleupon-circle'>&#xf1a3; fa-stumbleupon-circle</option>
                                                                                <option value='fa-subscript'>&#xf12c; fa-subscript</option>
                                                                                <option value='fa-subway'>&#xf239; fa-subway</option>
                                                                                <option value='fa-suitcase'>&#xf0f2; fa-suitcase</option>
                                                                                <option value='fa-sun-o'>&#xf185; fa-sun-o</option>
                                                                                <option value='fa-superpowers'>&#xf2dd; fa-superpowers</option>
                                                                                <option value='fa-superscript'>&#xf12b; fa-superscript</option>
                                                                                <option value='fa-support'>&#xf1cd; fa-support</option>
                                                                                <option value='fa-table'>&#xf0ce; fa-table</option>
                                                                                <option value='fa-tablet'>&#xf10a; fa-tablet</option>
                                                                                <option value='fa-tachometer'>&#xf0e4; fa-tachometer</option>
                                                                                <option value='fa-tag'>&#xf02b; fa-tag</option>
                                                                                <option value='fa-tags' selected>&#xf02c; fa-tags</option>
                                                                                <option value='fa-tasks'>&#xf0ae; fa-tasks</option>
                                                                                <option value='fa-taxi'>&#xf1ba; fa-taxi</option>
                                                                                <option value='fa-telegram'>&#xf2c6; fa-telegram</option>
                                                                                <option value='fa-television'>&#xf26c; fa-television</option>
                                                                                <option value='fa-tencent-weibo'>&#xf1d5; fa-tencent-weibo</option>
                                                                                <option value='fa-terminal'>&#xf120; fa-terminal</option>
                                                                                <option value='fa-text-height'>&#xf034; fa-text-height</option>
                                                                                <option value='fa-text-width'>&#xf035; fa-text-width</option>
                                                                                <option value='fa-th'>&#xf00a; fa-th</option>
                                                                                <option value='fa-th-large'>&#xf009; fa-th-large</option>
                                                                                <option value='fa-th-list'>&#xf00b; fa-th-list</option>
                                                                                <option value='fa-themeisle'>&#xf2b2; fa-themeisle</option>
                                                                                <option value='fa-thermometer'>&#xf2c7; fa-thermometer</option>
                                                                                <option value='fa-thermometer-0'>&#xf2cb; fa-thermometer-0</option>
                                                                                <option value='fa-thermometer-1'>&#xf2ca; fa-thermometer-1</option>
                                                                                <option value='fa-thermometer-2'>&#xf2c9; fa-thermometer-2</option>
                                                                                <option value='fa-thermometer-3'>&#xf2c8; fa-thermometer-3</option>
                                                                                <option value='fa-thermometer-4'>&#xf2c7; fa-thermometer-4</option>
                                                                                <option value='fa-thermometer-empty'>&#xf2cb; fa-thermometer-empty</option>
                                                                                <option value='fa-thermometer-full'>&#xf2c7; fa-thermometer-full</option>
                                                                                <option value='fa-thermometer-half'>&#xf2c9; fa-thermometer-half</option>
                                                                                <option value='fa-thermometer-quarter'>&#xf2ca; fa-thermometer-quarter</option>
                                                                                <option value='fa-thermometer-three-quarters'>&#xf2c8; fa-thermometer-three-quarters</option>
                                                                                <option value='fa-thumb-tack'>&#xf08d; fa-thumb-tack</option>
                                                                                <option value='fa-thumbs-down'>&#xf165; fa-thumbs-down</option>
                                                                                <option value='fa-thumbs-o-down'>&#xf088; fa-thumbs-o-down</option>
                                                                                <option value='fa-thumbs-o-up'>&#xf087; fa-thumbs-o-up</option>
                                                                                <option value='fa-thumbs-up'>&#xf164; fa-thumbs-up</option>
                                                                                <option value='fa-ticket'>&#xf145; fa-ticket</option>
                                                                                <option value='fa-times'>&#xf00d; fa-times</option>
                                                                                <option value='fa-times-circle'>&#xf057; fa-times-circle</option>
                                                                                <option value='fa-times-circle-o'>&#xf05c; fa-times-circle-o</option>
                                                                                <option value='fa-times-rectangle'>&#xf2d3; fa-times-rectangle</option>
                                                                                <option value='fa-times-rectangle-o'>&#xf2d4; fa-times-rectangle-o</option>
                                                                                <option value='fa-tint'>&#xf043; fa-tint</option>
                                                                                <option value='fa-toggle-down'>&#xf150; fa-toggle-down</option>
                                                                                <option value='fa-toggle-left'>&#xf191; fa-toggle-left</option>
                                                                                <option value='fa-toggle-off'>&#xf204; fa-toggle-off</option>
                                                                                <option value='fa-toggle-on'>&#xf205; fa-toggle-on</option>
                                                                                <option value='fa-toggle-right'>&#xf152; fa-toggle-right</option>
                                                                                <option value='fa-toggle-up'>&#xf151; fa-toggle-up</option>
                                                                                <option value='fa-trademark'>&#xf25c; fa-trademark</option>
                                                                                <option value='fa-train'>&#xf238; fa-train</option>
                                                                                <option value='fa-transgender'>&#xf224; fa-transgender</option>
                                                                                <option value='fa-transgender-alt'>&#xf225; fa-transgender-alt</option>
                                                                                <option value='fa-trash'>&#xf1f8; fa-trash</option>
                                                                                <option value='fa-trash-o'>&#xf014; fa-trash-o</option>
                                                                                <option value='fa-tree'>&#xf1bb; fa-tree</option>
                                                                                <option value='fa-trello'>&#xf181; fa-trello</option>
                                                                                <option value='fa-tripadvisor'>&#xf262; fa-tripadvisor</option>
                                                                                <option value='fa-trophy'>&#xf091; fa-trophy</option>
                                                                                <option value='fa-truck'>&#xf0d1; fa-truck</option>
                                                                                <option value='fa-try'>&#xf195; fa-try</option>
                                                                                <option value='fa-tty'>&#xf1e4; fa-tty</option>
                                                                                <option value='fa-tumblr'>&#xf173; fa-tumblr</option>
                                                                                <option value='fa-tumblr-square'>&#xf174; fa-tumblr-square</option>
                                                                                <option value='fa-turkish-lira'>&#xf195; fa-turkish-lira</option>
                                                                                <option value='fa-tv'>&#xf26c; fa-tv</option>
                                                                                <option value='fa-twitch'>&#xf1e8; fa-twitch</option>
                                                                                <option value='fa-twitter'>&#xf099; fa-twitter</option>
                                                                                <option value='fa-twitter-square'>&#xf081; fa-twitter-square</option>
                                                                                <option value='fa-umbrella'>&#xf0e9; fa-umbrella</option>
                                                                                <option value='fa-underline'>&#xf0cd; fa-underline</option>
                                                                                <option value='fa-undo'>&#xf0e2; fa-undo</option>
                                                                                <option value='fa-universal-access'>&#xf29a; fa-universal-access</option>
                                                                                <option value='fa-university'>&#xf19c; fa-university</option>
                                                                                <option value='fa-unlink'>&#xf127; fa-unlink</option>
                                                                                <option value='fa-unlock'>&#xf09c; fa-unlock</option>
                                                                                <option value='fa-unlock-alt'>&#xf13e; fa-unlock-alt</option>
                                                                                <option value='fa-unsorted'>&#xf0dc; fa-unsorted</option>
                                                                                <option value='fa-upload'>&#xf093; fa-upload</option>
                                                                                <option value='fa-usb'>&#xf287; fa-usb</option>
                                                                                <option value='fa-usd'>&#xf155; fa-usd</option>
                                                                                <option value='fa-user'>&#xf007; fa-user</option>
                                                                                <option value='fa-user-circle'>&#xf2bd; fa-user-circle</option>
                                                                                <option value='fa-user-circle-o'>&#xf2be; fa-user-circle-o</option>
                                                                                <option value='fa-user-md'>&#xf0f0; fa-user-md</option>
                                                                                <option value='fa-user-o'>&#xf2c0; fa-user-o</option>
                                                                                <option value='fa-user-plus'>&#xf234; fa-user-plus</option>
                                                                                <option value='fa-user-secret'>&#xf21b; fa-user-secret</option>
                                                                                <option value='fa-user-times'>&#xf235; fa-user-times</option>
                                                                                <option value='fa-users'>&#xf0c0; fa-users</option>
                                                                                <option value='fa-vcard'>&#xf2bb; fa-vcard</option>
                                                                                <option value='fa-vcard-o'>&#xf2bc; fa-vcard-o</option>
                                                                                <option value='fa-venus'>&#xf221; fa-venus</option>
                                                                                <option value='fa-venus-double'>&#xf226; fa-venus-double</option>
                                                                                <option value='fa-venus-mars'>&#xf228; fa-venus-mars</option>
                                                                                <option value='fa-viacoin'>&#xf237; fa-viacoin</option>
                                                                                <option value='fa-viadeo'>&#xf2a9; fa-viadeo</option>
                                                                                <option value='fa-viadeo-square'>&#xf2aa; fa-viadeo-square</option>
                                                                                <option value='fa-video-camera'>&#xf03d; fa-video-camera</option>
                                                                                <option value='fa-vimeo'>&#xf27d; fa-vimeo</option>
                                                                                <option value='fa-vimeo-square'>&#xf194; fa-vimeo-square</option>
                                                                                <option value='fa-vine'>&#xf1ca; fa-vine</option>
                                                                                <option value='fa-vk'>&#xf189; fa-vk</option>
                                                                                <option value='fa-volume-control-phone'>&#xf2a0; fa-volume-control-phone</option>
                                                                                <option value='fa-volume-down'>&#xf027; fa-volume-down</option>
                                                                                <option value='fa-volume-off'>&#xf026; fa-volume-off</option>
                                                                                <option value='fa-volume-up'>&#xf028; fa-volume-up</option>
                                                                                <option value='fa-warning'>&#xf071; fa-warning</option>
                                                                                <option value='fa-wechat'>&#xf1d7; fa-wechat</option>
                                                                                <option value='fa-weibo'>&#xf18a; fa-weibo</option>
                                                                                <option value='fa-weixin'>&#xf1d7; fa-weixin</option>
                                                                                <option value='fa-whatsapp'>&#xf232; fa-whatsapp</option>
                                                                                <option value='fa-wheelchair'>&#xf193; fa-wheelchair</option>
                                                                                <option value='fa-wheelchair-alt'>&#xf29b; fa-wheelchair-alt</option>
                                                                                <option value='fa-wifi'>&#xf1eb; fa-wifi</option>
                                                                                <option value='fa-wikipedia-w'>&#xf266; fa-wikipedia-w</option>
                                                                                <option value='fa-window-close'>&#xf2d3; fa-window-close</option>
                                                                                <option value='fa-window-close-o'>&#xf2d4; fa-window-close-o</option>
                                                                                <option value='fa-window-maximize'>&#xf2d0; fa-window-maximize</option>
                                                                                <option value='fa-window-minimize'>&#xf2d1; fa-window-minimize</option>
                                                                                <option value='fa-window-restore'>&#xf2d2; fa-window-restore</option>
                                                                                <option value='fa-windows'>&#xf17a; fa-windows</option>
                                                                                <option value='fa-won'>&#xf159; fa-won</option>
                                                                                <option value='fa-wordpress'>&#xf19a; fa-wordpress</option>
                                                                                <option value='fa-wpbeginner'>&#xf297; fa-wpbeginner</option>
                                                                                <option value='fa-wpexplorer'>&#xf2de; fa-wpexplorer</option>
                                                                                <option value='fa-wpforms'>&#xf298; fa-wpforms</option>
                                                                                <option value='fa-wrench'>&#xf0ad; fa-wrench</option>
                                                                                <option value='fa-xing'>&#xf168; fa-xing</option>
                                                                                <option value='fa-xing-square'>&#xf169; fa-xing-square</option>
                                                                                <option value='fa-y-combinator'>&#xf23b; fa-y-combinator</option>
                                                                                <option value='fa-y-combinator-square'>&#xf1d4; fa-y-combinator-square</option>
                                                                                <option value='fa-yahoo'>&#xf19e; fa-yahoo</option>
                                                                                <option value='fa-yc'>&#xf23b; fa-yc</option>
                                                                                <option value='fa-yc-square'>&#xf1d4; fa-yc-square</option>
                                                                                <option value='fa-yelp'>&#xf1e9; fa-yelp</option>
                                                                                <option value='fa-yen'>&#xf157; fa-yen</option>
                                                                                <option value='fa-yoast'>&#xf2b1; fa-yoast</option>
                                                                                <option value='fa-youtube'>&#xf167; fa-youtube</option>
                                                                                <option value='fa-youtube-play'>&#xf16a; fa-youtube-play</option>
                                                                                <option value='fa-youtube-square'>&#xf166; fa-youtube-square</option>
                                                                            </select>
                                                                            <script>
                                                                                $("#sel-ikon").change(function(){
                                                                                    $('#pre-ikon').removeClass();
                                                                                    $('#pre-ikon').addClass('fa '+$(this).val());
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                    </div>

                                                                    <div class="space-4"></div>

                                                                    <div class="form-group">
                                                                        <label for="form-field-nama">Nama Kategori</label>

                                                                        <div>
                                                                            <input name="nama_kategori" type="text" id="form-field-nama" required/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button class="btn btn-sm" data-dismiss="modal">
                                                                <i class="ace-icon fa fa-times"></i>
                                                                Cancel
                                                            </button>

                                                            <button type="submit" class="btn btn-sm btn-primary">
                                                                <i class="ace-icon fa fa-check"></i>
                                                                Save
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- PAGE CONTENT ENDS -->
									</div>
                                </div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
                                
		<!-- page specific plugin scripts -->
		<script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
		<script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
		<script src="{{ asset('assets/js/spinbox.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-timepicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/moment.min.js') }}"></script>
		<script src="{{ asset('assets/js/daterangepicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-colorpicker.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.knob.min.js') }}"></script>
		<script src="{{ asset('assets/js/autosize.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.inputlimiter.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.maskedinput.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootstrap-tag.min.js') }}"></script>

        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script>
		<script src="{{ asset('assets/js/buttons.flash.min.js') }}"></script>
		<script src="{{ asset('assets/js/buttons.html5.min.js') }}"></script>
		<script src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
		<script src="{{ asset('assets/js/buttons.colVis.min.js') }}"></script>
		<script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
					
			
					select: {
						style: 'multi'
					}
			    } );
			
				
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				
				
				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
			
			})
        </script>		
        
        
		<script type="text/javascript">
			jQuery(function($) {
				$('#id-disable-check').on('click', function() {
					var inp = $('#form-input-readonly').get(0);
					if(inp.hasAttribute('disabled')) {
						inp.setAttribute('readonly' , 'true');
						inp.removeAttribute('disabled');
						inp.value="This text field is readonly!";
					}
					else {
						inp.setAttribute('disabled' , 'disabled');
						inp.removeAttribute('readonly');
						inp.value="This text field is disabled!";
					}
				});
			
			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
			
			
					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}
			
			
				$('[data-rel=tooltip]').tooltip({container:'body'});
				$('[data-rel=popover]').popover({container:'body'});
			
				autosize($('textarea[class*=autosize]'));
				
				$('textarea.limited').inputlimiter({
					remText: '%n character%s remaining...',
					limitText: 'max allowed : %n.'
				});
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
				$( "#input-size-slider" ).css('width','200px').slider({
					value:1,
					range: "min",
					min: 1,
					max: 8,
					step: 1,
					slide: function( event, ui ) {
						var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
						var val = parseInt(ui.value);
						$('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.'+sizing[val]);
					}
				});
			
				$( "#input-span-slider" ).slider({
					value:1,
					range: "min",
					min: 1,
					max: 12,
					step: 1,
					slide: function( event, ui ) {
						var val = parseInt(ui.value);
						$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
					}
				});
			
			
				
				//"jQuery UI Slider"
				//range slider tooltip example
				$( "#slider-range" ).css('height','200px').slider({
					orientation: "vertical",
					range: true,
					min: 0,
					max: 100,
					values: [ 17, 67 ],
					slide: function( event, ui ) {
						var val = ui.values[$(ui.handle).index()-1] + "";
			
						if( !ui.handle.firstChild ) {
							$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
							.prependTo(ui.handle);
						}
						$(ui.handle.firstChild).show().children().eq(1).text(val);
					}
				}).find('span.ui-slider-handle').on('blur', function(){
					$(this.firstChild).hide();
				});
				
				
				$( "#slider-range-max" ).slider({
					range: "max",
					min: 1,
					max: 10,
					value: 2
				});
				
				$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
					// read initial values from markup and remove that
					var value = parseInt( $( this ).text(), 10 );
					$( this ).empty().slider({
						value: value,
						range: "min",
						animate: true
						
					});
				});
				
				$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
			
				
				$('#id-input-file-1 , #id-input-file-2').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
			
			
				$('#id-input-file-3').ace_file_input({
					style: 'well',
					btn_choose: 'Drop files here or click to choose',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
				
				
			
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Drop files here or click to choose";
						no_icon = "ace-icon fa fa-cloud-upload";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
					
					
					/**
					file_input
					.off('file.preview.ace')
					.on('file.preview.ace', function(e, info) {
						console.log(info.file.width);
						console.log(info.file.height);
						e.preventDefault();//to prevent preview
					});
					*/
				
				});
			
				$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//console.log($('#spinner1').val())
				}); 
				$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
				$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
			
				//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
				//or
				//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
				//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
			
			
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				//or change it into a date range picker
				$('.input-daterange').datepicker({autoclose:true});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false,
					disableFocus: true,
					icons: {
						up: 'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				}).on('focus', function() {
					$('#timepicker1').timepicker('showWidget');
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				
			
				
				if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
				 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
				 icons: {
					time: 'fa fa-clock-o',
					date: 'fa fa-calendar',
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down',
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'fa fa-arrows ',
					clear: 'fa fa-trash',
					close: 'fa fa-times'
				 }
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
			
				$('#colorpicker1').colorpicker();
				//$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe
			
				$('#simple-colorpicker-1').ace_colorpicker();
				//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
				//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
				//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
				//picker.pick('red', true);//insert the color if it doesn't exist
			
			
				$(".knob").knob();
				
				
				var tag_input = $('#form-field-tags');
				try{
					tag_input.tag(
					  {
						placeholder:tag_input.attr('placeholder'),
						//enable typeahead by specifying the source array
						source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
						/**
						//or fetch data from database, fetch those that match "query"
						source: function(query, process) {
						  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
						  .done(function(result_items){
							process(result_items);
						  });
						}
						*/
					  }
					)
			
					//programmatically add/remove a tag
					var $tag_obj = $('#form-field-tags').data('tag');
					$tag_obj.add('Programmatically Added');
					
					var index = $tag_obj.inValues('some tag');
					$tag_obj.remove(index);
				}
				catch(e) {
					//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
					tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
					//autosize($('#form-field-tags'));
				}
				
				
				/////////
				$('#modal-tambah-jenis input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})
				
				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-tambah-jenis').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
			
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					autosize.destroy('textarea[class*=autosize]')
					
					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});
			
			});
		</script>
@endsection