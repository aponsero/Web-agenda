<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,basicDay'
			},
			defaultView: 'agendaWeek', 
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
		
			
			//translation of the month and day names in French
			monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet','Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
			monthNamesShort: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin','Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Dec'],
			dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi','Jeudi', 'Vendredi', 'Samedi'],
			dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
			
			//translation of the buttons
			buttonText:{
					today:    "aujourd'hui",
					month:    'mois',
					week:     'semaine',
					day:      'jour',
					list:     'liste'
			},
			
			//format
			columnFormat:'ddd',     // like 'Mon', for month view
			axisFormat: 'H:mm',		//display 24h time format
			

			
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					if(event.color!="#000"){
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');}
					else{
					$('#ModalAccept #title').val(event.title);
					$('#ModalAccept #start').val(event.start.format('YYYY-MM-DD HH:mm:ss'));
					$('#ModalAccept #end').val(event.end.format('YYYY-MM-DD HH:mm:ss'));
					$('#ModalAccept').modal('show');
						
					}
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php foreach($events as $event): 
			
				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}
			?>
				{
					id: '<?php echo $event['id']; ?>',
					title: '<?php echo $event['title']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
				},
			<?php endforeach; ?>
			],
			
		});
		
		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: '../../../../includes/espaceAdmin/agenda/editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Enregistrement');
					}else{
						alert('Evènement non sauvé, veuillez réessayer.'); 
					}
				}
			});
		}
		
	});

</script>