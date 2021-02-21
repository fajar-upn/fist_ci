<!-- javascript untuk fullcalendar -->
<script src="<?php echo base_url() ?>includes/assets/extra-libs/taskboard/js/jquery.ui.touch-punch-improved.js"></script>
<script src="<?php echo base_url() ?>includes/assets/extra-libs/taskboard/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/fullcalendar/dist/locale/id.js"></script>
<!-- javascript untuk bootstrap-datepicker -->
<script src="<?php echo base_url() ?>includes/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>includes/assets/libs/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>
<!-- javascript untuk bootstrap-clockpicker -->
<script src="<?php echo base_url() ?>includes/assets/libs/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
<!-- javascript untuk select2 -->
<script src="<?php echo base_url() ?>includes/assets/libs/select2/dist/js/select2.min.js"></script>

<!-- javascript untuk halaman menu penjadwalan konsultasi -->
<script type="text/javascript">
	! function($) {
		"use strict";

		var CalendarApp = function() {
			this.$body = $("body")
			this.$calendar = $('#calendar'),
			this.$event = ('#calendar-events div.calendar-events'),
			this.$extEvents = $('#calendar-events'),
			this.$modal = $('#my-event'),
			this.$selectMentor = $('#select-mentor'),
			this.$selectedMentorId = "",
			this.$currentMentor = null,
			this.$consultClasses = null,
			this.$calendarObj = null
		};
		/* on drop, masih belum dipake, enabling di CalendarApp.prototype.init()*/
		CalendarApp.prototype.onDrop = function(eventObj, date) {
			var $this = this;
			// retrieve the dropped element's stored Event Object
			var originalEventObject = eventObj.data('eventObject');
			var $categoryClass = eventObj.attr('data-class');
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			// assign it the date that was reported
			copiedEventObject.start = date;
			if ($categoryClass)
				copiedEventObject['className'] = [$categoryClass];
			// render the event on the calendar
			$this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				eventObj.remove();
			}
		},

		CalendarApp.prototype.onEventDrop = function(calEvent) {
			var $this = this;
			var new_date = $.fullCalendar.formatDate(calEvent.start, "YYYY-MM-DD");
			var new_time_start = $.fullCalendar.formatDate(calEvent.start, "HH:mm");
			var new_time_finish = $.fullCalendar.formatDate(calEvent.end, "HH:mm");
			console.log(new_date);
			console.log(new_time_start);
			console.log(new_time_finish);
			console.log(calEvent.schedule_id);
			console.log(calEvent.class_id);
			$.ajax({
				url: "<?php echo base_url() ?>consult_schedule/save_data",
				type: "POST",
				data: {
					schedule_id: calEvent.schedule_id,
					class_id: calEvent.class_id,
					event_date: new_date,
					event_time_start: new_time_start,
					event_time_finish: new_time_finish
				},
				success: function() {
					$this.$calendarObj.fullCalendar('refetchEvents');
					//fetching data for html table consultation class
					$.ajax({
						url: '<?php echo base_url() ?>consult_schedule/fetch_classes',
						type: 'POST',
						data: {
							mentor_id: $this.$selectedMentorId
						},
						dataType: 'json',
						async: false,
						success: function(data) {
							$this.$consultClasses = data;
						},
						error: function() {
							alert('Gagal Mengambil Data Kelas!');
						}
					});
					$('#list-class').find('tr').remove();
					var no=1;
					$.each($this.$consultClasses, function(key, value) {
						if (value.contract_end != true && value.contract_cancel != true) {
							var totalSchedule = (!value.total_schedule) ? 0 : value.total_schedule;
							var totalAddSession = (!value.total_add_session) ? 0 : value.total_add_session;
							$('#list-class').append("<tr><td>" + '(' + value.client_code + ') ' + value.client_name + "</td><td>" + value.package_name + "</td><td>" + (parseInt(value.total_sesion)+parseInt(totalAddSession)) + "</td><td>" + totalSchedule + "</td></tr>");
							no++;
						}
					});
				},
				error: function() {
					alert('Gagal Mengubah Jadwal!');
				}
			});
		},

		/* on click on event */
		CalendarApp.prototype.onEventClick = function(calEvent, jsEvent, view) {
			var $this = this;
			var current_date = $.fullCalendar.formatDate(calEvent.start, "YYYY-MM-DD");
			var current_time_start = $.fullCalendar.formatDate(calEvent.start, "HH:mm");
			var current_time_finish = $.fullCalendar.formatDate(calEvent.end, "HH:mm");
			var modalTitle = "Ubah Jadwal " + $this.$currentMentor.uprof_full_name;

			$this.$modal.modal({
				backdrop: 'static'
			});
			
			// setup form in model saat ingin update data
			var form = $("<form></form>");
			form.append("<div class='row'></div>");
			form.find(".row")
			.append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Mahasiswa</label><select class='form-control' name='mahasiswa'></select></div></div>");
			form.find("select[name='mahasiswa']")
			.append("<option value='0' disabled>Pilih Mahasiswa...</option>");
			$.each($this.$consultClasses, function(key, value) {
				if (value.mentor_id == $this.$selectedMentorId && value.contract_end != true && value.contract_cancel != true) {
					if (value.class_id == calEvent.class_id) {
						form.find("select[name='mahasiswa']")
						.append("<option value='" + value.class_id + "' selected>" + value.client_code + ' - ' + value.client_name +"</option");
					}
					else {
						form.find("select[name='mahasiswa']")
						.append("<option value='" + value.class_id + "'>" + value.client_code + ' - ' + value.client_name +"</option");
					}
				}
			});
			form.find(".row")
			.append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Tanggal</label><div class='input-group'><input type='text' class='form-control' id='datepicker-autoclose' placeholder='tttt-bb-hh' name='tanggal'></div></div></div>");

			form.find("input[name='tanggal']").val(current_date);
			form.find("#datepicker-autoclose").datepicker({
				language: 'id',
				format: 'yyyy-mm-dd',
				immediateUpdates: true,
				autoclose: true,
				todayHighlight: true
			});
			form.find(".row")
			.append("<div class='col-md-3'><div class='form-group'><label class='control-label'>Jam Mulai</label><div class='input-group clockpicker' data-autoclose='true'><input type='text' class='form-control' placeholder='jj:mm' name='jam-mulai'></div></div></div>")
			.append("<div class='col-md-3'><div class='form-group'><label class='control-label'>Jam Selesai</label><div class='input-group clockpicker' data-autoclose='true'><input type='text' class='form-control' placeholder='jj:mm' name='jam-selesai'></div></div></div>");
			form.find(".clockpicker").clockpicker();

			form.find("input[name='jam-mulai']").val(current_time_start);
			form.find("input[name='jam-selesai']").val(current_time_finish);

			$this.$modal.find('.modal-title').text(modalTitle).end().find('.delete-event').show().end().find('.save-event').show().end().find('.modal-body ').empty().prepend(form).end().find('.save-event').unbind('click').click(function() {
				form.submit();
			});

			$this.$modal.find('form').on('submit', function() {
				var idClass = form.find("select[name='mahasiswa'] option:checked").val();
				var eventDate = form.find("input[name='tanggal']").val();
				var eventTimeStart = form.find("input[name='jam-mulai']").val();
				var eventTimeFinish = form.find("input[name='jam-selesai']").val();

				if (eventDate.length != 0 && eventTimeStart.length != 0 && eventTimeFinish.length != 0 && idClass != 0) {
					if(eventTimeStart<eventTimeFinish) {
						//updating data
						$.ajax({
							url: "<?php echo base_url() ?>consult_schedule/save_data",
							type: "POST",
							data: {
								schedule_id: calEvent.schedule_id,
								class_id: idClass,
								event_date: eventDate,
								event_time_start: eventTimeStart,
								event_time_finish: eventTimeFinish
							},
							success: function() {
								$this.$calendarObj.fullCalendar('refetchEvents');
								//fetching data for html table consultation class
								$.ajax({
									url: '<?php echo base_url() ?>consult_schedule/fetch_classes',
									type: 'POST',
									data: {
										mentor_id: $this.$selectedMentorId
									},
									dataType: 'json',
									async: false,
									success: function(data) {
										$this.$consultClasses = data;
									},
									error: function() {
										alert('Gagal Mengambil Data Kelas!');
									}
								});
								$('#list-class').find('tr').remove();
								var no=1;
								$.each($this.$consultClasses, function(key, value) {
									if (value.contract_end != true && value.contract_cancel != true) {
										var totalSchedule = (!value.total_schedule) ? 0 : value.total_schedule;
										var totalAddSession = (!value.total_add_session) ? 0 : value.total_add_session;
										$('#list-class').append("<tr><td>" + '(' + value.client_code + ') ' + value.client_name + "</td><td>" + value.package_name + "</td><td>" + (parseInt(value.total_sesion)+parseInt(totalAddSession)) + "</td><td>" + totalSchedule + "</td></tr>");
										no++;
									}
								});
							},
							error: function() {
								alert('Gagal Mengubah Jadwal!');
							}
						});
						$this.$modal.modal('hide');
					}
					else {
						alert('Jam mulai harus lebih dahulu dari jam selesai!');
					}
				}
				else {
					alert('Terdapat form yang belum terisi!');
				}
				return false;
			});

			$this.$modal.find('.delete-event').unbind('click').click(function(){
				$this.$modal.modal('hide');
				var okHapus = confirm("Yakin hapus?");
				if (okHapus) {
					//deleting data
					$.ajax({
						url: "<?php echo base_url() ?>consult_schedule/delete",
						type: "POST",
						data: {
							schedule_id: calEvent.schedule_id,
						},
						success: function() {
							$this.$calendarObj.fullCalendar('refetchEvents');
							$.ajax({
								url: '<?php echo base_url() ?>consult_schedule/fetch_classes',
								type: 'POST',
								data: {
									mentor_id: $this.$selectedMentorId
								},
								dataType: 'json',
								async: false,
								success: function(data) {
									$this.$consultClasses = data;
								},
								error: function() {
									alert('Gagal Mengambil Data Kelas!');
								}
							});
							$('#list-class').find('tr').remove();
							var no=1;
							$.each($this.$consultClasses, function(key, value) {
								if (value.contract_end != true && value.contract_cancel != true) {
									var totalSchedule = (!value.total_schedule) ? 0 : value.total_schedule;
									var totalAddSession = (!value.total_add_session) ? 0 : value.total_add_session;
									$('#list-class').append("<tr><td>" + '(' + value.client_code + ') ' + value.client_name + "</td><td>" + value.package_name + "</td><td>" + (parseInt(value.total_sesion)+parseInt(totalAddSession)) + "</td><td>" + totalSchedule + "</td></tr>");
									no++;
								}
							});
							alert('Jadwal Berhasil Dihapus!');
						},
						error: function() {
							alert('Gagal Menghapus Jadwal!');
						}
					});
				}
				else {
					alert("Hapus jadwal dibatalkan :D")
				}
			});
		},
		/* on select on cell*/
		CalendarApp.prototype.onSelect = function(start, end, allDay) {
			var $this = this;

			var modalTitle = "Tambah Jadwal " + $this.$currentMentor.uprof_full_name;
			var current_date = $.fullCalendar.formatDate(start, "YYYY-MM-DD");

			$this.$modal.modal({
				backdrop: 'static'
			});
			
			var form = $("<form></form>");
			form.append("<div class='row'></div>");

			form.find(".row")
			.append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Mahasiswa</label><select class='form-control' name='mahasiswa'></select></div></div>");

			form.find("select[name='mahasiswa']")
			.append("<option value='0' disabled selected>Pilih Mahasiswa...</option>");

			$.each($this.$consultClasses, function(key, value) {
				if (value.mentor_id == $this.$selectedMentorId && value.contract_end != true && value.contract_cancel != true) {
					form.find("select[name='mahasiswa']")
					.append("<option value='" + value.class_id + "'>" + value.client_code + ' - ' + value.client_name +"</option");
				}
			});

			form.find(".row")
			.append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Tanggal</label><div class='input-group'><input type='text' class='form-control' id='datepicker-autoclose' placeholder='tttt-bb-hh' name='tanggal'></div></div></div>");
			form.find("input[name='tanggal']").val(current_date);
			form.find("#datepicker-autoclose").datepicker({
				language: 'id',
				format: 'yyyy-mm-dd',
				immediateUpdates: true,
				autoclose: true,
				todayHighlight: true
			});

			form.find(".row")
			.append("<div class='col-md-3'><div class='form-group'><label class='control-label'>Jam Mulai</label><div class='input-group clockpicker' data-autoclose='true'><input type='text' class='form-control' placeholder='jj:mm' name='jam-mulai'></div></div></div>")
			.append("<div class='col-md-3'><div class='form-group'><label class='control-label'>Jam Selesai</label><div class='input-group clockpicker' data-autoclose='true'><input type='text' class='form-control' placeholder='jj:mm' name='jam-selesai'></div></div></div>");

			form.find(".clockpicker").clockpicker();			

			$this.$modal.find('.modal-title').text(modalTitle).end().find('.delete-event').hide().end().find('.save-event').show().end().find('.modal-body ').empty().prepend(form).end().find('.save-event').unbind('click').click(function() {
				form.submit();
			});

			$this.$modal.find('form').on('submit', function() {
				var idClass = form.find("select[name='mahasiswa'] option:checked").val();
				var eventDate = form.find("input[name='tanggal']").val();
				var eventTimeStart = form.find("input[name='jam-mulai']").val();
				var eventTimeFinish = form.find("input[name='jam-selesai']").val();
				console.log(idClass);
				if (eventDate.length != 0 && eventTimeStart.length != 0 && eventTimeFinish.length != 0 && idClass != 0) {
					if(eventTimeStart<eventTimeFinish) {
						//insert data
						$.ajax({
							url: "<?php echo base_url() ?>consult_schedule/save_data",
							type: "POST",
							data: {
								class_id: idClass,
								event_date: eventDate,
								event_time_start: eventTimeStart,
								event_time_finish: eventTimeFinish
							},
							success: function() {
								$this.$calendarObj.fullCalendar('refetchEvents');
								$.ajax({
									url: '<?php echo base_url() ?>consult_schedule/fetch_classes',
									type: 'POST',
									data: {
										mentor_id: $this.$selectedMentorId
									},
									dataType: 'json',
									async: false,
									success: function(data) {
										$this.$consultClasses = data;
									},
									error: function() {
										alert('Gagal Mengambil Data Kelas!');
									}
								});
								$('#list-class').find('tr').remove();
								var no=1;
								$.each($this.$consultClasses, function(key, value) {
									if (value.contract_end != true && value.contract_cancel != true) {
										var totalSchedule = (!value.total_schedule) ? 0 : value.total_schedule;
										var totalAddSession = (!value.total_add_session) ? 0 : value.total_add_session;
										$('#list-class').append("<tr><td>" + '(' + value.client_code + ') ' + value.client_name + "</td><td>" + value.package_name + "</td><td>" + (parseInt(value.total_sesion)+parseInt(totalAddSession)) + "</td><td>" + totalSchedule + "</td></tr>");
										no++;
									}
								});
							},
							error: function() {
								alert('Gagal Menambah Jadwal!');
							}
						});
						$this.$modal.modal('hide');
					}
					else {
						alert('Jam mulai harus lebih dahulu dari jam selesai!');
					}
				}
				else {
					alert('Terdapat form yang belum terisi!');
				}
				return false;
			});
			$this.$calendarObj.fullCalendar('unselect');
		},
		/*enabling drag on event, masih belum dipake, enabling fungsi ini di CalendarApp.prototype.init()*/
		CalendarApp.prototype.enableDrag = function() {
			//init events
			$(this.$event).each(function() {
				// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
				// it doesn't need to have a start or end
				var eventObject = {
					title: $.trim($(this).text()) // use the element's text as the event title
				};
				// store the Event Object in the DOM element so we can get to it later
				$(this).data('eventObject', eventObject);
				// make the event draggable using jQuery UI
				$(this).draggable({
					zIndex: 999,
					revert: true, // will cause the event to go back to its
					revertDuration: 0 //  original position after the drag
				});
			});
		}
		/* Initializing */
		CalendarApp.prototype.init = function() {
			this.enableDrag();
			/*  Initialize the calendar  */
			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();
			var form = '';
			var today = new Date($.now());

			var $this = this;
			$this.$calendarObj = $this.$calendar.fullCalendar({
				slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
				minTime: '08:00:00',
				maxTime: '18:00:00',
				defaultView: 'month',
				handleWindowResize: true,

				header: {
					left: 'prev,today,next',
					center: 'title',
					right: 'listMonth,month,agendaWeek,agendaDay'
				},
				drop: function(date) { $this.onDrop($(this), date); },
				select: function(start, end, allDay) { $this.onSelect(start, end, allDay); },
				eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); },
				eventDrop: function(calEvent) { $this.onEventDrop(calEvent); },
				loading: function (isLoading) {
					if (isLoading) {
						$('#cal-spinner').fadeIn();
						$('#list-class-spinner').fadeIn();
					}
					else {
						$('#content-spinner').fadeIn('slow', function() {
							$('#content-spinner').fadeOut('slow', function() {
								$('#cal-content').fadeIn('slow');
							});
						});
						$('#cal-spinner').fadeOut();
						$('#list-class-spinner').fadeOut();
					}
				}
			});

			this.$selectMentor.select2({
				placeholder: "Pilih nama mentor"
			});

			this.$selectMentor.on('change', function() {
				$this.$selectedMentorId = this.value;
				var mentor = $.parseJSON('<?php echo json_encode($mentor) ?>');
				$.each(mentor, function(key, value) {
					if (value.uacc_id == $this.$selectedMentorId) {
						$this.$currentMentor = value;
					}
				});

				$.ajax({
					url: '<?php echo base_url() ?>consult_schedule/fetch_classes',
					type: 'POST',
					data: {
						mentor_id: $this.$selectedMentorId
					},
					dataType: 'json',
					async: false,
					success: function(data) {
						$this.$consultClasses = data;
					},
					error: function() {
						alert('Gagal Mengambil Data Kelas!');
					}
				});
				
				$('#title-table-class').text('Kelas Berlangsung ' + $this.$currentMentor.uprof_full_name);
				$('#title-calendar').text('Jadwal Konsultasi ' + $this.$currentMentor.uprof_full_name);
				$('#list-class').find('tr').remove().end().append('<tr><td colspan="4" class="text-center" id="empty-row">Tidak Ada Kelas Berlangsung</td></tr>');
				var no=1;
				$.each($this.$consultClasses, function(key, value) {
					if (value.contract_end != true && value.contract_cancel != true) {
						$('#empty-row').hide();
						var totalSchedule = (!value.total_schedule) ? 0 : value.total_schedule;
						var totalAddSession = (!value.total_add_session) ? 0 : value.total_add_session;
						$('#list-class').append("<tr><td>" + '(' + value.client_code + ') ' + value.client_name + "</td><td>" + value.package_name + "</td><td>" + (parseInt(value.total_sesion)+parseInt(totalAddSession)) + "</td><td>" + totalSchedule + "</td></tr>");
						no++;
					}
				});
				$this.$calendarObj.fullCalendar('option', {
					editable: true,
					eventDurationEditable: false,
					droppable: false, // this allows things to be dropped onto the calendar !!!
					eventLimit: true, // allow "more" link when too many events
					selectable: true
				});
				$this.$calendarObj.fullCalendar('removeEventSources');
				$this.$calendarObj.fullCalendar('addEventSource', {
					url: '<?php echo base_url() ?>consult_schedule/fetch_schedules',
					type: 'POST',
					data: {
						mentor_id: $this.$selectedMentorId
					},
					error: function(jqXHR, textStatus, errorThrown) {
						if (textStatus == 'parsererror') {
							alert('Jadwal Konsultasi Untuk ' + $this.$currentMentor.uprof_full_name + ' Kosong');
						}
						else if (textStatus == 'error') {
							alert('Gagal Mengambil Data Jadwal!');
						}
						else if (textStatus == 'timeout') {
							alert('Request Timed Out!')
						}
					}
				});
				$('#cal-content').hide();
			});
		},
		//init CalendarApp
		$.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

	}(window.jQuery),

//initializing CalendarApp
$(window).on('load', function() {

	$.CalendarApp.init();
	// $('#cal-content').hide();
	$('#content-spinner').hide();
	$('#cal-spinner').hide();
	$('#list-class-spinner').hide();
});
</script>
