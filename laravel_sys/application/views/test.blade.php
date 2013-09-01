<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        {{HTML::script('http://code.jquery.com/jquery-1.9.1.js')}}
        <script type="text/javascript">
            $(document).ready(function() {
                var imgs = $("#imagenes img").get();
                for (var img in imgs) {
                    $("#content").append($(imgs[img]).attr("src") + "<br />");
                }
            });
        </script>
    </head>

    <body>

        <div id="content">
        </div>

        <div id="imagenes">
            <!-- <img src="/uploads/albums/Los_cavos/10_inicio_acabados.jpg" /> -->
            <!-- <img src="http://www.gedsa.com/test/img?img=/uploads/albums/Los_cavos/10_inicio_acabados.jpg" /> -->
        </div>
    </body>
</html> 