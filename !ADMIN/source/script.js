$ (function() {



    $("#e-maintenance a").hide();

    $("#w-maintenance a").hide();



    $("#e-button").on('click', function() {

        $("#e-maintenance a").toggle("fast");

    });



    $("#w-button").on('click', function() {

        $("#w-maintenance a").toggle("fast");

    });



    var datetime = dayjs().format('MMMM D, YYYY h:mm a');

    $("#datetime").append(datetime);

});