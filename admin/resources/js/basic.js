var basicOverviewTable = null,
    supplierBranchItems = null,
    receiverBranchItems = null,
    branchStockOverviewItems = null,
    queryParams = null,
    orderOverviewData = null,
    baseURL = "",
    supplierCompany = "",
    supplierBranch = "",
    documentNumber = "",
    invoiceFinalTotal = 0,
    orderNo = 0,
    coordinates = "";

var specialKeys = [
    8, 9, 46, 36, 35, 37, 39, 92
];

$(document).ready(() => {
    $('.price-control-toggle').on('change', togglePrices);

    $('#supplier-company').on('change', fetchSupplierBranchList);

    $('#supplier-company').on('change', resetDocumentNumber);

    $('#receiver-company').on('change', fetchReceiverBranchList);

    $('#receiver-company').on('change', resetDocumentNumber);

    $('#supplier-branch').on('change', fetchSupplierBranchItems);

    $('#supplier-branch').on('change', setDocumentNumber);

    $('#receiver-branch').on('change', fetchReceiverBranchItems);

    $('#receiver-branch').on('change', setDocumentNumber);

    $('.price-form-submit-btn').on('click', updatePriceMaster);

    $('.retail-price-form-submit-btn').on('click', updateRetailPriceMaster);

    baseURL = window.location.href.split('/');
    baseURL.pop();
    baseURL.pop();
    baseURL = baseURL.join('/');

    queryParams = new URLSearchParams(document.location.search);
    orderNo = Number(queryParams.get('orderNo'));

    supplierCompany = $('#supplier-company').val()
    supplierBranch = $('#supplier-branch').val();
    receiverCompany = $('#receiver-company').val()
    receiverBranch = $('#receiver-branch').val();
    documentNumber = $('#documentNumber').val();

    if (supplierCompany && supplierBranch) {
        $('#supplier-branch')[0].dispatchEvent(new Event('change', {
            'bubbles': true,
            'cancelable': true
        }));
    }

    setCurrentLocation();
});

function clearRow(row) {
    try {
        let siblings = $(row).parent().siblings();


        if ($(row).hasClass('clear_row')) {
            let orderItemNetAmount = Number($(row).parent().parent().children('.order_item_final_amount').children().first().val());

            $('#final-invoice-total').text((invoiceFinalTotal - orderItemNetAmount).toFixed(2));
        }

        $(siblings).each((index) => {
            let element = $(siblings[index]).children().first()[0];
            let elementType = element.nodeName.toLowerCase();

            if (elementType === 'input') {
                $(element).val('');
            } else if (elementType === 'select') {
                $(element)[0].options.length = 1;
            }
        });

        $(this).parent().parent().remove();

        resetBranchStockOverview();
    } catch (error) { throw error; }
}

function checkRequiredFields(row) {
    try {
        let valid = false;

        $(row).each((index) => {
            let element = $(row[index]).children().first()[0],
                type = element.nodeName.toLowerCase();

            if ($(element).hasClass('hidden')) {
                return false;
            }

            if (type === 'div') {
                element = $(row[index]).children().first().children().last()[0];
                type = element.nodeName.toLowerCase();
            }

            let required = element.required ? true : false,
                value = (type === 'input') && (typeof (type) === 'number') ? Number(element.value) : element.value;

            if (required && !value) {
                valid = false;
                return false;
            } else {
                valid = true;
            }
        });

        return valid;
    } catch (error) {
        return false;
    }
}

function specialcharacternotallowed(e) {
    let keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
    return ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
}

function fetchSupplierBranchList(event) {
    try {
        let company = $('#supplier-company').val();

        $('#supplier-branch')[0].options.length = 1;

        if ((supplierCompany !== company) && company) {
            supplierCompany = company;

            fetch(`${baseURL}/API/organization/branch/all.php?company=${supplierCompany.trim()}`, {
                method: 'GET'
            })
                .then(data => data.json())
                .then((data) => {
                    for (let branch of data.branches) {
                        $('#supplier-branch').append($('<option>').val(branch).text(branch));
                    }

                    $('#supplier-branch').focus();
                })
                .catch((error) => {
                    throw error;
                });
        }
    } catch (error) { throw error; }

    if (event) {
        return event.stopPropagation();
    }
}

function fetchReceiverBranchList(event) {
    try {
        let company = $('#receiver-company').val();

        $('#receiver-branch')[0].options.length = 1;

        if ((receiverCompany !== company) && company) {
            receiverCompany = company;

            fetch(`${baseURL}/API/organization/branch/all.php?company=${receiverCompany.trim()}`, {
                method: 'GET'
            })
                .then(data => data.json())
                .then((data) => {
                    for (let branch of data.branches) {
                        $('#receiver-branch').append($('<option>').val(branch).text(branch));
                    }

                    $('#receiver-branch').focus();
                })
                .catch((error) => {
                    throw error;
                });
        }
    } catch (error) { throw error; }

    if (event) {
        return event.stopPropagation();
    }
}

function fetchSupplierBranchItems(event) {
    try {
        supplierBranch = $('#supplier-branch').val();

        if (!$('#workingin').val()) {
            $('#workingin').val(supplierBranch);
        }

        if (supplierCompany && supplierBranch) {
            fetch(baseURL + `/API/stock/details.php?company=${supplierCompany.trim()}&branch=${supplierBranch.trim()}`, {
                method: 'GET'
            })
                .then((data) => {
                    return data.json();
                })
                .then((data) => {
                    supplierBranchItems = data.data;

                    setBranchStockOverviewItems();

                    $('#supplier-item-code-datalist').empty();
                    for (let key of Object.keys(supplierBranchItems)) {
                        $('#supplier-item-code-datalist').append($('<option>').attr('value', key));
                    }
                })
                .catch((error) => {
                    throw error;
                });
        }
    } catch (error) { throw error; }

    if (event) {
        return event.stopPropagation();
    }
}

function fetchReceiverBranchItems(event) {
    try {
        receiverBranch = $('#receiver-branch').val();

        if (receiverCompany && receiverBranch) {
            fetch(baseURL + `/API/stock/details.php?company=${receiverCompany.trim()}&branch=${receiverBranch.trim()}`, {
                method: 'GET'
            })
                .then((data) => {
                    return data.json();
                })
                .then((data) => {
                    receiverBranchItems = data.data;
                    $('#receiver-item-code-datalist').empty();
                    for (let key of Object.keys(receiverBranchItems)) {
                        $('#receiver-item-code-datalist').append($('<option>').attr('value', key));
                    }
                })
                .catch((error) => {
                    throw error;
                });
        }
    } catch (error) { throw error; }

    if (event) {
        return event.stopPropagation();
    }
}

function resetDocumentNumber(event) {
    try {
        $('#documentNumber').val(documentNumber);
    } catch (error) {
        throw error;
    }

    if (event) {
        return event.stopPropagation();
    }
}

function setDocumentNumber(event) {
    try {
        if (!supplierCompany || !supplierBranch) {
            resetDocumentNumber(event);
        } else {
            $('#documentNumber').val(`${supplierCompany}/${supplierBranch}/${documentNumber}`);
        }
    } catch (error) {
        throw error;
    }

    if (event) {
        return event.stopPropagation();
    }
}

function fillBranchStockOverview(itemCode) {
    try {
        if (!itemCode) {
            return;
        }

        if (branchStockOverviewItems && Object.prototype.hasOwnProperty.call(branchStockOverviewItems, itemCode)) {
            let dataIterator = 0;

            $('#itemCodeRackLocation').text(`${branchStockOverviewItems[itemCode]['location']}`);
            $('#itemCodeInitialMinUnit').text(`${branchStockOverviewItems[itemCode]['minUnit']}`);
            $('#itemCodeFinalMinUnit').text(`${branchStockOverviewItems[itemCode]['minUnit']}`);
            $('#itemCodeInitialMaxUnit').text(`${branchStockOverviewItems[itemCode]['maxUnit']}`);
            $('#itemCodeFinalMaxUnit').text(`${branchStockOverviewItems[itemCode]['maxUnit']}`);

            let supplierBranchItemBatches = branchStockOverviewItems[itemCode]['batches'];

            for (let key of Object.keys(supplierBranchItemBatches)) {
                if (dataIterator) {
                    let supplierItemQtyDetails = $('#supplierItemQtyDetails').children().first().clone();
                    $('#supplierItemQtyDetails').append(supplierItemQtyDetails);
                }

                document.getElementsByName('supplierBranchCode[]')[dataIterator].textContent = itemCode;
                document.getElementsByName('supplierBranchBatch[]')[dataIterator].textContent = key ? key : '-';
                document.getElementsByName('supplierBranchExpDate[]')[dataIterator].textContent = supplierBranchItemBatches[key] ? supplierBranchItemBatches[key]['expiryDate'] : '-';
                document.getElementsByName('supplierBranchInitialMinQty[]')[dataIterator].textContent = supplierBranchItems[itemCode]['batches'][key] ? supplierBranchItems[itemCode]['batches'][key]['minQty'] : 0;
                document.getElementsByName('supplierBranchFinalMinQty[]')[dataIterator].textContent = branchStockOverviewItems[itemCode]['batches'][key] ? branchStockOverviewItems[itemCode]['batches'][key]['minQty'] : 0;
                document.getElementsByName('supplierBranchInitialMaxQty[]')[dataIterator].textContent = supplierBranchItems[itemCode]['batches'][key] ? supplierBranchItems[itemCode]['batches'][key]['maxQty'] : 0;
                document.getElementsByName('supplierBranchFinalMaxQty[]')[dataIterator].textContent = branchStockOverviewItems[itemCode]['batches'][key] ? branchStockOverviewItems[itemCode]['batches'][key]['maxQty'] : 0;
                ++dataIterator;
            }
        }

        if (receiverBranchItems && Object.prototype.hasOwnProperty.call(receiverBranchItems, itemCode)) {
            let dataIterator = 0;

            let receiverBranchItemBatches = branchStockOverviewItems[itemCode]['batches'];

            for (let key of Object.keys(receiverBranchItemBatches)) {
                if (dataIterator) {
                    let receiverItemQtyDetails = $('#receiverItemQtyDetails').children().first().clone();
                    $('#receiverItemQtyDetails').append(receiverItemQtyDetails);
                }

                document.getElementsByName('supplierBranchCode[]')[dataIterator].textContent = itemCode;
                document.getElementsByName('supplierBranchBatch[]')[dataIterator].textContent = key ? key : '-';
                document.getElementsByName('supplierBranchExpDate[]')[dataIterator].textContent = supplierBranchItemBatches[key] ? supplierBranchItemBatches[key]['expiryDate'] : '-';
                document.getElementsByName('supplierBranchInitialMinQty[]')[dataIterator].textContent = receiverBranchItems[itemCode]['batches'][key] ? receiverBranchItems[itemCode]['batches'][key]['minQty'] : 0;
                document.getElementsByName('supplierBranchFinalMinQty[]')[dataIterator].textContent = branchStockOverviewItems[itemCode]['batches'][key] ? branchStockOverviewItems[itemCode]['batches'][key]['minQty'] : 0;
                document.getElementsByName('supplierBranchInitialMaxQty[]')[dataIterator].textContent = receiverBranchItems[itemCode]['batches'][key] ? receiverBranchItems[itemCode]['batches'][key]['maxQty'] : 0;
                document.getElementsByName('supplierBranchFinalMaxQty[]')[dataIterator].textContent = branchStockOverviewItems[itemCode]['batches'][key] ? branchStockOverviewItems[itemCode]['batches'][key]['maxQty'] : 0;
                ++dataIterator;
            }
        }
    } catch (error) {
        throw error;
    }
}

function resetBranchStockOverview() {
    try {
        $('#itemCodeRackLocation').text('');
        $('#itemCodeInitialMinUnit').text('');
        $('#itemCodeFinalMinUnit').text('');
        $('#itemCodeInitialMaxUnit').text('');
        $('#itemCodeFinalMaxUnit').text('');

        $('#supplierItemQtyDetails').children().slice(1).remove();
        $('#receiverItemQtyDetails').children().slice(1).remove();

        if (document.getElementsByName('supplierBranchCode[]').length > 0) {
            document.getElementsByName('supplierBranchCode[]')[0].textContent = '-';
            document.getElementsByName('supplierBranchBatch[]')[0].textContent = '-';
            document.getElementsByName('supplierBranchExpDate[]')[0].textContent = '-';
            document.getElementsByName('supplierBranchInitialMinQty[]')[0].textContent = 0;
            document.getElementsByName('supplierBranchFinalMinQty[]')[0].textContent = 0;
            document.getElementsByName('supplierBranchInitialMaxQty[]')[0].textContent = 0;
            document.getElementsByName('supplierBranchFinalMaxQty[]')[0].textContent = 0;
        }

        if (document.getElementsByName('receiverBranchCode[]').length > 0) {
            document.getElementsByName('receiverBranchCode[]')[0].textContent = '-';
            document.getElementsByName('receiverBranchBatch[]')[0].textContent = '-';
            document.getElementsByName('receiverBranchExpDate[]')[0].textContent = '-';
            document.getElementsByName('receiverBranchMinQty[]')[0].textContent = 0;
            document.getElementsByName('receiverBranchMaxQty[]')[0].textContent = 0;
        }
    } catch (error) {
        throw error;
    }
}

function updateBranchStockOverview(itemCode, batch, expiry, quantity, packing, totalFocPcs = 0) {
    try {
        if (branchStockOverviewItems && Object.prototype.hasOwnProperty.call(branchStockOverviewItems, itemCode)) {
            resetBranchStockOverview();
            fillBranchStockOverview(itemCode);

            let minUnitQty = branchStockOverviewItems[itemCode]['minUnitPacking'],
                maxUnitQty = branchStockOverviewItems[itemCode]['maxUnitPacking']

            let normalizedMinQty = Math.floor((Number((packing / minUnitQty).toFixed(2)) * quantity) + Number((Math.trunc(totalFocPcs / minUnitQty)).toFixed(2))),
                normalizedMaxQty = Math.ceil((Number((packing / maxUnitQty).toFixed(2)) * quantity) + Number((Math.trunc(totalFocPcs / maxUnitQty)).toFixed(2)));

            let totalRows = $('#supplierItemQtyDetails').children().length;

            let supplierBranchExpiryDateElements = document.getElementsByName('supplierBranchExpDate[]'),
                supplierBranchBatchNoElements = document.getElementsByName('supplierBranchBatch[]'),
                supplierBranchFinalMinQtyElements = document.getElementsByName('supplierBranchFinalMinQty[]'),
                supplierBranchFinalMaxQtyElements = document.getElementsByName('supplierBranchFinalMaxQty[]');

            let availableStockMinQty = 0,
                availableStockMaxQty = 0;

            for (let dataIterator = 0; dataIterator < totalRows; dataIterator++) {
                availableStockMinQty += Number(supplierBranchFinalMinQtyElements[dataIterator].textContent);
                availableStockMaxQty += Number(supplierBranchFinalMaxQtyElements[dataIterator].textContent);
            }

            for (let dataIterator = 0; dataIterator < totalRows; dataIterator++) {
                let currentExpiryDate = supplierBranchExpiryDateElements[dataIterator].textContent,
                    currentBatchNo = supplierBranchBatchNoElements[dataIterator].textContent;

                if ((currentExpiryDate !== expiry) || (currentBatchNo !== batch)) {
                    continue;
                }

                let currentMinQty = Number(branchStockOverviewItems[itemCode]['batches'][batch]['minQty']),
                    currentMaxQty = Number(branchStockOverviewItems[itemCode]['batches'][batch]['maxQty']),
                    actualMinQty = Number(supplierBranchItems[itemCode]['batches'][batch]['minQty']),
                    actualMaxQty = Number(supplierBranchItems[itemCode]['batches'][batch]['maxQty']);

                // initial check
                if ((currentMinQty < 1) && (currentMaxQty < 1)) {
                    swal('Insufficient Stock', 'Branch doesn\'t have additional stock. Please check quantity!', 'error');
                    break;
                }

                let updatedMinQty = actualMinQty - normalizedMinQty,
                    updatedMaxQty = actualMaxQty - normalizedMaxQty;

                availableStockMinQty -= (updatedMinQty > 1) ? normalizedMinQty : actualMinQty;
                availableStockMaxQty -= (updatedMaxQty > 1) ? normalizedMaxQty : actualMaxQty;

                if ((normalizedMaxQty > actualMaxQty) || (normalizedMaxQty > currentMaxQty)) {
                    if (((normalizedMinQty > actualMinQty) || (normalizedMinQty > currentMinQty)) && (availableStockMinQty > 0)) {
                        swal('Insufficient stock', 'This batch of item doesn\'t have additional stock of this packing. \nPlease select another packing!', 'warning');
                        break;
                    } else if (((normalizedMinQty > actualMinQty) || (normalizedMinQty > currentMinQty)) && (availableStockMinQty <= 0)) {
                        swal('Insufficient stock', 'Branch doesn\'t have additional stock. Please check quantity!', 'error');
                        break;
                    } else {
                        updatedMaxQty = 0;
                        updatedMinQty = currentMinQty - normalizedMinQty;
                    }
                } else {
                    updatedMinQty = currentMinQty - normalizedMinQty;
                    updatedMaxQty = currentMaxQty - normalizedMaxQty;
                }

                // update view
                supplierBranchFinalMinQtyElements[dataIterator].textContent = updatedMinQty;
                supplierBranchFinalMaxQtyElements[dataIterator].textContent = updatedMaxQty;

                // update stock
                branchStockOverviewItems[itemCode]['batches'][batch]['minQty'] = updatedMinQty;
                branchStockOverviewItems[itemCode]['batches'][batch]['maxQty'] = updatedMaxQty;
            }
        }
    } catch (error) {
        throw error;
    }
}

function showFOCToast(itemCode) {
    try {
        if (itemCode && supplierBranchItems[itemCode] && supplierBranchItems[itemCode]['foc']) {
            let focDataText = 'Order Quantity (box)\t:\tFOC Quantity (box)';

            for (let key of Object.keys(supplierBranchItems[itemCode]['foc'])) {
                focDataText += `<br/><span>${key}    :   ${supplierBranchItems[itemCode]['foc'][key]}</span>`;
            }

            let headerText = (Object.keys(supplierBranchItems[itemCode]['foc']).length > 0) ? `FOC: ${itemCode}` : 'No FOC scheme currently available for';

            $.toast({
                heading: headerText,
                text: focDataText,
                showHideTransition: 'fade',
                allowToastClose: true,
                hideAfter: false,
                stack: false,
                position: 'top-center',
                bgColor: '#0092ee',
                textColor: '#eeeeee',
                textAlign: 'center',
            });
        }
    } catch (error) {
        throw error;
    }
}

function getOverviewTableData(url, data) {
    try {
        return new Promise((resolve, reject) => {
            return fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then((res) => {
                    if (res.ok) {
                        return res.json();
                    } else {
                        return res.statusText;
                    }
                })
                .then((res) => {
                    return resolve(res);
                })
                .catch((error) => {
                    return reject(error);
                });
        });
    } catch (error) {
        throw error;
    }
}

function setBranchStockOverviewItems() {
    try {
        branchStockOverviewItems = JSON.parse(JSON.stringify(supplierBranchItems));
    } catch (error) {
        throw error;
    }
}

function setCurrentLocation() {
    try {
        if (navigator.geolocation) {
            coordinates = navigator.geolocation.getCurrentPosition((position) => {
                return `${position.coords.latitude}, ${position.coords.longitude}`;
            });
        }
    } catch (error) {
        throw error;
    }
}

function togglePrices(e) {
    try {
        let toggleChecked = $(this).is(':checked');

        // do not convert prices if checkbox is unchecked
        if (!toggleChecked) {
            return false;
        }

        let panel = $(this).parent().parent().parent().parent();

        // get variants and prices from current modal/div
        let variants = panel.find('.price-variants'),
            price = panel.find('.price-fixprice');

        let referenceVariant = 0,
            priceVariant = 0;

        if ((variants && variants.length) && (price && price.length)) {
            // get first row variant for reference
            referenceVariant = $(variants)[0].value;
            referenceVariant = referenceVariant.split(' ');

            // get reference variant qty and unit
            referenceVariantQty = Number(referenceVariant[0]);
            referenceVariantUnit = referenceVariant[1].toLowerCase();

            // get first row price for reference
            priceVariant = Number($(price)[0].value);

            // get base price for lowest unit
            let basePrice = priceVariant / referenceVariantQty;

            if (!basePrice) {
                basePrice = 0;
            }

            for (let i = 0; i < variants.length; i++) {
                let variant = variants[i].value.split(' ');

                if ((variant.length < 2) || !Number(variant[0])) {
                    continue;
                }

                if (variant[1].toLowerCase() == referenceVariantUnit) {
                    // for same unit, simply multiply it with base price
                    price[i].value = Number(variant[0]) * basePrice;
                } else if ((variant[1].toLowerCase() == 'kgs')
                    || (variant[1].toLowerCase() == 'kg')
                    || (variant[1].toLowerCase() == 'l')
                    || (variant[1].toLowerCase() == 'litre')) {
                    // convert kg to grams to get price
                    // OR convert litre to millilitre to get price
                    price[i].value = Number(variant[0] * 1000) * basePrice;
                } else if ((variant[1].toLowerCase() == 'gms')
                    || (variant[1].toLowerCase() == 'gm')
                    || (variant[1].toLowerCase() == 'ml')
                    || (variant[1].toLowerCase() == 'millilitre')) {
                    // convert grams to kg to get price
                    // OR convert millilitre to litre to get price
                    price[i].value = Number(variant[0] / 1000) * basePrice;
                }
            }
        }
    } catch (error) { }
}

async function updatePriceMaster(e) {
    try {
        e.preventDefault();
        e.stopPropagation();

        let panel = $(this).parent().parent().parent().not().first();

        if (!panel) {
            alert('Failed to update price');
        }

        let body = $(panel).find('.update-form-body');

        if (!body) {
            alert('Failed to update price');
        }

        let product = $(body).find('.price-productid'),
            branch = $(body).find('.price-branchid'),
            variant = $(body).find('.price-variantid'),
            price = $(body).find('.price-fixprice');

        if (!branch || !variant || !price) {
            alert('Failed to update price');
        }

        if ((branch.length != variant.length) || (price.length != variant.length) || (branch.length != price.length)) {
            alert('Failed to update price');
        }

        let data = [];

        for (let i = 0; i < branch.length; i++) {
            data.push({
                'product': Number(product[i].value),
                'branch': Number(branch[i].value),
                'variant': Number(variant[i].value),
                'price': Number(price[i].value),
            });
        }

        let res = await fetch('ajaxinsert/update-price-master.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });

        res = await res.json();

        location.reload();
    } catch (error) { }
}

async function updateRetailPriceMaster(e) {
    try {
        e.preventDefault();
        e.stopPropagation();

        let panel = $(this).parent().parent().parent().not().first();

        if (!panel) {
            alert('Failed to update price');
        }

        let body = $(panel).find('.update-form-body');

        if (!body) {
            alert('Failed to update price');
        }

        let product = $(body).find('.price-productid'),
            branch = $(body).find('.price-branchid'),
            variant = $(body).find('.price-variantid'),
            price = $(body).find('.price-fixprice');

        if (!branch || !variant || !price) {
            alert('Failed to update price');
        }

        if ((branch.length != variant.length) || (price.length != variant.length) || (branch.length != price.length)) {
            alert('Failed to update price');
        }

        let data = [];

        for (let i = 0; i < branch.length; i++) {
            data.push({
                'product': Number(product[i].value),
                'branch': Number(branch[i].value),
                'variant': Number(variant[i].value),
                'price': Number(price[i].value),
            });
        }

        let res = await fetch('ajaxinsert/update-retail-price-master.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });

        res = await res.json();

        location.reload();
    } catch (error) { }
}