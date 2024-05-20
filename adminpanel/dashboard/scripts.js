$(document).ready(function () {
    // Όταν ανοίγει το modal για ενημέρωση
    $("#updateFlightModal").on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        $.ajax({
            type: "POST",
            url: "get_flight_details.php",
            data: { id: id },
            success: function (data) {
                console.log(data); // Προσθήκη ελέγχου δεδομένων
                var flight = JSON.parse(data);
                $("#updateFlightId").val(flight.id);
                $("#updateFlightForm #flightNum").val(flight.FLIGHTNUM);
                $("#updateFlightForm #airline_name").val(flight.AIRLINE_NAME);
                $("#updateFlightForm #origin").val(flight.ORIGIN);
                $("#updateFlightForm #destination").val(flight.DEST);
                $("#updateFlightForm #date").val(flight.DATE);
                $("#updateFlightForm #arrTime").val(flight.ARR_TIME);
                $("#updateFlightForm #depTime").val(flight.DEP_TIME);
                $("#updateFlightForm #price").val(flight.PRICE);
                $("#updateFlightForm #airplane_id").val(flight.AIRPLANE_ID);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Υποβολή της φόρμας ενημέρωσης
    $("#updateFlightForm").submit(function (event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        console.log(...formData); // Προσθήκη ελέγχου δεδομένων
        $.ajax({
            type: "POST",
            url: "update_flight.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#updateFlightModal').modal('hide');
                alert('Flight updated successfully.');
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
