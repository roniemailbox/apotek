var jq_append = $.noConflict(true);
jq_append(document).ready(function() {
	var count = 0;
	var site_url = document.getElementById("site_url_x").value;
  var id_barang = jq_append('#id_barang');
	var nama_barang = jq_append('#nama_barang');
	var satuan = jq_append('#satuan');


	jq_append("#add_btn_item").click(function(){
	  x=id_barang[0].value;
		//y=qty_barang[0].value;
		//alert(x);

	  //alert(satuan);


		//recounter();
if (x =='') {
	alert("Item Barang Kosong.......");
}
else  {
	count = count + 1;
	if(count >= document.getElementById('key_max').value){
		count = count;
	} else {
		count = parseInt(document.getElementById('key_max').value);
	}

	document.getElementById('key_max').value=count;

	jq_append('#containeritem').append(
		'<tr class="records">'
			+ '<td align="center">'
				+ '<div hidden id="'+count+'">' + count + '</div>'
				+ '<input class="form-control" style="width:100%; text-align:left" name="no_row_' + count + '" type="text" value="'+ count +'"   readonly />'
			+ '</td>'
			+ '<td>'
			+ '	<input name="id_barang_ro_' + count + '" type="hidden" id="id_barang_ro_' + count + '" class="form-control col-xs-4" value="'+ id_barang[0].value +'"  placeholder="id_barang">'
			+ '	<input name="nama_barang_ro_' + count + '" type="text" id="nama_barang_ro_' + count + '" class="form-control col-xs-6" value="'+ nama_barang[0].value +'"  placeholder="Nama Obat" readonly>'
			+ ' </td>'
			+ '<td>  <input name="qty_ro_' + count + '" type="number" id="qty_ro_' + count + '" class="form-control col-xs-2"  placeholder="Qty"></td>'
			+ '<td>  <input name="satuan_ro_' + count + '" type="text" id="satuan_ro_' + count + '" class="form-control col-xs-2" value="'+ satuan[0].value +'"  placeholder="Satuan"></td>'
			+ '<td>  <input name="keterangan_ro_' + count + '" type="text" id="keterangan_ro_' + count + '" class="form-control col-xs-4"  placeholder="Keterangan"></td>'
			+ '<td align="center">'
					+ '<input id="rows_' + count + '" name="rowsBM[]" value="'+ count +'" class="form-control col-md-1 col-xs-12" type="hidden" />'
					+ ' <a class="remove_item" href="#" >'
						+ '<img src="' + site_url + 'assets/picture/table_delete.png" width="16" height="16" />'
					+ '</a>'
			+ '</td>'
		+ '</tr>'



	);

}


		LPS();
		//recounter();
		document.getElementById('searchbarcode').value='';
		document.getElementById('id_barang').value='';
		//document.getElementById('barcode').value='';
		//document.getElementById('nama_barang').value='';
		//document.getElementById('qty').value='1';
		//document.getElementById('perc_diskon').value='0';
		//document.getElementById('itemppn').value='0';
	  document.getElementById('satuan').value='';
		//document.getElementById('nominal_x').value='';
		//document.getElementById('hj').value='';
		//jum_akhir();
		//document.getElementById('key_max').value=count;

	});


	//alert(count);

	jq_append(".remove_item").live('click', function (ev) {
     	if (ev.type == 'click') {
 	   	jq_append(this).parents(".records").fadeOut();
 	    jq_append(this).parents(".records").remove();
 			count = count - 1;
 			//jum_akhir();
 			//recounter();
      }

 	    });
	//recounter();
});
