$('#lab_results_table').DataTable({
    pagingType: 'full_numbers',
    "language": {
        "paginate": {
            "first": "&#129172&#129172",
            "previous": "&#129172",
            "last": "&#129174&#129174",
            "next": "&#129174"
        },
    },
    "lengthChange": false,
    "oLanguage": {
        "sSearch": "Search :"
    }
});

function claimLabResult(form) {
    $('#action-text').html('claim')
    $('#optionModal').modal('show')
    $('#option-yes').click(function() {
        $('#'+form).submit();
    })
}

function uploadLabReport(id, labResultNo, ticket) {
    $('#action-text').html('claim')
    $('#uploadLabResultModal').modal('show')
    $('#lab-result-id').val(id)
    $('#lab-result-no').val(labResultNo)
    $('#ticket-no').val(ticket)
}