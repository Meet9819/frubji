(function () {
    if (Number($('#cartCount').text())) $('#cartCount').show();
    else $('#cartCount').hide();
	
	//  search cart fix	
	 $('#top-search').on('click', function () {
        $(this).next().slideToggle('medium');
		$('#search_query_top').focus();
    });
	
})();

function addToCart(itemID) {
    try {
        if (!itemID) throw new Error('item id undefined');
        else {
            variant = document.getElementById('games') ? document.getElementById('games').value : 0 ;
            
            actionAlert = document.getElementById('#actionAlert');
            actionAlertClasses = actionAlert.classList;
            actionAlertSpan = actionAlert.lastElementChild;
            $.get(`cartAction.php?action=addToCart&id=${itemID}&variant=${variant}`)
                .then(function () {
                    count = Number($('#cartCount').text());
                    $('#cartCount').text(++count);
                    $('#cartCount').show();
                    actionAlertSpan.textContent = 'Product added to cart successfully!';
                    actionAlertClasses.remove('hidden');
                    actionAlertClasses.add('alert-success');
                    window.setTimeout(function () {
                        actionAlertClasses.add('hidden');
                        actionAlertClasses.remove('alert-success');
                        actionAlertSpan.textContent = '';
                    }, 3000);
                })
                .catch(function (e) {
                    actionAlertSpan.textContent = 'Could not add product to cart. Please try again!';
                    actionAlertClasses.remove('hidden');
                    actionAlertClasses.add('alert-danger');
                    window.setTimeout(function () {
                        actionAlertClasses.add('hidden');
                        actionAlertClasses.remove('alert-danger');
                        actionAlertSpan.textContent = '';
                    }, 3000);
                });
        }
    } catch (e) {
        throw e;
    }
}

function addToWishlist(imgID, productName, productPrice, userEmailID, pID) {
    try {
        actionAlert = document.getElementById('#actionAlert');
        actionAlertClasses = actionAlert.classList;
        actionAlertSpan = actionAlert.lastElementChild;
        if (!userEmailID) {
            actionAlertSpan.textContent = 'Please login to add products to your wishlist!';
            actionAlertClasses.remove('hidden');
            actionAlertClasses.add('alert-warning');
            window.setTimeout(function () {
                actionAlertClasses.add('hidden');
                actionAlertClasses.remove('alert-warning');
                actionAlertSpan.textContent = '';
            }, 2000);
        } else if (!imgID || !productName || !productPrice || !pID) {
            actionAlertSpan.textContent = 'Could not add product to your wishlist. Please try again!';
            actionAlertClasses.remove('hidden');
            actionAlertClasses.add('alert-danger');
            window.setTimeout(function () {
                actionAlertClasses.add('hidden');
                actionAlertClasses.remove('alert-danger');
                actionAlertSpan.textContent = '';
            }, 3000);
        } else {
            $.post('ajax/save.php', {
                img: imgID,
                name: productName,
                price: productPrice,
                useremailid: userEmailID,
                pid: pID,
            }, 'json')
                .success(function () {
                    actionAlertSpan.textContent = 'Product added to your wishlist successfully!';
                    actionAlertClasses.remove('hidden');
                    actionAlertClasses.add('alert-success');
                    window.setTimeout(function () {
                        actionAlertClasses.add('hidden');
                        actionAlertClasses.remove('alert-success');
                        actionAlertSpan.textContent = '';
                    }, 3000);
                })
                .error(function (e) {
                    if (e.status === 400) {
                        actionAlertSpan.textContent = 'This product is already in your wishlist!';
                        actionAlertClasses.remove('hidden');
                        actionAlertClasses.add('alert-info');
                        window.setTimeout(function () {
                            actionAlertClasses.add('hidden');
                            actionAlertClasses.remove('alert-info');
                            actionAlertSpan.textContent = '';
                        }, 3000);
                    } else {
                        actionAlertSpan.textContent = 'Could not add product to your wishlist. Please try again!';
                        actionAlertClasses.remove('hidden');
                        actionAlertClasses.add('alert-danger');
                        window.setTimeout(function () {
                            actionAlertClasses.add('hidden');
                            actionAlertClasses.remove('alert-danger');
                            actionAlertSpan.textContent = '';
                        }, 3000);
                    }
                });
        }
    } catch (e) {
        throw e;
    }
}