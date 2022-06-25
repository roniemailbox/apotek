
var jq_append = $.noConflict(true);
jq_append(document).ready(function() {
	var count = 0;
	var site_url = document.getElementById("site_url_x").value;
  var id_barang = jq_append('#id_barang');
	//var id_barang=document.forms["form1"].elements["id_barang"].value;
	var nama_barang = jq_append('#nama_barang');
	var qty_barang = jq_append('#qty');
	var hj_barang = jq_append('#hj');
	var dpp = jq_append('#dpp');
	var nilaippn = jq_append('#nilaippn');
	var itemppn = jq_append('#itemppn');
	var diskon = jq_append('#diskon');
	var perc_diskon = jq_append('#perc_diskon');
	var satuan = jq_append('#satuan');
	var total = jq_append('#total');

	if (document.getElementById('site_url_x') != null) {
	    str = document.getElementById("site_url_x").value;
	}
	jq_append("#add_btn_item").click(function(){
	  var x=id_barang[0];
		var y=qty_barang;
		//alert(str);

	  //alert(satuan);


		//recounter();
if (x =='' || y=='' || y==0) {
	//alert("Item Barang Kosong atau Qty = 0.......");
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
				+ '<input class="form-control" style="width:100%; text-align:left" name="no_row_' + count + '" type="text" value="'+ count +'" readonly />'
			+ '</td>'





			+ '<td>'
			  + '<input class="form-control" style="width:100%" id="id_barang_' + count + '" name="id_barang_' + count + '" type="hidden" value="'+ id_barang[0].value +'" readonly />'
				+ '<input class="form-control" style="width:100%" id="nama_barang_' + count + '" name="nama_barang_' + count + '" type="text" value="'+ nama_barang[0].value +'" readonly />'
			+ '</td>'

			+ '<td>'
				+ '<span class="nilaiQty" hidden>'+ qty_barang[0].value +'</span>'
				+ '<input class="form-control" style="width:100%; text-align:right" id="qty_' + count + '" name="qty_' + count + '" type="number" value="'+ qty_barang[0].value +'" onchange="recounter();" onblur="recounter();" readonly />'
			+ '</td>'
			+ '<td>'
				+ '<input class="form-control" style="width:100%; text-align:right" id="hj_' + count + '" name="hj_' + count + '" type="number" value="'+ hj_barang[0].value +'" onchange="recounter();" onblur="recounter();" readonly />'
			+ '</td>'

			+ '<td>'
				+ '<input class="form-control" style="width:100%; text-align:right" id="dpp_' + count + '" name="dpp_' + count + '" type="number" value="'+ dpp[0].value +'" readonly />'
			+ '</td>'

			+ '<td>'
				+ '<input class="form-control" style="width:100%; text-align:right" id="nilaippn_' + count + '" name="nilaippn_' + count + '" type="number" value="'+ nilaippn[0].value +'" readonly />'
			+ '</td>'

			+ '<td>'
				+ '<input class="form-control" style="width:100%; text-align:right" id="diskon_' + count + '" name="diskon_' + count + '" type="number" value="'+ diskon[0].value +'" readonly />'
			+ '</td>'

			+ '<td>'
				+ '<input class="form-control" style="width:100%; text-align:right" id="perc_diskon_' + count + '" name="perc_diskon_' + count + '" type="number" value="'+ perc_diskon[0].value +'" readonly />'
			+ '</td>'

			+ '<td>'
				+ '<input class="form-control" style="width:100%; text-align:right" id="satuan_' + count + '" name="satuan_' + count + '" type="text" value="'+ satuan[0].value +'" readonly />'
			+ '</td>'

			+ '<td>'
				+ '<input class="form-control" style="width:100%; text-align:right" id="total_' + count + '" name="total_' + count + '" type="number" value="'+ total[0].value +'" readonly />'
			+ '</td>'

			+ '<td align="center">'
					+ '<input id="rows_' + count + '" name="rowsBM[]" value="'+ count +'" class="form-control col-md-1 col-xs-12" type="hidden" />'
					+ ' <a class="remove_item" href="#" >'
						+ '<img src="' + site_url + 'assets/picture/table_delete.png" width="16" height="16" />'
					+ '</a>'
			+ '</td>'
		+ '</tr>'

	);

}


		//LPS();
		//recounter();
		//document.getElementById('searchbarcode').value='';
		//document.getElementById('id_barang').value='';
		//document.getElementById('barcode').value='';
		//document.getElementById('nama_barang').value='';
		//document.getElementById('qty').value='1';
		//document.getElementById('perc_diskon').value='0';
		//document.getElementById('itemppn').value='0';
		//document.getElementById('satuan').value='';
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
 			jum_akhir();
 			recounter();
      }

 	    });
	//recounter();
});
