$(document).ready(function(){
    var ativado = 1;
    var alunoOrProfessor = "aluno";


    $('.btn-logout').click(function(e){
        $("#modal-logout").css("top", "0");
        $("html").css("overflow", "hidden");
    });

    $("#modal-logout, #modal-logout .negar").click(function(e){
        if(e.target == this){
             $("#modal-logout").css("top", "-100%");
            $("html").css("overflow", "auto");
        }
    });

    $('#close').click(function(e){
    	menuAtivado();
    });



    $(".header-left .btn-acessar").click(function(e){
    	$("#login-modal").css("top", "0");
    	$("html").css("overflow", "hidden");
    });


    $("#login-modal").click(function(e){
    	if(e.target == this){
    		$("#login-modal").css("top", "-100%");
    		$("html").css("overflow", "auto");
    	}
    });

    $(".login-content .escolha .btn-aluno").click(function(e){
    	if(alunoOrProfessor == 'aluno') return;
    	$("#login-modal .content-form").animate({"left":"0em"}, 200);
    	$(this).addClass('btn-active');
    	$(".login-content .escolha .btn-professor").removeClass("btn-active");
    	alunoOrProfessor = 'aluno';
    });

    $(".login-content .escolha .btn-professor").click(function(e){
    	if(alunoOrProfessor == 'professor') return;
    	$("#login-modal .content-form").animate({"left": "-25em"}, 200);
    	$(this).addClass('btn-active');
    	$(".login-content .escolha .btn-aluno").removeClass("btn-active");
    	alunoOrProfessor = 'professor';

    });

    $(".content-alunos .btn-aluno").click(function(e){
 
        $(".content-alunos .wrapp").css("display", "none");
        $("#novo-aluno").css("display", "flex");
    });

    function menuAtivado(){
	    if(ativado == 1){
		    $(".left-side .navegacao").css("display", "none");
		    $(".left-side").animate({
		    width: "5em"
		    }, 200);
		    $("#content-side .txt").css("display", "none");
		    $(".menu .img").css("width", "100%");
		    $("form.buscar").css("display", "none");
		    $("#close img").css("transform", "scale(-1)");
		    $(".left-side .menu li a").css("justify-content", "center");
		    setTimeout(() => {  $(".left-side .navegacao").css("display", "block"); }, 200);
		    $(".content-wrapper").css("width", "calc(100% - 5em)");
		    ativado = 0;
	    }else{
		    $(".left-side").animate({
		    width: "16em"
		    }, 200);
		    setTimeout(() => { $(".content-wrapper").removeAttr("style"); }, 200 );
		    $(".left-side .menu li a").removeAttr("style");
		    $(".menu .img").removeAttr("style");
		    $("form.buscar").removeAttr("style");
		    $("#close img").removeAttr("style");
		    setTimeout(() => { $("#content-side .txt").removeAttr("style"); }, 200);
		    ativado = 1;
	    } 
    };
}); 