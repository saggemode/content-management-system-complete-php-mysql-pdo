<footer>
    <div class="container">
        &copy;copyright by <a href="#"> class 1 </a> <span class=""> 2011 - <?php echo date('Y')?> </span>
    </div>
</footer>
<script src="vendor/jquery-3/jquery-3.3.1.js"></script>
<script src="vendor/jQuery-Validation-Engine-For-Bootstrap/validator.js"></script>
<script src="vendor/Form-Validation-Plugin-Bootstrap-4-vindicate/js/vindicate.js"></script>
<script src="vendor/popper.js/popper.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/jQuery-Plugin-To-Toggle-Bootstrap-Dropdowns-On-Hover/dist/jquery.bootstrap-dropdown-hover.min.js"></script>
<script src="vendor/jQuery-Plugin-For-Auto-Hiding-Bootstrap-Navbar/dist/jquery.bootstrap-autohidingnavbar.min.js"></script>



<script type="text/javascript">
    $('[data-toggle="dropdown"]').bootstrapDropdownHover();

</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $("#newsletter_form").slideDown();
    });

    function close_form() {
        $("#newsletter_form").slideUp();
    }

</script>

<script>
    $(document).ready(function () {

        new Validation('#form', {
            fields: [
                {
                    name: 'sender_name',
                    rule: {
                        type: 'required',
                        prompt: 'Please type in any value'
                    }
                }, {
                    name: 'text2',
                    rule: {
                        type: 'email',
                        prompt: 'Please enter a valid email address'
                    }
                }, {
                    name: 'text3',
                    rule: {
                        type: 'minLength:5',
                        prompt: 'Enter at least 5 characters'
                    }
                }, {
                    name: 'text4',
                    rule: {
                        type: 'maxLength:5',
                        prompt: 'You cannot enter more than 5 characters'
                    }
                }, {
                    name: 'text5',
                    rule: {
                        type: 'regex:^test5$',
                        prompt: 'This field does not match the regular expression'
                    }
                }, {
                    name: 'text6',
                    rule: {
                        type: 'required',
                        prompt: 'Field6 is disabled'
                    }
                }, {
                    name: 'text7',
                    rule: {
                        type: 'checked',
                        prompt: 'Any checkbox needs to be checked'
                    }
                }, {
                    name: 'text8',
                    rule: {
                        type: 'checked',
                        prompt: 'One radio needs to be checked'
                    }
                }, {
                    name: 'text9',
                    rule: {
                        type: 'required',
                        prompt: 'Select one field'
                    }
                }, {
                    name: 'text10',
                    rule: {
                        type: 'date',
                        prompt: 'Please enter a valid date format'
                    }
                }
            ],
            submitOnValid: false,
            showErrorMessage: true,
            errorMessageText: "jQueryScript.Net: Invalid Form",
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

<script>
$("nav.fixed-top").autoHidingNavbar({
    disableAutohide: false,
    showOnUpscroll: true,
    showOnBottom: true,
    hideOffset: 'auto',
    animationDuration: 200
    
});

</script>


</body>

</html>
