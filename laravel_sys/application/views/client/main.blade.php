<!DOCTYPE html>
<html><!-- HEADER -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Taller de Arquitectura Gedsa</title>
        {{HTML::style('css/slider/flexslider.css')}}
        {{HTML::style('css/client-style.css')}}
        
        {{HTML::script('js/jquery-1.9.1.js')}}
        {{HTML::script('js/slider/jquery.flexslider-min.js')}}
        
        <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="../img/logo.png" type="image/png" />
        <script type="text/javascript">
            $(document).ready(function(){
                $(".article").click(function(){
                    var href = $(this).children().children("div").first().find("a").attr("href");
                    location.href = href;
                });
            });
        </script>
    </head>

    <body>
        <div class="header">
            <div class="wrapper-s">
                <div id="container-logo">
                    {{ HTML::image('img/logo.png', 'Logo GEDSA') }}
                    <div id="font-header" style="margin-top: 50px;">
                        <div style="font-size: 36px; color: #2D2D2D; font-weight: bold;">
                            GEDSA
                        </div>
                        <div style="font-size: 15px; font-weight: lighter; color: #818181; clear: both;">
                            <em>Taller de Arquitectura</em>
                        </div>
                    </div>
                </div>
                <div id="container-slogan">
                    <span style="font-size: 50px; color: #262626">P</span>lasmamos tus sueños
                </div>
            </div>
        </div>
        <div class="nav">
            <div class="wrapper-s">
                <ul>
                    @section('menu')
                    <li>{{HTML::link('/','Inicio')}}</li>
                    <li>{{HTML::link('servicios','Servicios')}}</li>
                    <li>{{HTML::link('trabajos','Nuestros Trabajos')}}</li>
                    <li>{{HTML::link('nosotros','Nosotros')}}</li>
                    <li>{{HTML::link('contactanos','Contactenos')}}</li>
                    @yield_section
                </ul>
            </div>
        </div>
        <!-- END HEADER -->

        <!-- BODY -->
        <div id="container-body">
            <div class="wrapper-s">  <!-- MAIN WRAPPER -->
                @section('slider')
                @if(isset($fotos))
                    @if($fotos->total > 0)
                        <div class="flexslider" style="height: 500px; border-radius: 5px; box-shadow: 5px 5px 5px -6px;">
                            <ul class="slides">
                                @foreach($fotos->results as $foto)
                                <li>
                                    {{ HTML::image($foto->url, 'imagen', array('height'=>'500px', 'style' => 'border-radius: 5px;')) }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                    <div style="border: solid 1px #ccccff; padding: 10px; border-radius: 5px; margin-top: 20px; text-align: center;">
                        Sin presentación principal, o sin fotos disponibles en la presentación.
                    </div>
                    @endif
                @endif
                <script>
                    $(window).load(function() {
                        $('.flexslider').flexslider({
                            animation: "slide",
                            animationLoop: true,
                            smoothHeight: false
                        });
                    });
                </script>
                @yield_section
                @yield('titulo_seccion')
                <div id="content"> <!-- ARTICLES -->
                    @yield('contenido')
                </div> <!-- END ARTICLES -->
                <div class="aside"> <!-- BANNER´S -->
                    <div class="banner">
                        <ul class="vmenu">
                            <h3>Tambien visitenos en...</h3>

                            <!-- inicio plugin facebook -->
                            <script>
                                (function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id))
                                        return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                            </script>
                            <div class="fb-like" data-href="{{URL::base()}}" data-width="100%" data-layout="button_count" data-action="like" data-show-faces="true" data-send="false"></div>
                            <!-- fin plugin facebook -->

                            <li>
                                <a href="http://www.facebook.com/tallerdearq.geedsa?fref=ts" target="blanck"> {{ HTML::image('img/contactanos/search2.png', 'Faceboock', array('width'=>'15', 'height'=>'15', 'border'=>'0')) }} Faceboock</a>
                                <a href="">{{ HTML::image('img/contactanos/twitter_borde.png', 'Twitter', array('width'=>'15', 'height'=>'15', 'border'=>'0')) }} Twitter</a>
                                <a href="">{{ HTML::image('img/contactanos/youtube.png', 'Youtube', array('width'=>'15', 'height'=>'15', 'border'=>'0')) }} Youtube</a>
                            </li>
                        </ul>
                    </div>
                </div> <!-- END BANNER´S -->

            </div><!-- END MAIN WRAPPER -->
        </div>
        <!-- END BODY -->
        <!-- FOOTER -->
        <div id="footer">
            <div class="wrapper-s" id="footer-content">
                Taller de Arquitectura <div style="font-weight: bold;">GEDSA</div>
                <p>
                    &copy<?php echo date('Y');?>
                </p>
            </div>
        </div>
    </body>
</html>
<!-- END FOOTER -->