var site = {
	
	start: function() {
		$('[rel=external]').attr('target','_blank');
		site.attachDataTable();	
	},
	attachDataTable: function() {
		$('.table-container table').dataTable();
	}
		
	
	
};
$(document).ready( function() {
	site.start();
});