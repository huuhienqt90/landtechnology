
function showProducts(minPrice, maxPrice) {
	$(".product-item").hide().filter(function() {
		var minprice = parseInt($(this).data("minprice"));
		var price = parseInt($(this).data("price"));
		if( minprice > 0){
			return minprice <= maxPrice && price >= minPrice;
		}else{
			return price >= minPrice && price <= maxPrice;
		}
	}).show();
}

$(function() {
	var globalMin = parseInt($('input[name="priceMin"]').val());
	var globalMax = parseInt($('input[name="priceMax"]').val());
	var options = {
		range: true,
		min: globalMin,
		max: globalMax,
		values: [globalMin, globalMax],
		slide: function(event, ui) {
			var min = ui.values[0], max = ui.values[1];

			$(".price-min").text("$" + min );
			$(".price-max").text("$" + max );
			showProducts(min, max);
		}
	}, min, max;

	$("#slider-range").slider(options);
	$(".price-min").text("$" + globalMin );
	$(".price-max").text("$" + globalMax );
	showProducts(globalMin, globalMax);
});
