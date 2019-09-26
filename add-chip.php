<?php include('session.php'); ?>
<?php include 'public/menubar.php'; ?>

    <script src="assets/js/ckeditor/ckeditor.js"></script>
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>

    <script type="text/javascript">

        (function($,W,D) {
            var JQUERY4U = {};
            JQUERY4U.UTIL = {
                setupFormValidation: function() {
                    //form validation rules
                    $("#form-validation").validate({
                        rules: {
                            numero		: "required",
                            iccid 		: "required"
                        },

                        messages: {
                            numero 		: "Por favor, insira o Número do Chip!",
                            iccid 		: "Por favor, insira o ICCID do Chip!"

                        },
                        errorElement : 'div',
                        submitHandler: function(form) {
                            form.submit();
                        }

                    });
                }
            }

            //when the dom has loaded setup form validation rules
            $(D).ready(function($) {
                JQUERY4U.UTIL.setupFormValidation();
            });

        })(jQuery, window, document);

    </script>

<?php include 'public/add-chip-form.php'; ?>
<?php include('public/footer.php'); ?>