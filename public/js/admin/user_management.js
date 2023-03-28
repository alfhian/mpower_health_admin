$('#user_management_table').DataTable({
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

$('#user_management_table tbody').on('click','input:checkbox', function (e) {
    e.preventDefault()
    form = $(this).parent().parent().attr('id')
    if($(this).is(':checked')) {
        msg = 'activate'
    } else {
        msg = 'deactivate'
    }

    showOption(form, msg)
})