$(document).ready(function () {
	filterSearch();
	$('.productDetail').click(function () {
		filterSearch();
	});
	$('#priceSlider').slider({
	}).on('change', priceRange);
});
function priceRange(e) {
	$('.priceRange').html("£" + $(this).val() + " - £999");
	$('#minPrice').val($(this).val());
	filterSearch();
}
function filterSearch() {
	$('.searchResult').html('<div id="loading">Loading .....</div>');
	var actionnn = 'fetch_data';

	var priceRange = [],
		priceRangeSelection = $("#priceRangeSelector input:checkbox:checked").map(function () {
			temp = $(this).val().split('-')
			priceRange.push(temp[0]);
			priceRange.push(temp[1]);
			return $(this).val();
		}).get();

	var aa = $('#aa').val();

	var minPrice = priceRange.length ? Math.min.apply(null, priceRange) : 0;
	var maxPrice = priceRange.length ? Math.max.apply(null, priceRange) : 9999;
	var maincat = getFilterData('maincat');

	var color = getFilterData('color');
	var categoryid = getFilterData('categoryid');
	var material = getFilterData('material');
	$.ajax({
		url: "actionnn.php",
		method: "POST",
		dataType: "json",
		data: { actionnn: actionnn, aa: aa, minPrice: String(minPrice), maxPrice: String(maxPrice), maincat: maincat, color: color, categoryid: categoryid},
		success: function (data) {
			$('.searchResult').html(data.html);
		}
	});
}
function getFilterData(className) {
	var filter = [];
	$('.' + className + ':checked').each(function () {
		filter.push($(this).val());
	});
	return filter;
}