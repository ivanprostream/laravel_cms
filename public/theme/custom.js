

/* sortble */

if ($("#sort-input").length) {

  var sort = $('#sort-input').val();

  $('table tbody').sortable({
    handle: 'td:first',
      update: function(e, ui){
      var newOrder = $(this).sortable("serialize");
      $.ajax({
        url: BASE_URL + sort,
        method: "POST",
        data: { sort: newOrder, method: "PUT", _token: $("meta[name='csrf_token']").attr("content") }
      });
    }
  });
}



$('#task_table').DataTable({
   "paging": false,
   "searching": true,
   "responsive": true,
   "autoWidth": false,
   "ordering": true,
   "info": true,
   "bSort": true,
   "language": {
    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
    },
});

$('#user_table').DataTable({
   "paging": false,
   "searching": true,
   "responsive": true,
   "autoWidth": false,
   "ordering": true,
   "info": true,
   "bSort": true,
   "language": {
    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
    },
});


$('#messages_table').DataTable({
   "order": [[ 0, "desc" ]],
   "paging": false,
   "searching": true,
   "responsive": true,
   "autoWidth": false,
   "ordering": true,
   "info": true,
   "bSort": true,
   "language": {
    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
    },
});

$('#task_notification_table').DataTable({
   "paging": false,
   "searching": true,
   "responsive": true,
   "autoWidth": false,
   "ordering": true,
   "info": true,
   "bSort": true,
   "language": {
    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
    },
});

$('#task_notification_table_2').DataTable({
   "paging": false,
   "searching": true,
   "responsive": true,
   "autoWidth": false,
   "ordering": true,
   "info": true,
   "bSort": true,
   "language": {
    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
    },
});

$('#own_tasks_table').DataTable({
   "paging": false,
   "searching": true,
   "responsive": true,
   "autoWidth": false,
   "ordering": true,
   "info": true,
   "bSort": true,
   "language": {
    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
    },
});



