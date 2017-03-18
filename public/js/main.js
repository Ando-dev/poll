$(document).on('submit', '.form-ajax', function(e){
    e.preventDefault();
    var message = $(this).find(".form-message");
    $(this).ajaxSubmit(function(data){
        console.log(data);
        var response = $.parseJSON(data);
        if(response.message !== 0){
            message.html(response.message).hide().fadeIn();
        }
        if(response.location !== false){
            if(response.location.href !== false){
                window.location.href = response.location.href;
            }else if(response.location.reload === true){
                window.location.reload();
            }
        }
    }); 
});

$(document).on('keyup', '.form-ajax[action^="?cmd=editPoll"]', function(e){
    e.preventDefault();
    var message = $(this).find(".form-message");
    $(this).ajaxSubmit(function(data){
        console.log(data);
        var response = $.parseJSON(data);
        if(response.message !== 0){
            message.html(response.message).hide().fadeIn();
        }
        if(response.location !== false){
            if(response.location.href !== false){
                window.location.href = response.location.href;
            }else if(response.location.reload === true){
                window.location.reload();
            }
        }
    }); 
}); 

$(window).on("hashchange load", function(e){
    var url = (location.hash.indexOf("#!")==0) ? location.hash.substring(2) : location.hash.substring(1);
    if($('.modal').length > 0){
        $(".modal").remove();
        $(".modal-backdrop").remove();
        $("body").removeClass("modal-open");
        $("body").css("padding-right", 0);
        $("body").css("padding-left", 0);
    }
    if(url != "" && url != "close"){
        $.get("/overlay/"+url, function(data){
            $("body").append(data);
            $('.modal').modal('show');
        });
    }
});

$(document).on('hide.bs.modal','.modal', function (){
    history.pushState({}, '', "#");
});

$(function(){
    $(".sortable").css("cursor", "move");
	$(".sortable").parent().sortable({
        items: '> .sortable',
		update : function () {
			$(this).find('.sortable').each(function(index){
                var sort = index;
                var poll_id = $(this).data("id");
                $.post('?cmd=sortablePoll', {poll_id : poll_id, sort : sort}, function(data){
                });
            });
		}
	});
});