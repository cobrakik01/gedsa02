/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $(".iv-slide").html("<img />").find("img").attr("src", "/img/loader.gif");

    $.ajax({
        type: "POST",
        url: "/trabajos/cargar_album/",
        cache: true,
        data: {
            id: $(".iv-slide").attr("id")
        },
        error: function() {
            //$(".iv-slide").html("<strong>" + data + "</strong> degrees");
        },
        success: function(data) {
            $(".iv-slide").html(data);
            $(document).keydown(function(e) {
                switch (e.which) {
                    case 35:
                        //alert(e.which); // fin
                        if (oldImg != $(".iv-slide ul li img").get($(".iv-slide img").length - 1)) {
                            loadImage($(".iv-slide ul li img").get($(".iv-slide ul li img").length - 1));
                        }
                        break;
                    case 36:
                        //alert(e.which); // inicio
                        if (oldImg != $(".iv-slide ul li img").get(0)) {
                            loadImage($(".iv-slide ul li img").get(0));
                        }
                        break;
                    case 37: // Izquierda
                        if ($(oldImg).parent().index() > 0) {
                            loadImage($(oldImg).parent().prev().children("img").first());
                        }
                        break;
                    case 39: // Derecha
                        if ($(oldImg).parent().index() < ($(".iv-slide img").length - 1)) {
                            loadImage($(oldImg).parent().next().children("img").first());
                        }
                        break;
                }
            });
            init();
        }
    });

});

function init() {
    loadImage($(".iv-slide img").first());
    transformLinks();
    $(".iv-slide ul li img").click(function() {
        if (oldImg != this) {
            loadImage(this);
        }
    }).hover(function() {
        $(this).css("background-color", "#ccd8ef");
    }, function() {
        $(this).css("background-color", "white");
    });
}

function transformLinks() {
    $(".pagination a").css("background-color", "#f7f7f7").css("border", "2px solid #c9c9c9").css("margin-right", "3px").css("border-radius", "25px").css("padding", "3px").html("").first().remove();
    $(".pagination a").last().remove();
    $(".pagination a[href=#]").css("background-color", "#dbdbdb").css("border", "solid 2px #b5b5b5");
}

var oldImg;
function loadImage(img) {
    if (oldImg) {
        $(oldImg).css("background-color", "white");
    }
    oldImg = img;
    var src = $(img).first().css("background-color", "#5ebff7").attr("src");
    var descripcion = $(img).next().html();
    var height = ($(window).height() - ($(".iv-slide img").height() + 70));
    $(".imageViewer").find("img").hide().delay(200).attr("src", src).height(height + "px").fadeIn("slow").delay(200);

    var width = $(".imageViewer").find("img").width();
    $("#descripcion-foto").hide().html(descripcion).css("left", "-" + (width + 25) + "px").delay(200);
    $("#descripcion-foto")
            .fadeIn("slow")
            .delay(200)
            .css({"background-image": "url(/img/block.png)", "color": "white", "width": width + "px"})
            .delay(200)
            .animate({"top": "-" + ($("#descripcion-foto").height() + 25) + "px", "left": (($(window).width() - (width + 40)) / 2) + "px"}, 400);
}