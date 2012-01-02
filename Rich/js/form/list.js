/**
 * 判斷是否有選取項目。
 */
function isSelected() {
	var isSelected = false;
	$("input[name^='id_list']").each(function() {
		if ($(this).attr('checked')) {
			isSelected = true;
		}
	});
    if (isSelected) {
    	return true;
    } else {
    	alert("至少選擇一項。");
    	return false;
    }
}

/**
 * 判斷只選擇一筆
 */
function isOnlyOneSelected() {
	var count = 0;
	$("input[name^='id_list']").each(function() {
		if ($(this).attr('checked')) {
			count++;
		}
	});
    if (count == 1) {
    	return true;
    } else if (count == 0) {
    	alert("此功能必須選擇一項。");
    	return false;
    } else {
    	alert("此功能只能選擇一項。");
    	return false;
    }
}