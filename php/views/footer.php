</main> <!-- end main -->

</div><!-- end row -->
</div><!-- end container-fluid -->

<footer class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <img src="/assets/images/concursando2.jpg" alt="concursando">
        </div>
    </div>
    <div class="col-xs-12 text-center">
        <ul class="col-xs-12 col-sm-9 nav-inferior">
            <li>Inicio</li>
            <li>Participá</li>
            <li>Terminos y condiciones</li>
            <li>Contacto</li>
        </ul>
        <ul class="col-xs-12 col-sm-3 social">
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
        </ul>
    </div>

</footer>
<script src="<?php echo ASSETS_PATH; ?>js/jquery-2.1.4.min.js"></script>
<script src="<?php echo ASSETS_PATH; ?>js/jquery.md5.js"></script>
<script src="<?php echo ASSETS_PATH; ?>js/bootstrap.min.js"></script>
<!-- Custom JS-->
<script src="<?php echo ASSETS_PATH; ?>js/global.js"></script>
<script src="<?php echo ASSETS_PATH; ?>js/<?php echo $data; ?>.js"></script>
<script>
    $(document).ready(function () {
        global.init();
        particular.init();
    });
</script>
</body>
</html>