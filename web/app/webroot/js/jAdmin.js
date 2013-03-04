$(document).ready(function(){
	$(".delete").click(function(){
		var answer = confirm('Você deseja deletar esse(a) '+jQuery(this).attr('title')+'?');
		return answer;
	});
        
        
})