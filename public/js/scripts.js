//Data table
$('.dataTable').DataTable( {
	responsive: true,
	language: {
		paginate: {
			previous: "&laquo;",
			next: "&raquo;"
		},
		search: "_INPUT_",
		searchPlaceholder: "Search…"
	}
});

//Select 2
$('.select').select2();

//Tooltip
$('[tooltip]').tooltip();

//Time Picker
$(".timepicker").timepicker();

//Date Picker
$.fn.datepicker.defaults.format = "dd/mm/yyyy";