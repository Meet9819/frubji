(function () {
    if (Number(jQuery('#cartCount').text())) jQuery('#cartCount').show();
    else jQuery('#cartCount').hide();
      if (Number(jQuery('#cartCountt').text())) jQuery('#cartCountt').show();
    else jQuery('#cartCountt').hide();

    //  search cart fix	
    jQuery('#top-search').on('click', function () {
        jQuery(this).next().slideToggle('medium');
        jQuery('#search_query_top').focus();
    });
})();

function addToCart(ref, itemID, wishlist = false) {
    try {
        if (!itemID) throw new Error('item id undefined');
        else {
            let variant = $(ref).parent().parent().parent().parent().find('.product-variant').val().split(',');
            let qty = Number($(ref).parent().find('.item_qty').val()) || 1;

            actionAlert = document.getElementById('#actionAlert');
            actionAlertClasses = actionAlert.classList;
            actionAlertSpan = actionAlert.lastElementChild;
            $.get(`cartAction.php?action=addToCart&id=${itemID}&variant=${variant[0].trim()}&qty=${qty}&movecart=${wishlist}`)
                .done(function () {
                    count = Number($('#cartCount').text());
                    $('#cartCount').text(++count);
                    $('#cartCount').show();
                    count = Number($('#cartCountt').text());
                    $('#cartCountt').text(++count);
                    $('#cartCountt').show();
                    actionAlertSpan.textContent = 'Product added to cart successfully!';
                    actionAlertClasses.remove('hidden');
                    actionAlertClasses.add('alert-success');
                    window.setTimeout(function () {
                        actionAlertClasses.add('hidden');
                        actionAlertClasses.remove('alert-success');
                        actionAlertSpan.textContent = '';
                    }, 3000);
                })
                .fail(function (error, xhr, status) {
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

if (jQuery('#pincode-modal') && !jQuery('#pincode').text()) {
    jQuery('#pincode-modal').modal('show');
    jQuery('#pincode-modal').css('display', 'block');
} else {
    jQuery('#pincode-modal').modal('hide');
    jQuery('#pincode-modal').css('display', 'none');
}

jQuery('.pincode').on('click', (e) => {
    try {
        e.stopPropagation();
        e.preventDefault();
        // jQuery('#pincode').text(' ');
        jQuery('#pincode-modal').modal('show');
    } catch (error) { }
});

async function checkPinCodeValid() {
    try {
        jQuery('#pincode-block').hide();

        let pincode = Number(jQuery('#pincode-input').val());

        if (!pincode) {
            return false;
        }

        let res = await fetch(`api/check-pin.php?pin=${pincode}`);

        res = await res.json();

        if (!res.status) {
            jQuery('#pincode-message').text(res.message);

        } else {
            jQuery('#pincode-block').show();
            jQuery('#pincode').text(pincode);
            jQuery('#pincode-modal').modal('hide');
            window.location.reload();
        }
    } catch (error) { }
}

jQuery('div').on('change', '.product-variant', function (e) {
    e.stopPropagation();
    e.preventDefault();

    let value = $(this).val();

    let [variant, price] = String(value).split(',');

    let priceSection = $(this).parent().parent().find('.product-price-list');

    // set price
    $(priceSection).children().last().text(`₹ ${price}`);
});

jQuery('.add_to_wishlist_button').on('click', async function (e) {
    try {
        e.stopPropagation();
        e.stopImmediatePropagation();
        e.preventDefault();

        let productID = $(this).data('product_id'),
            productVariantID = $(this).data('product_variant_id');

        let res = await fetch(`api/add-wishlist.php?product=${productID}&variant=${productVariantID}`);
        res = await res.json();

        window.alert(res.message);
    } catch (error) {

    }
});
