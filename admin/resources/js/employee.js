var weekendDay = 5,
    employeeRoles = {};

baseURL = window.location.href.split('/');
baseURL.pop();
baseURL.pop();
baseURL = baseURL.join('/');

$('#generate-schedule').on('click', generateEmployeeSchedule);

function generateEmployeeSchedule(event) {
    try {
        month = Number($('#employee-schedule-month').val());
        year = Number($('#employee-schedule-year').val());
        days = 0;

        days = moment(`${year}-${month}`, 'YYYY-MM').daysInMonth();

        $('#employee-schedule-table').empty();

        let roles = getEmployeeRoles();

        for (let count = 1; count <= days; count++) {
            let date = moment.utc([year, month - 1, count]);
            let day = moment(date).format('dddd');
            day = day.toUpperCase();

            let weekDayNo = date.day();

            for (let key of Object.keys(roles)) {
                let name = key,
                    startDate = roles[key]['startDate'],
                    endDate = roles[key]['endDate'],
                    position = roles[key]['position'],
                    shift1_start = roles[key]['shift1Start'],
                    shift1_end = roles[key]['shift1End'],
                    shift2_start = roles[key]['shift2Start'],
                    shift2_end = roles[key]['shift2End'],
                    shift3_start = roles[key]['shift3Start'],
                    shift3_end = roles[key]['shift3End'];

                if (startDate) {
                    startDate = startDate.split('-').reverse().map(e => Number(e));
                    startDate[1] -= 1;
                    startDate = moment(startDate);
                }

                if (endDate) {
                    endDate = endDate.split('-').reverse().map(e => Number(e));
                    endDate[1] -= 1;
                    endDate = moment(endDate);
                }

                if ((date.diff(startDate, 'days') >= 0) && (date.diff(endDate, 'days') <= 0)) {
                    let row = `<tr>`;

                    row += `<td width="5%"><input type="hidden" name="doctor_address_type" id="doctor_address_type" value="${count}" />
                    <input type="text" name="date[]" value="${count}" title="${date.toDate('DD/MM/YYYY')}" class="form-control" readonly /></td>`;
                    row += `<td><input type="text"  name="day[]" class="form-control" value="${day}" readonly /></td>`;

                    row += `<td><input type="text" name="employer[]" class="form-control" value="${name}" readonly /></td>`;
                    row += `<td><input type="text" name="position[]" class="form-control" value="${position}" title="${position}" readonly /></td>`;
                    row += `<td><input type="text" name="type[]" class="form-control" value="Normal" readonly /></td>`;

                    if (weekDayNo === weekendDay) {
                        row += `<td><input type="text" name="shift1start[]" class="form-control" value="" readonly /></td>`;
                        row += `<td><input type="text" name="shift1end[]" class="form-control" value="" readonly /></td>`;
                    } else {
                        row += `<td><input type="text" name="shift1start[]" class="form-control" value="${shift1_start }" readonly /></td>`;
                        row += `<td><input type="text" name="shift1end[]" class="form-control" value="${shift1_end}" readonly /></td>`;
                    }

                    row += `<td><input type="text" name="shift2start[]" class="form-control" value="${shift2_start}" readonly /></td>`;
                    row += `<td><input type="text" name="shift2end[]" class="form-control" value="${shift2_end}" readonly /></td>`;

                    if (weekDayNo === weekendDay) {
                        row += `<td><input type="text" name="shift3start[]" class="form-control" value="" readonly /></td>`;
                        row += `<td><input type="text" name="shift3end[]" class="form-control" value="" readonly /></td>`;
                    } else {
                        row += `<td><input type="text" name="shift3start[]" class="form-control" value="${shift3_start}" readonly /></td>`;
                        row += `<td><input type="text" name="shift3end[]" class="form-control" value="${shift3_end}" readonly /></td>`;
                    }

                    row += '</tr>';


                    $('#employee-schedule-table').append(row);
                }
            }
            $('#total-employee-records').val($('#employee-schedule-table').children().length);
        }
    } catch (error) {
        throw error;
    }

    return event.stopPropagation();
}

function getEmployeeRoles() {
    try {
        let employeeNames = document.getElementsByClassName('employee-name'),
            employeePositions = document.getElementsByClassName('employee-role'),
            employeeShift1Start = document.getElementsByClassName('employee-shift1-start'),
            employeeShift1End = document.getElementsByClassName('employee-shift1-end'),
            employeeShift2Start = document.getElementsByClassName('employee-shift2-start'),
            employeeShift2End = document.getElementsByClassName('employee-shift2-end'),
            employeeShift3Start = document.getElementsByClassName('employee-shift3-start'),
            employeeShift3End = document.getElementsByClassName('employee-shift3-end'),
            startDate = document.getElementsByClassName('employee-start-date'),
            endDate = document.getElementsByClassName('employee-end-date');

        for (let count = 0; count < employeeNames.length; count++) {
            let name = employeeNames[count].value;

            if (!name) {
                continue;
            }

            employeeRoles[name] = {
                'name': name,
                'position': employeePositions[count].value,
                'shift1Start': employeeShift1Start[count].value,
                'shift1End': employeeShift1End[count].value,
                'shift2Start': employeeShift2Start[count].value,
                'shift2End': employeeShift2End[count].value,
                'shift3Start': employeeShift3Start[count].value,
                'shift3End': employeeShift3End[count].value,
                'startDate': startDate[count].value,
                'endDate': endDate[count].value,
            };
        }

        return employeeRoles;
    } catch (error) {
        throw error;
    }
}

function getemployeeHoursFormData() {
    try {
        let employeeHoursFormData = new FormData($('#employee-hours-data-form')[0]);
        employeeHoursFormData.append('totalInvoiceItems', totalOrderItems);
        employeeHoursFormData.append('invoiceTotal', invoiceFinalTotal);
        employeeHoursFormData.append('workingin', supplierBranch);
        employeeHoursFormData.append('orderNo', orderNo);


    } catch (error) {
        throw error;
    }
}

function saveEmployeeHours() {
    try {

    } catch (error) {

    }
}