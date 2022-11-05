document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, {});
});

$(document).ready(function(){
	$("form#formAddStorage").validetta({
		display : 'bubble',
		errorTemplateClass : 'validetta-bubble',
		bubblePosition: 'bottom',
		onValid:function(){
			event.preventDefault();
			var formData = new FormData($("form#formAddStorage")[0]);
			$.ajax({
				url:"./addStorage_AX.php",
                method:"post",
                data:formData,
                cache:false,
				contentType:false,
            	processData:false,
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
		}
	});
});