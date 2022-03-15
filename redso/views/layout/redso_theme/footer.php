    <!-- Jquery Core Js listo-->
    <script src="<?=$_assets['plugins']?>jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js listo-->
    <script src="<?=$_assets['plugins']?>bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js listo-->
    <script src="<?=$_assets['plugins']?>bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js listo-->
    <script src="<?=$_assets['plugins']?>jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js listo-->
    <script src="<?=$_assets['plugins']?>node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="<?=$_assets['js']?>admin.js"></script> <!--listo-->
    
    <script src="<?=$_assets['js']?>all.min.js"></script> <!--listo-->
    <script src="<?=$_assets['js']?>fontawesome.min.js"></script> <!--listo-->
    
    <script src="<?=$_assets['js']?>jquery-confirm.min.js"></script>  <!--listo-->
    
    <script src="<?=$_assets['js']?>validator.min.js"></script> <!--listo-->
    <script src="<?=$_assets['plugins']?>bootstrap-notify/bootstrap-notify.min.js"></script><!--listo-->

    <script src="<?=$_assets['js']?>dropzone.min.js"></script>  <!--listo-->
    <!-- Demo Js -->
    <script src="<?=$_assets['js']?>demo.js"></script>  <!--listo-->
    <script src="<?=$_assets['js']?>script.js"></script>  <!--listo-->
    
    <script src="<?=$_assets['plugins']?>jquery-datatable/jquery.dataTables.js"></script><!--listo-->
    <script src="<?=$_assets['plugins']?>jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script><!--listo-->
    
    <script language="javascript">
/*window.onload=function(){
	var pos=window.name || 0;
	window.scrollTo(0,pos);
}
window.onunload=function(){
	window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
}*/

	Dropzone.autoDiscover = false;
	var fileList = new Array;
	var fileListName = new Array;
	var i = 0;
	var photos = new Dropzone('#dropzone', {
		url: '<?=BASE_URL?>inicio/subir_archivos',
		addRemoveLinks: true,
		success: function(file, serverFileName) {
			var archivo = serverFileName.info;  //alert(serverFileName.info);
			//fileList[i] = {"serverFileName" : archivo.file_name, "fileName" : archivo.client_name, "fileId" : i }; 
			fileList[i] = {"serverFileName" : serverFileName.info, "fileName" : serverFileName.info, "fileId" : i }; 
			// fileListName.push(fileList[i].serverFileName, fileList[i].fileName);
			//fileListName.push(fileList[i].serverFileName);
			fileListName.push(serverFileName.info);
			i++;
			// uniendo y agregando al input
			$('input[name="adjuntos"]').val(fileListName.join('*'));
			// console.log($('input[name="adjuntos"]').val());
		},
		removedfile: function(file) {
			var name = file.name; 
			var cadena = document.getElementById("adjuntos").value;
			var txt = cadena.replace(name,'');
			$('input[name="adjuntos"]').val(txt);
			var rmvFile = "";
			for(f = 0; f < fileList.length; f++){
				if(fileList[f].fileName == file.name){
					rmvFile = fileList[f].serverFileName;
					//fileList.splice(f, 1); delete fileList[f];
				}
			}
			
			for(f = 0; f < fileListName.length; f++){
				if(fileListName[f] == file.name){
					fileListName.splice(f, 1); //delete fileList[f];
				}
			}

			if (rmvFile) {
				$.ajax({
					url: '<?=BASE_URL?>inicio/remover_archivos',
					type: 'post',
					data: {archivo: rmvFile},
					dataType: 'html'
				});
			}

			var previewElement;
			return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
		}
	});
		
	photos.on("uploadprogress", function () {
		$('.dz-message').hide();
		return _this3.updateTotalUploadProgress();
	});
	

	</script>
    
  <!--<script src="ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
  <script src="<?=$_assets['plugins']?>skidder/examples/lib/imagesloaded.js"></script><!--listo-->
  <script src="<?=$_assets['plugins']?>skidder/examples/lib/smartresize.js"></script><!--listo-->
  <script src="<?=$_assets['plugins']?>skidder/src/jquery.skidder.js"></script><!--listo-->

  <script>
    $('.slideshow').each( function() {
      var $slideshow = $(this);
      $slideshow.imagesLoaded( function() {
        $slideshow.skidder({
          slideClass    : '.slide',
          animationType : 'css',
          scaleSlides   : true,
          maxWidth : 1300,
          maxHeight: 500,
          paging        : true,
          autoPaging    : true,
          pagingWrapper : ".skidder-pager",
          pagingElement : ".skidder-pager-dot",
          swiping       : true,
          leftaligned   : false,
          cycle         : true,
          jumpback      : false,
          speed         : 400,
          autoplay      : false,
          autoplayResume: false,
          interval      : 4000,
          transition    : "slide",
          afterSliding  : function() {},
          afterInit     : function() {}
        });
      });
    });

    // $('.slideshow-nocycle').each( function() {
    //   var $slideshow = $(this);
    //   $slideshow.imagesLoaded( function() {
    //     $slideshow.skidder({
    //       slideClass    : '.slide',
    //       scaleSlides   : true,
    //       maxWidth : 1300,
    //       maxHeight: 500,
    //       leftaligned   : true,
    //       cycle         : false,
    //       paging        : true,
    //       swiping       : true,
    //       jumpback      : false,
    //       speed         : 400,
    //       autoplay      : false,
    //       interval      : 4000,
    //       afterSliding  : function() {}
    //     });
    //   });
    // });

    $(window).smartresize(function(){
      $('.slideshow').skidder('resize');
    });
	
	$(document).ready(function() {
		$('#tabla1').dataTable();
		//$('.tabla1').dataTable();
	} );

  </script>
</body>

</html>