var jq_append = $.noConflict(true);
jq_append(document).ready(function() {
	var count = 0;
	var site_url = document.getElementById("site_url_x").value;
	var kode_barang = jq_append('#kode_barang');
	var nama_barang = jq_append('#nama_barang');
	var qty_barang = jq_append('#qty');


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
					+ '<div hidden id="'+count+'">' + count + '</div>'
					+ '<input style="width:100%; text-align:left" type="text" value="'+ count +'" readonly />'
				+ '</td>'
				+ '<td>'
					+ '<input style="width:100%" id="kode_barang_' + count + '" name="kode_barang_' + count + '" type="text" value="'+ kode_barang[0].value +'" readonly />'
				+ '</td>'

				+ '<td>'
					+ '<input style="width:100%" id="nama_barang_' + count + '" name="nama_barang_' + count + '" type="text" value="'+ nama_barang[0].value +'" readonly />'
				+ '</td>'

			 	+ '<td>'
				+ '<span class="nilaiQty" hidden>'+ qty_barang[0].value +'</span>'
				+ '<input style="width:100%" id="qty_' + count + '" name="qty_' + count + '" type="text" value="'+ qty_barang[0].value +'" readonly />'
				+ '</td>'
				+ '<td align="center">'
					+ '<input id="rows_' + count + '" name="rowsBM[]" value="'+ count +'" type="hidden" />'
					+ ' <a class="remove_item" href="#" >'
						+ '<img src="' + site_url + 'build/source_ant/picture/table_delete.png" width="16" height="16" />'
					+ '</a>'
				+ '</td>'
			+ '</tr>'
		);

		document.getElementById('filterbarang').value='';
		document.getElementById('kode_barang').value='';
		document.getElementById('nama_barang').value='';
		document.getElementById('qty').value='';
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
