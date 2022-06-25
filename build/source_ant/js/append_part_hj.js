var jq_append = $.noConflict(true);
jq_append(document).ready(function() {
	var count = 0;
	var site_url = document.getElementById("site_url_x").value;
	var kode_barang = jq_append('#kode_barang');
	var part_number = jq_append('#part_number');
	var nama_barang = jq_append('#nama_barang');
	var qty_barang = jq_append('#qty');
	 var satuan = jq_append('#satuan');

	//var tot_harga= 0;
	//var hj_barang = jq_append('#hj');


	jq_append("#add_btn_item").click(function(){
	  //tot_harga=kode_barang[0].value;
	  //alert(tot_harga);
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
					+ '<input class="form-control col-md-7 col-xs-12" style="width:100%; text-align:left" type="text" value="'+ count +'" readonly />'
				+ '</td>'
				+ '<td>'
					+ '<input class="form-control col-md-7 col-xs-12" style="width:100%" id="kode_barang_' + count + '" name="kode_barang_' + count + '" type="text" value="'+ kode_barang[0].value +'" readonly />'
				+ '</td>'

				+ '<td>'
					+ '<input class="form-control col-md-7 col-xs-12" style="width:100%" id="part_number_' + count + '" name="part_number_' + count + '" type="text" value="'+ part_number[0].value +'" readonly />'
				+ '</td>'

				+ '<td>'
					+ '<input class="form-control col-md-7 col-xs-12" style="width:100%" id="nama_barang_' + count + '" name="nama_barang_' + count + '" type="text" value="'+ nama_barang[0].value +'" readonly  />'
				+ '</td>'

			 	+ '<td>'
				+ '<span class="nilaiQty" hidden>'+ qty_barang[0].value +'</span>'
				+ '<input class="form-control col-md-7 col-xs-12" style="width:100%; text-align:center" id="qty_' + count + '" name="qty_' + count + '" type="number" value="'+ qty_barang[0].value +'" onchange="recounter();" onblur="recounter();" />'
				+ '</td>'

			 + '<td>'
			 + '<input class="form-control col-md-7 col-xs-12" style="width:100%; text-align:center" id="satuan_' + count + '" name="satuan_' + count + '" type="text" value="'+ satuan[0].value +'" />'
			 + '</td>'

				//+ '<td>'
				//+ '<span class="nilaiTotal" hidden>'+ tot_harga +'</span>'
				//+ '<input class="form-control col-md-7 col-xs-12" style="width:100%; text-align:right" id="total_' + count + '" name="total_' + count + '" type="number" value="'+ tot_harga +'" readonly />'
				//+ '</td>'


				+ '<td align="center">'
					+ '<input id="rows_' + count + '" name="rowsBM[]" value="'+ count +'" class="form-control col-md-1 col-xs-12" type="hidden" />'
					+ ' <a class="remove_item" href="#" >'
						+ '<img src="' + site_url + 'build/source_ant/picture/table_delete.png" width="16" height="16" />'
					+ '</a>'
				+ '</td>'
			+ '</tr>'
		);

		document.getElementById('filterbarang').value='';
		document.getElementById('kode_barang').value='';
		document.getElementById('part_number').value='';
		document.getElementById('nama_barang').value='';
		document.getElementById('qty').value='';
		//document.getElementById('nominal_x').value='';
		//document.getElementById('hj').value='';
//jum_akhir();
	});



	jq_append(".remove_item").live('click', function (ev) {
    	if (ev.type == 'click') {
	    	//alert("aa");
			jq_append(this).parents(".records").fadeOut();
	        jq_append(this).parents(".records").remove();

			//reset count
			count = count - 1;

			//sum_now();
			jum_akhir();
        }
	});
});
