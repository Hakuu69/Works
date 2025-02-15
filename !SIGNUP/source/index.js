window.addEventListener('load', function () {
    $("#upload").change(function(event) {
        var x = URL.createObjectURL(event.target.files[0]);
        $("#useruploaded").attr('src', x);
        console.log(event);
    });
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


}, false);