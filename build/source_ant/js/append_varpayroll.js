var jq_append = $.noConflict(true);
jq_append(document).ready(function() {
	var count = 0;
	var site_url = document.getElementById("site_url_x").value;
	var pm = jq_append('#pm');
	var nama_akun = jq_append('#nama_akun');
	//var qty_barang = jq_append('#id_var_pay');
	var nama_content = jq_append('#nama_content');
	var id_var_pay = jq_append('#id_var_pay');


	jq_append("#add_btn_item").click(function(){
		 //alert(kode_barang);
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
					+ '<input class="form-control col-md-2 col-xs-12" style="width:100%" id="pm_' + count + '" name="pm_' + count + '" type="text" value="'+ pm[0].value +'" readonly />'
				+ '</td>'

				+ '<td>'
					+ '<input class="form-control col-md-2 col-xs-12" style="width:100%" id="nama_content_' + count + '" name="nama_content_' + count + '" type="text" value="'+ nama_content[0].value +'" readonly />'
					
					+ '<input id="id_var_pay_' + count + '" name="id_var_pay_' + count + '" type="text" value="'+ id_var_pay[0].value +'" readonly hidden />'
				+ '</td>'

			 	+ '<td>'
				 
				+ '<input class="form-control col-md-2 col-xs-12" style="width:100%" id="nama_akun_' + count + '" name="nama_akun_' + count + '" type="text" value="'+ nama_akun[0].value +'" readonly />'
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
		document.getElementById('id_var_payroll').value='';
		document.getElementById('id_var_pay').value='';
		document.getElementById('nama_akun').value='';
		document.getElementById('pm').value='';
		document.getElementById('nama_content').value='';
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
