</main> <!-- end main -->

</div><!-- end row -->
</div><!-- end container-fluid -->

<footer class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <a href="/"><img src="/assets/images/logo.png" class="logo" alt="concursando"/></a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <ul class="hidden-xs col-sm-9 nav-inferior">
                <li><a href="#">Concursos</a></li>
                <li class="divider">|</li>
                <li><a href="#">Cre&aacute; tu concurso</a></li>
                <li class="divider">|</li>
                <li><a href="#">T&eacute;rminos y condiciones</a></li>
                <li class="divider">|</li>
                <li><a href="#">Contacto</a></li>
            </ul>
            <ul class="col-xs-12 col-sm-3 social text-center">
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            </ul>
        </div>
    </div>
</footer>
<script src="<?php echo ASSETS_PATH; ?>js/jquery-2.1.4.min.js"></script>
<script src="<?php echo ASSETS_PATH; ?>js/jquery.md5.js"></script>
<script src="<?php echo ASSETS_PATH; ?>js/bootstrap.min.js"></script>
<!-- Custom JS-->
<script src="<?php echo ASSETS_PATH; ?>js/global.js"></script>
<script src="<?php echo ASSETS_PATH; ?>js/<?php echo $data; ?>.js"></script>
<script>
    $(document).ready(function() {
        global.init();
        particular.init();
    });
</script>
</body>
</html>