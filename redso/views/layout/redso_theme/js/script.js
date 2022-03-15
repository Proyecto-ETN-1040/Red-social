$(function(){

	// AJAX de Formularios (Agregar)
	$('form.form-datos').validator().on('submit', function(e){
		$('button[type="submit"]').prop('disabled', true);
		var $this = $(this);
		
		if ( $this.data('requestRunning') ) {
			return;
		}

		if (e.isDefaultPrevented()) {
			// Form Invalido
			showNotification('warning', 'Datos Incompletos, revise los campos obligatorios (*)');
			$('button[type="submit"]').prop('disabled', false);
		} else {
			// Form Valido
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: $(this).serializeArray(),
				success: function(data) {
					$('button[type="submit"]').prop('disabled', true);
					if (data.res == 'ok') {
						// agregado exitoso
						$this.clearForm(); 
						if (data.vaciar_html) {
							$(data.vaciar_html).html('');
						}

						if (data.cerrar_modal) {
							$(data.cerrar_modal).modal('hide');
						}

						showNotification('success', 'Datos Correctos, Se guardó el registro satisfactoriamente');
					} else if(data.res == 'ok_listar') {
						window.location.href = data.listar;
					} else if(data.res == 'ok_listarmc') {
						$(".com-"+data.id).html(data.com);
						$("#mod-comentario").modal("hide");
						showNotification('success', 'Datos Correctos, Se guardó el registro satisfactoriamente');
					} else if(data.res == 'ok_listarc') {
						
						//document.location.reload(); //alert("");
						//$("#btnc"+data.id).click();
						window.location.href = data.listar;
						//mostrar('comentarios',data.id); 
					} else if(data.res == 'ok_like') { //alert(data.tip+"-"+data.id);
						var nul = parseInt($("#nul"+data.id).html());
						if(data.tip==0){
							$("#like"+data.id).addClass("ops");
							$("#tipo"+data.id).val(data.idn);
							$("#nul"+data.id).html(nul+1);
						}else{
							$("#like"+data.id).removeClass("ops");
							$("#tipo"+data.id).val("0");
							$("#nul"+data.id).html(nul-1);
						}
					} else if(data.res == 'error') {
						// error
						showNotification('danger', 'Datos Erroneos, No se guardó el registro satisfactoriamente');
					}
					$('button[type="submit"]').prop('disabled', false);
				},
				complete: function(){
					$('button[type="submit"]').prop('disabled', false);
				}
			});
			return 0;
		}
	}); // Fin de AJAX (Agregar)
	
	$("form.form-datos1").submit(function (event){ 
		event.preventDefault(); 
		var formData = new FormData($(this)[0]);
		var con = $("#con").val(); 
		$.ajax({
			url:$(this).attr('action'),
			type:'POST',
			data:formData,
			cache:false,
			contentType:false,
			processData:false,
			success: function(data){ //alert(data.listar);
				window.location.href = data.listar;
				/*if(respuesta==true){
					$("#ventana").modal("hide");
					document.location.href="<?=base_url()?>"+con+"";
				}else{
					var error=JSON.parse(respuesta);
					console.log(error);
					$('#mensaje').html("<strong>Error! </strong>"+error);
					$("#mensaje").addClass("alert alert-danger");
				}*/
			}
		});
	});
	
	$('form.form-cambiar-clave').validator().on('submit', function(e){
		$('button[type="submit"]').prop('disabled', true);
		var $this = $(this);
		
		if ( $this.data('requestRunning') ) {
			return;
		}

		if (e.isDefaultPrevented()) {
			// Form Invalido
			showNotification('danger', 'Datos Incompletos o Erróneos');
			$('button[type="submit"]').prop('disabled', false);
		} else {

			e.preventDefault();
			
			/*if ( $('[name="anterior_contrasena"]').val() != $('[name="contrasena"]').val() ) {
				showNotification('danger', 'Ingrese su contraseña actual, para poder cambiar la misma');
				$('button[type="submit"]').prop('disabled', false);
				return;
			}*/
			
			if ( $('[name="nueva_contrasena"]').val() != $('[name="nueva_contrasena_confirmar"]').val() ) {
				showNotification('danger', 'La confirmacion de contraseña no coincide');
				$('button[type="submit"]').prop('disabled', false);
				return;
			}

			// Form Valido
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: $(this).serializeArray(),
				success: function(data) {
					$('button[type="submit"]').prop('disabled', true);
					if (data.res == 'ok') {
						// agregado exitoso
						$this.clearForm(); 
						showNotification('success', 'Datos Correctos, Se guardó el registro satisfactoriamente');
						
					} else if(data.res == 'error') {
						// error
						showNotification('danger', 'Error, Datos Incorrectos');
					}
					$('button[type="submit"]').prop('disabled', false);
				},
				complete: function(){
					$('button[type="submit"]').prop('disabled', false);
				}
			});
			return 0;
		}
	});

	$('form.form-login').validator().on('submit', function(e){
		$('button[type="submit"]').prop('disabled', true);
		var $this = $(this);
		
		if ( $this.data('requestRunning') ) {
			return;
		}

		if (e.isDefaultPrevented()) {
			// Form Invalido
			showNotification('danger', 'Datos Incompletos 1');
			$('button[type="submit"]').prop('disabled', false);
		} else {
			// Form Valido
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: $(this).serializeArray(),
				success: function(data) {
					$('button[type="submit"]').prop('disabled', true);
					if (data.res == 'ok') {
						// agregado exitoso
						$this.clearForm(); 
						// showNotification('success', 'Datos Correctos, Se guardó el registro satisfactoriamente');
						window.location.href = data.redirect;
					} else if(data.res == 'error') {
						// error
						showNotification('danger', 'Error, Datos Incorrectos');
					}
					$('button[type="submit"]').prop('disabled', false);
				},
				complete: function(){
					$('button[type="submit"]').prop('disabled', false);
				}
			});
			return 0;
		}
	});

	$('form.form-registro-login').validator().on('submit', function(e){
		$('button[type="submit"]').prop('disabled', true);
		var $this = $(this);
		
		if ( $this.data('requestRunning') ) {
			return;
		}

		if (e.isDefaultPrevented()) {
			// Form Invalido
			showNotification('danger', 'Datos Incompletos o Erróneos');
			$('button[type="submit"]').prop('disabled', false);
		} else {

			e.preventDefault();

			if ( $('[name="registro_contrasena"]').val() != $('[name="registro_repetir_contrasena"]').val() ) {
				showNotification('danger', 'La confirmacion de contraseña no coincide');
				$('button[type="submit"]').prop('disabled', false);
				return;
			}

			// Form Valido
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: $(this).serializeArray(),
				success: function(data) {
					$('button[type="submit"]').prop('disabled', true);
					if (data.res == 'ok') {
						// agregado exitoso
						$this.clearForm(); 
						showNotification('success', 'Datos Correctos, Se guardó el registro satisfactoriamente');
						
					} else if(data.res == 'error') {
						// error
						showNotification('danger', 'Error, Datos Incorrectos');
					}
					$('button[type="submit"]').prop('disabled', false);
				},
				complete: function(){
					$('button[type="submit"]').prop('disabled', false);
				}
			});
			return 0;
		}
	});

	$('table#tabla-habilitados tbody').on('click', 'button.btn-habilitar', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$('[name="usuario_id"]').val(id);
		$.ajax({
			url: $('table#tabla-habilitados').data('get-usuario') + '/' + id,
			type: 'get',
			success: function ( data ) {
				if ( data ) {
					$('div#datos-personales').html('' +
						'<p><strong>Nombre Completo: </strong>'+ data.usu_nombre + ' ' + data.usu_apellido +'</p>' +
						'<p><strong>Correo Electrónico: </strong>'+ data.usu_email +'</p>'
					);
				}
			}
		});
		$('div#modal-habilitar-usuario').css('display', 'block');
	});

	// Acción de Eliminar Items
	$('table.tabla-datos tbody').on('click', '.borrar-item', function(){
		var fila = $(this).parents('tr');
		var url = $('table.tabla-datos').data('remove');
		var item = $(this).data('item');
		var datos = {
			"id"    : $(this).data('id')
		};
		$.confirm({
			icon: 'fa fa-question',
			title: 'Borrar',
			content: 'Esta seguro de borrar el registro de <b>' + item + '</b>',
			theme: 'modern',
			closeIcon: true,
			animation: 'scale',
			type: 'red',
			draggable: false,
			buttons: {
				remove: {
					text: 'Borrar',
					btnClass: 'btn-danger',
					action: function() {
						$.ajax({
							url: url,
							type: 'post',
							data: datos,
							success: function (data) { //alert(data.res);
								if (data.res == 'ok') {
									if(data.drive==1){
										showNotification('success', 'Operación exitosa, Se vaciaron los archivos satisfactoriamente');
									}else{
										fila.remove();
										showNotification('success', 'Operación exitosa, Se borró el registro satisfactoriamente');
									}
								} else {
									showNotification('danger', 'Error, No se logro borrar el registro satisfactoriamente');
								}
							},
							error: function(jqXHR, status, error) {
								showNotification('danger', 'Error, No se logro borrar el registro satisfactoriamente');
							}
						});
					}
				},
				cancel: {
					text: 'Cancelar',
					btnClass: 'btn-default',
					action: function() {
					}
				}
			}
		});
	}); // Fin de Eliminar

	// Acción de Restaurar Item
	$('table.tabla-datos tbody').on('click', '.restaurar-item', function(){
		var url = $('table.tabla-datos').data('restore');
		var url_refresh = $('table.tabla-datos').data('list');
		var item = $(this).data('item');
		var datos = {
			"id"    : $(this).data('id')
		};
		$.confirm({
			icon: 'fa fa-question',
			title: 'Restaurar',
			content: 'Esta seguro de restaurar el registro de <b>' + item + '</b>',
			theme: 'modern',
			closeIcon: true,
			animation: 'scale',
			type: 'yellow',
			draggable: false,
			buttons: {
				remove: {
					text: 'Restaurar',
					btnClass: 'btn-warning',
					action: function() {
						$.ajax({
							url: url,
							type: 'post',
							data: datos,
							success: function (data) {
								if (data.res == 'ok') {
									showNotification('success', 'Operación exitosa, Se restauró el registro satisfactoriamente');
									setTimeout(function(){
										window.location.href = url_refresh;
									}, 3000);
								} else {
									showNotification('danger', 'Error, No se logro restaurar el registro satisfactoriamente');
								}
							},
							error: function(jqXHR, status, error) {
								showNotification('danger', 'Error, No se logro restaurar el registro satisfactoriamente');
							}
						});
					}
				},
				cancel: {
					text: 'Cancelar',
					btnClass: 'btn-default',
					action: function() {
					}
				}
			}
		});
	}); // Fin de Restaurar

	$('form.form-reporte').validator().on('submit', function(e){
		$('button[type="submit"]').prop('disabled', true);
		var $this = $(this);
		
		if ( $this.data('requestRunning') ) {
			return;
		}

		if (e.isDefaultPrevented()) {
			// Form Invalido
			showNotification('warning', 'Datos Incompletos, revise los campos obligatorios (*)');
			$('button[type="submit"]').prop('disabled', false);
		} else {
			// Form Valido
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: $(this).serializeArray(),
				success: function(data) {
					$this.clearForm(); 
					showNotification('success', 'Datos Correctos, Se generó el reporte correctamente');
					$('div#reporte-contenedor').html(data);
					$('button[type="submit"]').prop('disabled', false);
				},
				complete: function(){
					$('button[type="submit"]').prop('disabled', false);
				}
			});
			return 0;
		}
	}); // Fin de reportes

	// $('input.datetimepicker').datetimepicker({
	// 	format: 'YYYY-MM-DD'
	// });

	// $('select.select2').select2();

	
	/**
	* Websockets
	*************/

	var $destinatario;
	var $remitente;

	if ( $('#chat-app').length ) {

		var conn = new WebSocket('ws://localhost:8080');
		conn.onopen = function(e) {
			console.log("Conexión establecida!");
			$.ajax({
				url:$('#chat-app').data('conexion'),
				data:{id:$('#conversation').data('usuario'),est:'conectado'},
				type:"POST",
				success:function(respuesta){ console.log(respuesta); }
			});
		};

		conn.onmessage = function(e) {
			console.log(e.data);
			var data = JSON.parse(e.data);
			// console.log(data);

			// if ( data.length ) {
				console.log(data);
				if ( $('#conversation').data('usuario') == data.remitente || $('#conversation').data('usuario') == data.consignatario ) {
					console.log('ingreso a la conversation');
					var tipo = ($('#conversation').data('usuario') == data.remitente) ? 'sender' : 'receiver';
					console.log(tipo);
					if ( data.tipo == 1 ) {
						$('#conversation').append('' + 
							'<div class="row message-body">' +
								'<div class="col-sm-12 message-main-'+ tipo +'">' +
									'<div class="'+ tipo +'">' +
										'<div class="message-text">' + data.mensaje + '</div>' +
										'<div class="message-time pull-right">' + data.fecha + '</div>' +
									'</div>' +
								'</div>' +
							'</div>'
						);
					} else {
						var url_adjunto = $('#chat-app').data('get-file') + '/' + data.codigo_archivo;
						$('#conversation').append('' + 
							'<div class="row message-body">' +
								'<div class="col-sm-12 message-main-'+ tipo +'">' +
									'<div class="'+ tipo +'">' +
										'<div class="message-text"><a href="'+url_adjunto+'" target="_blank">'+data.nombre_archivo+' <i class="fa fa-paperclip"></i></a></div>' +
										'<div class="message-time pull-right">' + data.fecha + '</div>' +
									'</div>' +
								'</div>' +
							'</div>'
						);
					}

					$("#conversation").stop().animate({ scrollTop: $("#conversation")[0].scrollHeight}, 2000);
				}
			// }
			// var row = '<tr><td valign="top"><div><strong>' + data.from +'</strong></div><div>'+data.msg+'</div><td align="right" valign="top">'+data.dt+'</td></tr>';
			// $('#chats > tbody').prepend(row);

		};

		conn.onclose = function(e) {
			console.log("Conexión cerrada!");
			$.ajax({
				url:$('#chat-app').data('conexion'),
				data:{id:$('#conversation').data('usuario'),est:'desconectado'},
				type:"POST",
				success:function(respuesta){ console.log(respuesta); }
			});
		}

	}

	$('#btn-adjunto').on('click', function (e) {
		$('#adjunto').click();
	});

	$('#adjunto').on('change', function (e) {
		var formData = new FormData();
		formData.append('file', $('#adjunto')[0].files[0]);

		$.ajax({
			url: $('#adjunto').data('upload'),  
			type: 'POST',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			success: function ( data ) {
				var datos = JSON.parse(data);
				if ( datos.res ) {
					var usuario_remitente 	= $('[name="usuario_remitente"]').val();
					var usuario_destinatario 	= $('[name="usuario_destinatario"]').val();
					var msg = datos.data;
					console.log(msg);
					if (msg != '') {
						var data = {
							remitente: usuario_remitente,
							consignatario: usuario_destinatario,
							mensaje: msg.codigo,
							codigo: msg.codigo,
							nombre: msg.nombre,
							tipo_archivo: msg.tipo,
							tipo: 2
						};
						conn.send(JSON.stringify(data));
						$("#comment").val("");
					}
				}
			}
		});
	});

	$('.fila-contacto').on('click', function(e){
		e.preventDefault();
		console.log('click on user...');
		$('.fila-contacto').removeClass('user-selected');
		$(this).addClass('user-selected');
		$destinatario = $(this).data('usuario-id');
		$remitente = $('[name="usuario_remitente"]').val();
		$('[name="usuario_destinatario"]').val($destinatario);
		$('#send-message').prop('disabled', false);
		$("#comment").val("");
		$('#conversation').html('');

		$.ajax({
			url: $('#chat-app').data('get-mensajes'),
			type: 'post',
			data: {destinatario: $destinatario, remitente: $remitente},
			success: function (data) {
				if ( data.length ) {
					data.forEach(function(msg, indice){
						console.log(msg);
						// if ( $('#conversation').data('usuario') == msg.env_id || $('#conversation').data('usuario') == msg.usu_id ) {
							var tipo = ($('#conversation').data('usuario') == msg.env_id) ? 'sender' : 'receiver';
							if ( msg.men_tipo == 1 ) {
								$('#conversation').prepend('' + 
									'<div class="row message-body">' +
										'<div class="col-sm-12 message-main-'+ tipo +'">' +
											'<div class="'+ tipo +'">' +
												'<div class="message-text">' + msg.men_mensaje + '</div>' +
												'<div class="message-time pull-right">' + msg.men_fecha + '</div>' +
											'</div>' +
										'</div>' +
									'</div>'
								);
							} else {
								var url_adjunto = $('#chat-app').data('get-file') + '/' + msg.arc_codigo;
								$('#conversation').prepend('' + 
									'<div class="row message-body">' +
										'<div class="col-sm-12 message-main-'+ tipo +'">' +
											'<div class="'+ tipo +'">' +
												'<div class="message-text"><a href="'+url_adjunto+'" target="_blank">'+msg.arc_archivo+' <i class="fa fa-paperclip"></i></a></div>' +
												'<div class="message-time pull-right">' + msg.men_fecha + '</div>' +
											'</div>' +
										'</div>' +
									'</div>'
								);
							}
						// }
					});
				}
				console.log(data);
			}
		});
	});

	$("#send-message").click(function(){
		var usuario_remitente 	= $('[name="usuario_remitente"]').val();
		var usuario_destinatario 	= $('[name="usuario_destinatario"]').val();
		var msg = $("#comment").val();
		if (msg != '') {
			var data = {
				remitente: usuario_remitente,
				consignatario: usuario_destinatario,
				mensaje: msg,
				tipo: 1
			};
			conn.send(JSON.stringify(data));
			$("#comment").val("");
			$("#conversation").stop().animate({ scrollTop: $("#conversation")[0].scrollHeight}, 2000);
		}
	});

	$("#leave-chat").click(function(){
		var userId 	= $("#userId").val();
		$.ajax({
			url:"action.php",
			method:"post",
			data: "userId="+userId+"&action=leave"
		}).done(function(result){
			var data = JSON.parse(result);
			if(data.status == 1) {
				conn.close();
				location = "index.php";
			} else {
				console.log(data.msg);
			}
			
		});
		
	})
	

});

function showNotification(_type, _message) 
{
	$.notify({
		icon: "fa fa-fw fa-bell",
		message: _message

	}, {
		type: _type,
		timer: 100,
		placement: {
			from: 'top',
			align: 'left'
		}
	});
}

$.fn.clearForm = function() {
	return this.each(function() {
		var type = this.type, tag = this.tagName.toLowerCase();
		if (tag == 'form')
			return $(':input',this).clearForm();
		if (type == 'text' || type == 'password' || tag == 'textarea' || type == 'number' || type == 'email' || type == 'tel')
			this.value = '';
		else if (type == 'checkbox' || type == 'radio')
			this.checked = false;
		else if (tag == 'select')
			this.selectedIndex = -1;
	});
};

function mostrar(con,id){ 
	$("."+con+id).toggle("slow");	
}
function ejecutar(con){ 
	//$("#pid"+id).val(id);
	$("#"+con).submit();	
}

	// Acción de Eliminar Items
	$('.opc-edit').on('click', '.borrar-item', function(){ 
		//var fila = $(this).parents('div'); 
		var fila = $(this).parents($(this).data('reg'));
		var url = $(this).data('remove');
		var item = $(this).data('item');
		var datos = {
			"id"    : $(this).data('id')
		}; //alert($(this).data('remove'));
		$.confirm({
			icon: 'fa fa-question',
			title: 'Borrar',
			content: 'Esta seguro de borrar el registro de <b>' + item + '</b>',
			theme: 'modern',
			closeIcon: true,
			animation: 'scale',
			type: 'red',
			draggable: false,
			buttons: {
				remove: {
					text: 'Borrar',
					btnClass: 'btn-danger',
					action: function() {
						$.ajax({
							url: url,
							type: 'post',
							data: datos,
							success: function (data) {
								if (data.res == 'ok') {
									fila.remove();
									showNotification('success', 'Operación exitosa, Se borró el registro satisfactoriamente');
								} else {
									showNotification('danger', 'Error, No se logro borrar el registro satisfactoriamente');
								}
							},
							error: function(jqXHR, status, error) {
								showNotification('danger', 'Error, No se logro borrar el registro satisfactoriamente');
							}
						});
					}
				},
				cancel: {
					text: 'Cancelar',
					btnClass: 'btn-default',
					action: function() {
					}
				}
			}
		});
	}); // Fin de Eliminar
	
function mod_publicacion(id,url){ 
	//$("#ventana").modal("show"); 
	$.ajax({
		url:url+"/"+id,
		data:{id:id},
		type:"POST",
		success:function(respuesta){ //alert(respuesta);
			var datos=JSON.parse(respuesta);
			console.log(datos);
			$('#mid').val(id);
			$('#mdesc').val(datos['pub_desc']);
		}
	});
}
function mod_comentario(id,url){ 
	//$("#ventana").modal("show"); 
	$.ajax({
		url:url+"/"+id,
		data:{id:id},
		type:"POST",
		success:function(respuesta){ //alert(respuesta);
			var datos=JSON.parse(respuesta);
			console.log(datos);
			$('#cmid').val(id);
			$('#mcom').val(datos['com_comentario']);
		}
	});
}
function saber_mas(){
	document.location.href='#saber_mas';	
}

function adm_add(){ 
	$('#action').val('add');
	$('#form-adm')[0].reset();
	$('#admid').val(0);
	$('.usr_foto').attr("src",'');
	$('.usr_imagen').attr("src",'');
}
function adm_mod(url,id){ 
	$('#action').val('mod');
	$('#form-adm')[0].reset();
	$.ajax({
		url:url+"/"+id,
		data:{id:id},
		type:"POST",
		success:function(respuesta){ //alert(respuesta);
			var datos=JSON.parse(respuesta);
			console.log(datos);
			$('#admid').val(id);
			$('#nombre').val(datos['usu_nombre']);
			$('#apellido').val(datos['usu_apellido']);
			$('#correo').val(datos['usu_email']);
			$('#usuario').val(datos['usu_usuario']);
			$('#contrasena').val(datos['usu_clave']);
			$('#contrasenar').val(datos['usu_clave']);
			var text = $("select[name=tipo] option[value='"+datos['usu_tipo']+"']").text();
			$('.bootstrap-select:eq(0) .filter-option').text(text);
			$('#tipo').val(datos['usu_tipo']); //alert(datos['usu_tipo']);
			//$('#tipo option[value="2"]').prop('selected', true);
			var text = $("select[name=nivel] option[value='"+datos['usu_nivel']+"']").text();
			$('.bootstrap-select:eq(1) .filter-option').text(text);
			$('#nivel').val(datos['usu_nivel']); 
			var text = $("select[name=estado] option[value='"+datos['usu_estado']+"']").text();
			$('.bootstrap-select:eq(2) .filter-option').text(text);
			$('#estado').val(datos['usu_estado']);
			var url = $('#url-img').val();
			$('#fotor').val(datos['usu_foto']);
			$('.usr_foto').attr("src",url+datos['usu_foto']);
			$('#imagenr').val(datos['usu_imagen']);
			$('.usr_imagen').attr("src",url+datos['usu_imagen']);
		}
	});
}
function adm_mod1(url,id){ 
	$('#action').val('mod');
	$('#form-adm')[0].reset();
	$.ajax({
		url:url+"/"+id,
		data:{id:id},
		type:"POST",
		success:function(respuesta){ //alert(respuesta);
			var datos=JSON.parse(respuesta);
			console.log(datos);
			$('#admid').val(id);
			$('#des').val(datos['mat_desc']);
			$('#detalle').val(datos['mat_detalle']);
			var text = $("select[name=estado] option[value='"+datos['mat_estado']+"']").text();
			$('.bootstrap-select:eq(2) .filter-option').text(text);
			$('#estado').val(datos['mat_estado']);
		}
	});
}
function adm_mod2(url,id){ 
	$('#form-adm1')[0].reset(); 
	//$('.mau').attr('checked', false);
	$('#admid1').val(id);
	$.ajax({
		url:url+"/"+id,
		data:{id:id},
		type:"POST",
		success:function(respuesta){ //alert(respuesta);
			var datos=JSON.parse(respuesta);
			console.log(datos);
			$('.mau').each(function(){
				var id = $(this).val();
				var cont = 0;
				for(var i = 0; i<datos.length; i++){ if(datos[i]["mat_id"]==id){ cont++; } }
				//$('#mat' + datos[i]["mat_id"]).attr('checked', true);
				if(cont==0){
					$(this).attr('checked', false);
				}else{
					$(this).attr('checked', true);
				}
			});
		}
	});
}