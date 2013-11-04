<style type="text/css">
    #prueba {
        /*background-color: #f7f7f7;*/
        background-color: #dbdbdb;
        border: solid 2px #b5b5b5;
        padding: 10px;
        border-radius: 25px;
    }
</style>

<table align="center">
    <tr>
        <td>
            <ul style="overflow: hidden; margin: 0px; padding: 0px; list-style: none;">
                @foreach($fotos->results as $foto)
                <li style="float: left;">
                    {{HTML::image($foto->url, 'ok', array('height'=>'40px'))}}
                    <div style="display: none;">
                        {{$foto->descripcion}}
                    </div>
                </li>
                @endforeach
            </ul>
        </td>
    </tr>
</table>

<table align='center'>
    <tr>
        <td>
            {{$fotos->links()}}
            <!-- <a id="prueba" href="#"></a> -->
        </td>
    </tr>
</table>
<script type="text/javascript">

    $(".pagination a:link").click(function(e) {
        e.preventDefault();

        if ($(this).attr("href") != "#") {
            $.ajax({
                type: "GET",
                url: $(this).attr("href"),
                data: {
                    id: $(".iv-slide").attr("id")
                },
                error: function(a, b, c) {
                    $(".iv-slide").html(c.responseText);
                },
                success: function(data) {
                    $(".iv-slide").html(data);
                    oldImg = null;
                    init();
                }
            });
        }
    });
</script>