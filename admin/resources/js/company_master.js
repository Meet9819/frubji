

$(document).ready(() => {
 
    if (!queryParams.has('add') && !queryParams.has('edit')) {
        populateCOMPANY_MASTEROverviewtable(supplierCompany, supplierBranch);
    }

    // keyboard shortcuts
   
});




function deleteCOMPANY_MASTEROrder(rowNo, orderNo) {
    try {
        swal({
                text: `Are you sure you want to delete Item #${orderNo}`,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((confirm) => {
                if (confirm) {
                    return fetch(`${baseURL}/API/COMPANY_MASTER/deleteorder.php?orderNo=${orderNo}`, {
                        method: 'GET',
                    });
                } else {
                    throw null;
                }
            })
            .then((res) => {
                return res.json();
            })
            .then((res) => {
                if (res.status) {
                    swal({
                        text: `${res.message}. Item No. #${res.orderNo}`,
                        icon: 'success',
                        timer: 2000,
                        buttons: false,
                    });
                } else {
                    swal({
                        text: `${res.message}. Please try again`,
                        icon: 'error',
                        timer: 2000,
                        buttons: false,
                    });

                    throw null;
                }
            })
            .then(() => {
                basicOverviewTable.row(rowNo).remove().draw();
            })
            .catch((error) => {
                if (error) {
                    swal({
                        text: `${error.message}. Please try again`,
                        icon: 'error',
                        timer: 2000,
                        buttons: false,
                    });
                }
            });
    } catch (error) {
        swal({
            title: 'Order not deleted',
            text: `${error.message}. Please try again`,
            icon: 'error',
            timer: 5000,
            buttons: false,
        });
    }
}





function postPOSOrder(rowNo, orderNo) {
    try {
        let orderPosted = 0;

        swal({
                text: `Are you sure you want to post Order #${orderNo}`,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((confirm) => {
                if (confirm) {
                    return fetch(`${baseURL}/API/COMPANY_MASTER/postorder.php?orderNo=${orderNo}`, {
                        method: 'GET',
                    });
                } else {
                    throw null;
                }
            })
            .then((res) => {
                return res.json();
            })
            .then((res) => {
                if (res.status) {
                    swal({
                        text: `${res.message}. Order No. #${res.orderNo}`,
                        icon: 'success',
                        timer: 2000,
                        buttons: false,
                    });

                    orderPosted = 1;
                } else {
                    swal({
                        text: `${res.message}. Please try again`,
                        icon: 'error',
                        timer: 2000,
                        buttons: false,
                    });

                    throw null;
                }
            })
            .then(() => {
                if (orderPosted === 1) {
                    let rowData = basicOverviewTable.row(rowNo).data();
                    rowData[8] = orderPosted;
                    basicOverviewTable.row(rowNo).data(rowData).draw();
                }
            })
            .catch((error) => {
                if (error) {
                    swal({
                        text: `${error.message}. Please try again`,
                        icon: 'error',
                        timer: 2000,
                        buttons: false,
                    });
                }
            });
    } catch (error) {
        swal({
            title: 'Order not deleted',
            text: `${error.message}. Please try again`,
            icon: 'error',
            timer: 5000,
            buttons: false,
        });
    }
}






function populateCOMPANY_MASTEROverviewtable(company) {
    try {
        let requestData = {
            'company': company
           
        };

        getOverviewTableData(`${baseURL}/API/COMPANY_MASTER/getorders.php`, requestData)
            .then((res) => {
                orderOverviewData = res.data;

                let access = res.access;

                if (basicOverviewTable !== null) {
                    basicOverviewTable.fnDestroy();
                }

                let data = [],
                    count = 1;

                for (let key in orderOverviewData) {
                    let row = orderOverviewData[key];

                    data.push(
                        [
                            count++,
                            row['id'], 

                            row['companyname_english'],
                            row['shortname'],
                            row['companycode'],
                                row['id'],
                                
                            row['status'],
                          
                            
                        ]
                    );
                }

                basicOverviewTable = $('#basic-overview-table').DataTable({
                    'lengthMenu': [10, 20],
                    'pageLength': 10,
                    'columns': [{
                            'title': 'Sr. No.',
                            'orderable': false,
                            'width': '1%',
                            'searchable': false,
                        },

                        
                        {
                            'title': 'Itemcode',
                            'orderable': false,
                            'width': '10%',
                            'searchable': true,
                           
                        },


                        {
                            'title': 'Item Name.',
                            'orderable': false,
                            'width': '30%',
                            'searchable': true,
                             'render': function(data, type, row, meta) {
                                let orderID = row[row.length - 2];

                                if (type === 'display') {
                                    data = `<a href="#" onclick="updateOrderOverviewModal(${orderID})" class="text-inverse pr-10" title="Click to edit order">${data}/${orderID}</a>`;
                                }

                                return data;
                            }
                        },
                        {
                            'title': 'WS',
                            'orderable': false,
                            'width': '5%',
                            'searchable': false,
                            'contentPadding': 'mmm'
                        },
                        {
                            'title': 'RS',
                            'orderable': true,
                            'width': '5%', 'searchable': false,
                            'contentPadding': 'mmm'
                        },
                        {
                            'title': 'Actions',
                            'orderable': false,
                            'searchable': false,
                            'width': '5%',
                            'render': function(data, type, row, meta) {
                                editAccess = access.edit;
                                deleteAccess = access.delete;

                                let rowHTML = "";

                                let rowNo = row[0] - 1,
                                    orderPosted = row[row.length - 1];

                                if (type === 'display') {
                                   

                                    if (editAccess && !orderPosted) {
                                        rowHTML += `<a href="companyedit.php?edit_id=${data}" title="Edit Company" class="text-inverse" style="margin: 0 5px;"><i class="zmdi zmdi-edit txt-success"></i></a>`;
                                    }

                                    if (deleteAccess && !orderPosted) {
                                        rowHTML += `<a href="#" title="Delete Company" onclick="deleteCOMPANY_MASTEROrder(${rowNo}, ${data})" class="delete" style="margin: 0 5px;"><i class="zmdi zmdi-delete txt-danger" style="margin: 5px;"></i></a>`;
                                    }

                                    data = rowHTML;
                                }

                                return data;
                            }
                        },
                        {
                            'title': 'Stage',
                            'orderable': false,
                            'width': '15%',
                            'searchable': false,
                            'render': function(data, type, row, meta) {
                                let rowHTML = "";

                                let rowNo = row[0] - 1,
                                    orderID = row[row.length - 2],
                                    orderPosted = row[row.length - 1];

                                if (type === 'display') {
                                    if (orderPosted) {
                                        rowHTML += `<span class="btn-sm label label-success" style="margin: 0 5px;">Active</span>`;
                                    } else {
                                        rowHTML += `<a href="#" onclick="postPOSOrder(${rowNo}, ${orderID})" title="Click to post this order"><span class="btn-sm label label-danger" style="margin: 0 5px;">Not Active</span></a>`;
                                    }

                                    data = rowHTML;
                                }

                                return data;
                            }
                        },
                    ],
                    'data': data



                });
            })
            .catch((error) => {
                throw error;
            });
    } catch (error) {
        throw error;
    }
}










function updateOrderOverviewModal(orderID) {
    try {
        let order = orderOverviewData[orderID];

        if (!order) {
            return;
        }

        let basicDetails = '',
            orderItemDetails = '';

        let orderItems = order.items;

        $('#order-overview-modal-title').text('View POS Items');
        $('#order-screen-name').text('POS');

        basicDetails += `<td class="col-md-6 text-left">Type of Sale: ${order['id']}</td><td class="col-md-6 text-right">Document No.: ${order['documentNo']}/${order['id']}</td>`;
        basicDetails += `<td class="col-md-6 text-left">Customer Name: ${order['customer']}</td><td class="col-md-6 text-right">Order Date: ${order['orderDate']}</td>`;
        basicDetails += `<td class="col-md-6 text-left">Doctor: ${order['doctor']}</td><td class="col-md-6 text-right"></td>`;
        basicDetails += `<td class="col-md-12 text-left">Salesman: ${order['salesman']}</td>`;

        $('#order-overview-basic-details').html(basicDetails);
        $('#order-overview').modal('show');

        if (saleType === 1) {
            orderItemDetails += `<thead style="background-color:#f3f3f3">
                <th style="padding:10px" class="bor">Code</th>
                <th class="bor">Batch</th>
                <th class="bor">Units</th>
                <th class="bor">Packing</th>
                <th class="bor">Price</th>
                <th class="bor">Gross Total</th>
                <th class="bor">Disc.</th>
                <th class="bor">Net Total</th>
            </thead>`;
        } else {
            orderItemDetails += `<thead style="background-color:#f3f3f3">
                <th style="padding:10px"  class="bor">Code</th>
                <th class="bor">Batch</th>
                <th class="bor">Units</th>
                <th class="bor">Packing</th>
                <th class="bor">Price</th>
                <th class="bor">Qty</th>
                <th class="bor">FOC</th>
                <th class="bor">Ex. FOC</th>
                <th class="bor">Gross Total</th>
                <th class="bor">Disc.</th>
                <th class="bor">Net Total</th>
            </thead>`;
        }

        orderItemDetails += `<tbody>`;

        orderItems.forEach(item => {
              orderItemDetails += `<tr>`;
            orderItemDetails += `<td style="padding:5px" >${item['code']}</td>`;
            orderItemDetails += `<td>${item['batch']}</td>`;
            orderItemDetails += `<td>${item['units']}</td>`;
            orderItemDetails += `<td>${item['packing']}</td>`;
            orderItemDetails += `<td>${item['price']}</td>`;
            orderItemDetails += `<td>${item['qty']}</td>`;
            if (saleType != 1) {
                orderItemDetails += `<td>${item['foc']}</td>`;
                orderItemDetails += `<td>${item['foc_bonus']}</td>`;
            }
            orderItemDetails += `<td>${item['actual_total']}</td>`;
            orderItemDetails += `<td>${item['discount']}</td>`;
            orderItemDetails += `<td>${item['final_total']}</td>`;
             orderItemDetails += `</tr>`;
        });

        orderItemDetails += `</tbody>`;

        $('#order-overview-order-details').html(orderItemDetails);

        $('#order-overview-total-amount').text(`Total Amount: ${order['total']}`);

        $('#order-overview-actions').html(`<button type="button" class="btn btn-default btn-outline btn-icon left-icon" onclick="javascript:window.print();"><i class="fa fa-print"></i><span> Print</span></button>`);

        let barCodeText = `${order['company']}/${order['branch']}/${order['documentNo']}`;

        JsBarcode("#order-barcode", barCodeText, {
            lineColor: "#000",
            width: 1.5,
            height: 40,
            margin: 0,
            displayValue: false
        });
    } catch (error) {
        throw error;
    }
}

