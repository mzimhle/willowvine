var hometabAutoToggle = new Array();

function hometab(idName,amountTotal,amountCurrent,autoRotatorTimer) {
	// Check for content
	if (idName != null && amountTotal != null && amountCurrent != null) {
		// Check data type
		if (!isNaN (amountTotal) && !isNaN (amountCurrent)) {
			amountTotal = parseInt(amountTotal);
			amountCurrent = parseInt(amountCurrent);
			// Check for at least one total amount
			if (amountTotal > 0 && idName != '') {
				// Check the the current selected tab is in the valid range
				if (amountCurrent < 1 || amountCurrent > amountTotal) amountCurrent = 1;
				var obj = null;
				var objTab = null;

				// Loop through the tabs and toggle their display status
				for (var i = 1; i <= amountTotal; i++) {
					obj = document.getElementById(idName + i);
					objTab = document.getElementById('tab' + i);
					if (obj != null) {
						if (i != amountCurrent) {
							obj.style.display = 'none';
						} else {
							obj.style.display = 'block';
						}
					}
					if (objTab != null) {
						if (amountCurrent == i) {
							if (i == 1) objTab.className = '';
							if (i == 2) objTab.className = 'select_active';
							if (i == 3) objTab.className = 'fnb_active';
						} else {
							if (i == 1) objTab.className = 'inactive';
							if (i == 2) objTab.className = 'select_inactive';
							if (i == 3) objTab.className = 'fnb_inactive';
						}
					}
				}

				// Keep a record of the automatic rotator, a number in milliseconds calls this function again.
				// Global variables have to have "window." in front of them for the scope.
				if (window != null) {
					if (window.hometabRotatorAutoToggle != null) {
						window.hometabRotatorAutoToggle[idName] = autoRotatorTimer;
					}
				}
				
				if (autoRotatorTimer != null) {
					if (!isNaN(autoRotatorTimer)) {
						autoRotatorTimer = parseInt(autoRotatorTimer);
						setTimeout("hometab('" + idName + "'," + amountTotal + "," + (amountCurrent + 1) + "," + autoRotatorTimer + ");", autoRotatorTimer);
					}
				}

				// Clean up
				amountTotal = null;
				amountCurrent = null;
				i = null;
				obj = null;
				delete amountTotal;
				delete amountCurrent;
				delete i;
				delete obj;
			}
		}
	}
	// Clean up
	amountTotal = null;
	amountCurrent = null;
	delete amountTotal;
	delete amountCurrent;
}