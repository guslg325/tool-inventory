$(document).ready(function(){
	$(".deleteStorage").click(function(){
		const storageID = $(this).attr("data-storage");
		$.ajax({
			url: "./deleteStorage_AX.php",
            method: "post",
            data: {id:storageID},
            cache: false,
            success:function(respAX){
                //Respuesta del servidor
				let AX = JSON.parse(respAX);
				$.alert({
					title:'<h5>Aviso</h5>',
					content:AX.msj,
					theme: "dark",
					useBootstrap: false,
					boxWidth:"50%",
					onDestroy:function(){
						if(AX.code==0){
							window.location.href="./storage.php";
						}
					}
				});
            }
		});
	});
});