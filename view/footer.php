 
</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo $this->getHostPath(); ?>/public/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $this->getHostPath(); ?>/public/js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
