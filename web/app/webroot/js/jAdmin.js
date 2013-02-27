$(document).ready(function(){
	$("table tbody tr").hover(
		function(){
			$("div",this).css("visibility","visible");
		},

		function(){
			$("div",this).css("visibility","hidden");
		}
	);

	$(".linkDel").click(function(){
		var answer = confirm('Você deseja deletar esse(a) '+jQuery(this).attr('title')+'?');
		return answer;
	});
})