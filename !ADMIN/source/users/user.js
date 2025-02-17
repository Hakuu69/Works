$ (function() {



    // Disable clicking of the user maintenance in navigation

    $("#u-button").prop('disabled', true);



    // Hide product maintenance links

    $("#p-maintenance a").hide();



    // Toggle show and hide of product maintenance links

    $("#p-button").on('click', function() {

        $("#p-maintenance a").toggle("fast");

    });



    // Show current date and time

    var datetime = dayjs().format('MMMM D, YYYY h:mm a');

    $("#datetime").append(datetime);



    // Disable the update and delete button

    $("#updateuser").prop('disabled', true);

    $("#deleteuser").prop('disabled', true);



    // Behavior when select element changes

    $("#selectedEdit").change(function() {

        fetchprod();

    });



    // Function to fetch user information

    function fetchprod() {

        var user = $("#selectedEdit").val();

        $("#updateuser").prop('disabled', false);

        $("#deleteuser").prop('disabled', false);



        $.ajax({

            url: 'fetch.php',

            method: 'POST',

            data: {

                email: user

            },

            dataType: 'JSON',

            success: function(data) {

                $("#fname").val(data.firstname);

                $("#mname").val(data.middlename);

                $("#lname").val(data.lastname);

                $("#bdate").val(data.birthdate);

                $("#email").val(data.email);

                $("#contact").val(data.contact);

                $("#password").val(data.password);

                $("#role").val(data.role).change();

                $("#useruploaded").attr('src', data.image);

            }

        })

    };



    // Behavior when form is submitted

    $("#user").on('submit', function() {



        var formData = new FormData(this);

        var user = $("#selectedEdit").val();

        formData.append("user", user);



        $.ajax({

            url: 'update.php',

            type: 'POST',

            data: formData,

            success: function() {

                alert("User information successfully updated.");

            },

            cache: false,

            contentType: false,

            processData: false

        });

    });



    // Behavior when delete button is clicked

    $("#deleteuser").on('click', function() {

        

        if(!confirm("Are you sure you want to delete this user?")) {

            e.preventDefault();

            return false;

        }



        deleteDetails();

    });



    // Function to delete user

    function deleteDetails() {

        var user = $("#selectedEdit").val();



        $.ajax({

            url: 'delete.php',

            method: 'POST',

            data: {

                email: user

            },

            success: function() {

                window.location.href = "edituser.php";

            }

        })

    }

})



window.addEventListener('load', function() {



    'use strict';



    // Form validation

    // Fetch all the forms we want to apply custom Bootstrap validation styles to

    var forms = document.getElementsByClassName('needs-validation');

        

    // Loop over them and prevent submission

    Array.prototype.filter.call(forms, function (form) {

    

        form.addEventListener('submit', function (event) {



            if (form.checkValidity() === false) {

                event.preventDefault();

                event.stopPropagation();

            }

        

            form.classList.add('was-validated');

        }, false);

    });



    $("#upload").change(function(event) {

        var x = URL.createObjectURL(event.target.files[0]);

        $("#useruploaded").attr('src', x);

        console.log(event);

    });

}, false);