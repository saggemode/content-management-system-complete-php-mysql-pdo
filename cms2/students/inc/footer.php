<footer>
    &copy;copyright by <a href="#"> class 1 </a> <span class=""> 2011 - <?php echo date('Y'); ?></span>
</footer>
</div>

<script src="vendor/jquery-3/jquery-3.3.1.js"></script>
<script src="vendor/jQuery-Validation-Engine-For-Bootstrap/validator.js"></script>
<script src="vendor/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="vendor/popper.js/popper.min.js"></script>
<script src="vendor/ckeditor/ckeditor.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<script src="vendor/bootstrap-fileinput-master/js/fileinput.min.js"></script>
<script src="vendor/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.js"></script>

<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

<script src="vendor/jquery.selectBoxIt.js/javascripts/jquery.selectBoxIt.min.js"></script>

<script src="js/code.js"></script>


<script type="text/javascript">
    
           
    
    $("select").selectBoxIt({

        autoWidth: false

    });

    $("#example").dataTable();

//    $("#image").fileinput();
    
    $("#image").fileinput({
        theme: 'fa',
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif','bmp'],
        overwriteInitial: false,
        maxFileSize: 20000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
    
 CKEDITOR.replace("post-data");

</script>


<script>
    $(document).ready(function () {

        new Validation('#form', {
            fields: [
                {
                    name: 'name',
                    rule: {
                        type: 'required',
                        prompt: 'Please type in any value'
                    }
                }, {
                    name: 'email',
                    rule: {
                        type: 'email',
                        prompt: 'Please enter a valid email address'
                    }
                }, {
                    name: 'phone',
                    rule: {
                        type: 'maxLength:11',
                        prompt: 'Make sure the number is 11 and valid'
                    }
                }, {
                    name: 'password',
                    rule: {
                        type: 'maxLength:8',
                        prompt: 'please enter your password 8 characters'
                    }
                }, {
                    name: 'reg_number',
                    rule: {
                        type: 'required',
                        prompt: 'please enter your reg number'
                    }
                }, {
                    name: 'level',
                    rule: {
                        type: 'required',
                        prompt: 'Select your level'
                    }
                }, {
                    name: 'gender',
                    rule: {
                        type: 'required',
                        prompt: 'Select your gender'
                    }
                }, {
                    name: 'program',
                    rule: {
                        type: 'required',
                        prompt: 'Select your program'
                    }
                }, {
                    name: 'dob',
                    rule: {
                        type: 'date',
                        prompt: 'Please enter a valid date format'
                    }
                }
            ],
            submitOnValid: false,
            showErrorMessage: true,
            errorMessageText: "please fill all the fields thank you",
            errorGroupClass: "has-error has-feedback",
            successGroupClass: "has-success has-feedback"
        });

        $('#form')
            .on('is-valid', function (e) {
                console.log('valid');
            })
            .on('is-invalid', function (e) {
                console.log('invalid');
            });

    });
</script>



</body>

</html>
