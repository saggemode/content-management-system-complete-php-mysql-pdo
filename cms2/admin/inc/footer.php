<!--<footer>-->
<!--    &copy;copyright by <a href="#"> class 1 </a> <span class=""> 2011 - --><?php //echo date('Y'); ?><!--</span>-->
<!--</footer>-->

<!-- Footer -->
<footer class="page-footer font-small primary-color darken-3 mt-4">

    <!-- Footer Links -->
    <div class="container">

        <!-- Grid row-->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-12 py-5">
                <div class="mb-5 flex-center">

                    <!-- Facebook -->
                    <a class="fb-ic">
                        <i class="fa fa-facebook fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>
                    <!-- Twitter -->
                    <a class="tw-ic">
                        <i class="fa fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>
                    <!-- Google +-->
                    <a class="gplus-ic">
                        <i class="fa fa-google-plus fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>
                    <!--Linkedin -->
                    <a class="li-ic">
                        <i class="fa fa-linkedin fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>
                    <!--Instagram-->
                    <a class="ins-ic">
                        <i class="fa fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                    </a>
                    <!--Pinterest-->
                    <a class="pin-ic">
                        <i class="fa fa-pinterest fa-lg white-text fa-2x"> </i>
                    </a>
                </div>
            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row-->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
        &copy;copyright by <a href="#"> class 1 </a> <span class=""> 2011 - <?php echo date('Y'); ?></span>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
</div>

<script src="vendor/jquery-3/jquery-3.3.1.js"></script>
<script src="vendor/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="vendor/popper.js/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="js/mdb.min.js"></script>
 <script type="text/javascript" src="js/jQueryblockUI.js"></script>
 <script type="text/javascript" src="js/jquery_ui_widget.js"></script>
 <script type="text/javascript" src="js/jQueryUITouchPunch.js"></script>
 <script type="text/javascript" src="js/JavaScriptCookie.js"></script>
<script src="vendor/bootstrap-fileinput-master/js/fileinput.min.js"></script>
<script src="vendor/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="vendor/jquery.selectBoxIt.js/javascripts/jquery.selectBoxIt.min.js"></script>
<script src="vendor/jQuery-Plugin-To-Toggle-Bootstrap-Dropdowns-On-Hover/dist/jquery.bootstrap-dropdown-hover.min.js"></script>
<script src="vendor/ckeditor/ckeditor.js"></script>
<script src="vendor/gig/js/gijgo.min.js"></script>

<script>
   CKEDITOR.replace('postii-data');

$(document).ready(function(){

$.fn.modal.Constructor.prototype.enforceFocus = function () {
    modal_this = this
    $(document).on('focusin.modal', function (e) {
        if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length
        // add whatever conditions you need here:
        &&
        !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
            modal_this.$element.focus()
        }
    })
};

});
</script>

<script src="js/code.js"></script>


<script type="text/javascript">

     $('[data-toggle="dropdown"]').bootstrapDropdownHover();      
    
    $("select").selectBoxIt({

        autoWidth: false

    });

    // $("#example").dataTable();

     $(document).ready(function() {
         $('#example').DataTable();

     });

//    $("#image").fileinput();
    
    $("#image").fileinput({
        theme: 'fa',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        overwriteInitial: false,
        maxFileSize: 20000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });



</script>


<script type="text/javascript">
        $(document).ready(function () {
            $("#textarea").editor();
        });
    </script>


</body>

</html>
