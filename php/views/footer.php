				</main> <!-- end main -->
		</div><!-- end row -->
	</div><!-- end container-fluid -->
    <script src="<?php echo ASSETS_PATH; ?>js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>js/jquery.md5.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>js/bootstrap.min.js"></script>
    <!-- Custom JS-->
    <script src="<?php echo ASSETS_PATH; ?>js/global.js"></script>
    <script src="<?php echo ASSETS_PATH; ?>js/<?php echo $data; ?>.js"></script>
    <script>
        $(document).ready( function(){
            global.init();
            particular.init();
        });
    </script>
    </body>
</html>