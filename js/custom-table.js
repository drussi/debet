$(function () {
    $('#arr_down').hide();
    $('#dt0').dataTable({
        "sPaginationType": "full_numbers",
        "iDisplayLength": -1,
		"bInfo": true,
		"aLengthMenu": [ [-1, 3, 10, 25, 50, 100  ],[ "Все", 3, 10, 25, 50, 100 ]],
        "oLanguage": {
            "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Строк на странице:</span>",
			"sSearch": "Быстрый фильтр:",
			"sInfo": "Всего найдено _TOTAL_ записей. Показано с _START_ по _END_"
        },
     // "sDom": '<"table_top clearfix"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>',
	    "sDom": '<"tbl-tools-searchbox"fil<"clear">>,<"tbl_tools"CT<"clear">>,<"table_content"t>,<"widget-bottom"p<"clear">>',
 
        "oTableTools": {
            "sSwfPath": "swf/copy_cvs_xls_pdf.swf"
        },
         "aoColumnDefs": [
             { 'bSortable': false, "aTargets": [7]}
		//	 { "bSearchable": false, "aTargets": [0]}
         ]
    });
    $("#dt0_length select").addClass('tbl_length');
	//$('#dt0').draw();
});
