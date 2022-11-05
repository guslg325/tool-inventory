$(document).ready(function(){
	//Update play/stop icon
	if($(".toolStatus").attr("stat")=="Sin usar"){
		$(".dynamic").removeClass("fa-stop");
		$(".dynamic").addClass("fa-play");
	}else{
		$(".dynamic").removeClass("fa-play");
		$(".dynamic").addClass("fa-stop");
	}
	
	$(".deleteTool").click(function(){
		$.confirm({
			title: 'Confirmar',
			theme: "dark",
			useBootstrap: false,
			content: '¿Eliminar herramienta?',
			buttons: {
				confirm: {
					text: 'Si',
					btnClass: 'button red darken-1',
					keys: ['enter'],
					action: function(){
						const toolID = $(".deleteTool").attr("data-tool");
						$.ajax({
							url: "./deleteTool_AX.php",
							method: "post",
							data: {id:toolID},
							cache: false,
							success:function(respAX){
								let AX = JSON.parse(respAX);
								$.alert({
									title:'<h5>Aviso</h5>',
									content:AX.msj,
									theme: "dark",
									useBootstrap: false,
									boxWidth:"50%",
									onDestroy:function(){
										if(AX.code==0){
											window.location.href="./../index.php";
										}
									}
								});
							}
						});
					}
				},
				cancel: {
					text: "No"
				},
			}
		});
	});

	$(".updateTool").click(function(){
		window.location.href="./updateTool.php?toolID="+$(".updateTool").attr("data-tool");
	});

	$(".useTool").click(function(){
		var confirmMsj = "";
		if($(".toolStatus").attr("stat")=="Sin usar")
			confirmMsj = "¿Comenzar a utilizar herramienta?";
		else
			confirmMsj = "¿Dejar de utilizar herramienta?";

		$.confirm({
			title: 'Confirmar',
			theme: "dark",
			useBootstrap: false,
			content: confirmMsj,
			buttons: {
				confirm: {
					text: 'Si',
					btnClass: 'button grey darken-1',
					keys: ['enter'],
					action: function(){
						const toolID = $(".useTool").attr("data-tool");
						$.ajax({
							url: "./useTool_AX.php",
							method: "post",
							data: {id:toolID},
							cache: false,
							success:function(respAX){
								let AX = JSON.parse(respAX);
								$.alert({
									title:'<h5>Aviso</h5>',
									content:AX.msj,
									theme: "dark",
									useBootstrap: false,
									boxWidth:"50%",
									onDestroy:function(){
										if(AX.code==0){
											window.location.href="./../index.php";
										}
									}
								});
							}
						});
					}
				},
				cancel: {
					text: "No"
				},
			}
		});
	});
});