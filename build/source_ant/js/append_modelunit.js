var jq_append = $.noConflict(true);
jq_append(document).ready(function() {
	var count = 0;
	var site_url = document.getElementById("site_url_x").value;
	var id_model_unitz = jq_append('#id_model_unit');
 


	jq_append("#add_btn_item").click(function(){
		//alert(count);
		if(count >= document.getElementById('key_max').value){
			count = count;
		} else {
			count = parseInt(document.getElementById('key_max').value);
		}

		count = count + 1;

		jq_append('#containeritem').append(
			'<tr class="records">'
				+ '<td align="center">'
					+ '<div id="'+count+'">' + count + '</div>'
					+ '<input style="width:100%; text-align:left" type="text" value="'+ count +'" readonly hidden />'
					 				
			    + '</td>'
				+ '<td>'
					+ '<input class="form-control col-md-2 col-xs-12" style="width:100%" id="id_model_unitz_' + count + '" name="id_model_unitz_' + count + '" type="text" value="'+ id_model_unitz[0].value +'" readonly />'
				+ '</td>'

				 
				+ '<td align="center">'
					+ '<input id="rows_' + count + '" name="rowsBM[]" value="'+ count +'" type="hidden" />'
					+ ' <a class="remove_item" href="#" >'
						+ '<img src="' + site_url + 'build/source_ant/picture/table_delete.png" width="16" height="16" />'
					+ '</a>'
				+ '</td>'
			+ '</tr>'
		);

		//document.getElementById('filterbarang').value='';
		document.getElementById('id_model_unit').value='';
		document.getElementById('id_model_unitx').value='';
		//document.getElementById('nominal_x').value='';
		//document.getElementById('nilai').value='';

	});



	jq_append(".remove_item").live('click', function (ev) {
    	if (ev.type == 'click') {
	    	//alert("aa");
			jq_append(this).parents(".records").fadeOut();
	        jq_append(this).parents(".records").remove();

			//reset count
			count = count - 1;

			sum_now();
			jum_akhir();
        }
	});
});
