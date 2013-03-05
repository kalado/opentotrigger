$(document).ready(function(){
	$(".delete").click(function(){
		var answer = confirm('Você deseja deletar esse registro?\nCuidado essa ação pode deletar outros registros.');
		return answer;
	});
                
        $(".datePiker").datepicker();
})