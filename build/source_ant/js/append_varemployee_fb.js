var jq_append = $.noConflict(true);
jq_append(document).ready(function() {
	var count = 0;
	var site_url = document.getElementById("site_url_x").value;
	var id_pegawai= jq_append('#id_pegawai');
	var nama = jq_append('#nama');
	//var qty_barang = jq_append('#id_var_pay');
	var posisi = jq_append('#posisi');


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
					+ '<input style="width:100%; text-align:left" name="no_urut_' + count + '"  type="text" value="'+ count +'" readonly/>'

			    + '</td>'
				+ '<td>'
					+ '<input class="form-control col-md-2 col-xs-12" style="width:100%" id="id_pegawai_' + count + '" name="id_pegawai_' + count + '" type="text" value="'+ id_pegawai[0].value +'" readonly />'
				+ '</td>'

				+ '<td>'
					+ '<input class="form-control col-md-2 col-xs-12" style="width:100%" id="nama_' + count + '" name="nama_' + count + '" type="text" value="'+ nama[0].value +'" readonly />'


				+ '</td>'


			 	+ '<td>'

				+ '<input class="form-control col-md-2 col-xs-12" style="width:100%" id="posisi_' + count + '" name="posisi_' + count + '" type="text" value="'+ posisi[0].value +'" readonly />'
				+ '</td>'


				+ '<td>'
				+ '	<input class="form-control col-md-2 col-xs-12" style="width:100%" id="jml_hari_' + count + '" name="jml_hari_' + count + '" type="number" value="1"  onchange="recounter();" onblur="recounter();" readonly />'
				+ '</td>'
				+ '<td>'
				+ '	<input class="form-control col-md-2 col-xs-12" style="width:100%" id="nilai_bonus_' + count + '" name="nilai_bonus_' + count + '" type="number"  onchange="recounter();" onblur="recounter();" />'
				+ '</td>'
				+ '<td>'
				+ '	<input class="form-control col-md-2 col-xs-12" style="width:100%; text-align:right;" id="totalb_' + count + '" name="totalb_' + count + '" type="text"  onchange="recounter();" onblur="recounter();" readonly/>'
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
		document.getElementById('filterkaryawan').value='';
		document.getElementById('id_pegawai').value='';
		document.getElementById('nama').value='';
	//	document.getElementById('pm').value='';
		//document.getElementById('nama_content').value='';
		//document.getElementById('nominal_x').value='';
		//document.getElementById('nilai').value='';
		document.getElementById('key_max').value = parseInt(count);
	});



	jq_append(".remove_item").live('click', function (ev) {
    	if (ev.type == 'click') {
	     //alert(count);
			jq_append(this).parents(".records").fadeOut();
	    jq_append(this).parents(".records").remove();

			//reset count
			count = count - 1;

			//sum_now();
			//recounter();
			jum_akhir();
			recounter();
        }
	});
});
