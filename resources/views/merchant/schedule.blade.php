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
								Booking Calendar
							</h1>
						</div>
						
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
		
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />

		<link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.min.css') }}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />

                                <div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->
										<div class="row">
											<div class="col-sm-3">
												<div class="widget-box transparent">
													<div class="widget-header">
														<h4>Jadwal Buka</h4>
													</div>

													<div class="widget-body">
														<div class="widget-main no-padding">
															<div id="external-events">
																<label>
																	<div id="in-datepicker"></div>
																</label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-9">
												<div class="space"></div>

												<div id="calendar"></div>
											</div>
										</div>

										<!-- PAGE CONTENT ENDS -->
									</div><!-- /.col -->
								</div><!-- /.row -->
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

		<!-- page specific plugin scripts -->
		<script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
		<script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
		<script src="{{ asset('assets/js/moment.min.js') }}"></script>

		<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>

		<script src="{{ asset('assets/js/fullcalendar.min.js') }}"></script>
		<script src="{{ asset('assets/js/bootbox.js') }}"></script>


		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$(document).ready(function() {
				


					$('#calendar').fullCalendar({
						//isRTL: true,
						// firstDay: 1,// >> change first day of week 
						defaultView: 'agendaDay',
						buttonHtml: {
							prev: '<i class="ace-icon fa fa-chevron-left"></i>',
							next: '<i class="ace-icon fa fa-chevron-right"></i>'
						},
					
						header: {
							left: 'prev,next today',
							center: 'title',
							right: 'agendaDay,agendaWeek,month'
						},
						events: [
						// {
						// 	title: 'All Day Event',
						// 	start: new Date(y, m, 1),
						// 	className: 'label-important'
						// },
						// {
						// 	title: 'Long Event',
						// 	start: moment().subtract(5, 'days').format('YYYY-MM-DD'),
						// 	end: moment().subtract(1, 'days').format('YYYY-MM-DD'),
						// 	className: 'label-success'
						// },
						// {
						// 	title: 'Some Event',
						// 	start: new Date(y, m, d-3, 16, 0),
						// 	allDay: false,
						// 	className: 'label-info'
						// }
						]
						,
						
						/**eventResize: function(event, delta, revertFunc) {

							alert(event.title + " end is now " + event.end.format());

							if (!confirm("is this okay?")) {
								revertFunc();
							}

						},*/
						
						editable: true,
						droppable: true, // this allows things to be dropped onto the calendar !!!
						drop: function(date) { // this function is called when something is dropped
						
							// retrieve the dropped element's stored Event Object
							var originalEventObject = $(this).data('eventObject');
							var $extraEventClass = $(this).attr('data-class');
							
							
							// we need to copy it, so that multiple events don't have a reference to the same object
							var copiedEventObject = $.extend({}, originalEventObject);
							
							// assign it the date that was reported
							copiedEventObject.start = date;
							copiedEventObject.allDay = false;
							if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
							
							// render the event on the calendar
							// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
							$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
							
							// is the "remove after drop" checkbox checked?
							if ($('#drop-remove').is(':checked')) {
								// if so, remove the element from the "Draggable Events" list
								$(this).remove();
							}
							
						}
						,
						selectable: true,
						selectHelper: true,
						select: function(start, end, allDay) {
							
							bootbox.prompt("New Event Title:", function(title) {
								if (title !== null) {
									calendar.fullCalendar('renderEvent',
										{
											title: title,
											start: start,
											end: end,
											allDay: allDay,
											className: 'label-info'
										},
										true // make the event "stick"
									);
								}
							});
							

							calendar.fullCalendar('unselect');
						}
						,
						eventClick: function(calEvent, jsEvent, view) {

							//display a modal
							var modal = 
							'<div class="modal fade">\
							<div class="modal-dialog">\
							<div class="modal-content">\
								<div class="modal-body">\
								<button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
								<form class="no-margin">\
									<label>Change event name &nbsp;</label>\
									<input class="middle" autocomplete="off" type="text" value="' + calEvent.title + '" />\
									<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Save</button>\
								</form>\
								</div>\
								<div class="modal-footer">\
									<button type="button" class="btn btn-sm btn-danger" data-action="delete"><i class="ace-icon fa fa-trash-o"></i> Delete Event</button>\
									<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
								</div>\
							</div>\
							</div>\
							</div>';
						
						
							var modal = $(modal).appendTo('body');
							modal.find('form').on('submit', function(ev){
								ev.preventDefault();

								calEvent.title = $(this).find("input[type=text]").val();
								calendar.fullCalendar('updateEvent', calEvent);
								modal.modal("hide");
							});
							modal.find('button[data-action=delete]').on('click', function() {
								calendar.fullCalendar('removeEvents' , function(ev){
									return (ev._id == calEvent._id);
								})
								modal.modal("hide");
							});
							
							modal.modal('show').on('hidden', function(){
								modal.remove();
							});


							//console.log(calEvent.id);
							//console.log(jsEvent);
							//console.log(view);

							// change the border color just for fun
							//$(this).css('border-color', 'red');

						}
						
					});

					$('#in-datepicker').datepicker({
						inline: true,
						todayHighlight: true,
					}).on("changeDate", function (e) {
						var d = new Date(e.date);
						$('#calendar').fullCalendar('gotoDate', d);
					}); 
				})
		</script>
@endsection