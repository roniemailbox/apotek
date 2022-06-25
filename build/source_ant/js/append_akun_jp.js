var jq_append = $.noConflict(true);
jq_append(document).ready(function() {
	var count = 0;
	var site_url = document.getElementById("site_url_x").value;
	var kode_akun = jq_append('#kode_akun');
	var nama_akun = jq_append('#nama_akun');
	var keterangan_akun = jq_append('#keterangan');
	//var jenis_ax = jq_append('#dk');

	jq_append("#add_btn_bm").click(function(){
		//alert(count);
		if(count >= document.getElementById('key_max').value){
			count = count;
		} else {
			count = parseInt(document.getElementById('key_max').value);
		}

		var element = document.getElementById("dk");
    	var op = element.options[element.selectedIndex].value;
		//alert(op);

		count = count + 1;
		if (op == "DEBET"){
			var nilai_debet = jq_append('#nominal');
			var nilai_kredit = jq_append('#nominal_x');
		} else {
			var nilai_debet = jq_append('#nominal_x');
			var nilai_kredit = jq_append('#nominal');
		}

		jq_append('#containerBM').append(
			'	<tr class="records" style="background-color:#B0B0AD; color:white;">'
				+ '<td align="center">'
					+ '<div hidden id="'+count+'">' + count + '</div>'
					+ '<input class="form-control col-md-2 col-xs-12" style="width:100%; text-align:left" type="text" value="'+ count +'" readonly />'
				+ '</td>'
				+ '<td>'
					+ '<input class="form-control col-md-2 col-xs-12" style="width:100%" id="nama_akun_' + count + '" name="nama_akun_' + count + '" type="text" value="'+ nama_akun[0].value +'" readonly />'
				+ '</td>'
				+ '<td>'
					+ '<input class="form-control col-md-2 col-xs-12" style="width:100%" id="x_kode_akun_' + count + '" name="x_kode_akun_' + count + '" type="text" value="'+ kode_akun[0].value +'" readonly />'
				+ '</td>'
				+ '<td>'
					+ '<input class="form-control col-md-2 col-xs-12" style="width:100%" id="keterangan_' + count + '" name="keterangan_' + count + '" type="text" value="'+ keterangan_akun[0].value +'"   />'
				+ '</td>'
				+ '<td>'
					+ '<span class="nilaiD" hidden>'+ nilai_debet[0].value +'</span>'
					+ '<input class="form-control col-md-2 col-xs-12" style="width:100%; text-align:right" id="nilai_debet_' + count + '" name="nilai_debet_' + count + '" type="text" value="'+ nilai_debet[0].value +'" readonly />'
				+ '</td>'
				+ '<td>'
					+ '<span class="nilaiK" hidden>'+ nilai_kredit[0].value +'</span>'
					+ '<input class="form-control col-md-2 col-xs-12" style="width:100%; text-align:right" id="nilai_kredit_' + count + '" name="nilai_kredit_' + count + '" type="text" value="'+ nilai_kredit[0].value +'" readonly />'
				+ '</td>'
				+ '<td align="center">'
					+ '<input id="rows_' + count + '" name="rowsBM[]" value="'+ count +'" type="hidden" />'
					+ ' <a class="remove_item" href="#" >'
						+ '<img src="' + site_url + 'build/source_ant/picture/table_delete.png" width="16" height="16" />'
					+ '</a>'
				+ '</td>'
			+ '</tr>'
		);

		document.getElementById('filterakun').value='';
		document.getElementById('kode_akun').value='';
		document.getElementById('nama_akun').value='';
		document.getElementById('nominal').value='';
		document.getElementById('nominal_x').value='';
		document.getElementById('nilai').value='';

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
