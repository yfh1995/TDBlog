function throll(fn, delay) {
	var timer = null;
	return function() {
		clearTimeout(timer);
		timer = setTimeout(fn, delay);
	}
}

function checkEmail(str) {
	var regex = /^([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)$/g;
	if(regex.test(str)) {
		return true;
	} else {
		return false;
	}
}