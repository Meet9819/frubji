// requires latest jQuery
var userRegistrationMobile = "";
var otpTimeout = null;


// pre-defined constants
let apiBaseURL = 'api',
    mobileNoLength = 10,
    otpLength = 6,
    mobileNoRegex = new RegExp('[7-9]{1}[0-9]{9}'),
    otpTime = 300;

/* 

HTML css classes to use

1) .user-verify-mobile              textbox to enter mobile
2) .user-verify-mobile-button       button to get OTP on click
3) .user-verify-otp                 textbox to enter OTP
4) .user-confirm-button             button to finalize user details 
5) .verify-mobile-alert             alert text to inform status about mobile
6) .verify-otp-alert                alert text to inform status about OTP
7) .verify-otp-timeout              OTP timer
8) .resend-otp-button               otp resend button
9) .register-btn                    register btn

*/


// on typing entire mobile no.
$('.user-verify-mobile').on('change', verifyMobileNo);

// on clicking Get OTP button
$('.user-verify-mobile-button').on('click', verifyMobileNo);

// on typing entire otp for verification
$('.user-verify-otp').on('change', checkValidOTP);

// on typing entire otp for verification
$('.user-verify-otp').on('blur', checkValidOTP);


async function verifyMobileNo(event) {
    try {
        event.preventDefault();
        event.stopImmediatePropagation();
        event.stopPropagation();

        userRegistrationMobile = $(this).val();

        let form = $(this).closest('form').attr('id');
        let formName = `#${form}`;

        let mobileVerify = $(formName).find('.verify-mobile-alert');

        // clear
        mobileVerify.text(' ');

        // validation steps
        if (!mobileNoLengthValid(userRegistrationMobile)) {
            mobileVerify.text(`Mobile no. should be atleast ${mobileNoLength} digits long!`);

            return false;
        }

        if (!mobileNoFormatValid(userRegistrationMobile)) {
            mobileVerify.text(`Mobile no. invalid. Please re-enter.`);

            return false;
        }

        let mobileTextBox = $(this);

        let otpTextBox = $(formName).find('.user-verify-otp');

        let registerBtn = $(formName).find('.register-btn');
        registerBtn.prop('disabled', true);

        // disable enter mobile textbox
        mobileTextBox.prop('readonly', true);

        // disable otp textbox
        otpTextBox.prop('disabled', true);

        $(formName).find('.verify-otp-alert').text(` `);

        mobileVerify.text('Sending OTP. Please wait.');

        if (await sendOTP(userRegistrationMobile)) {
            // on success, set verification timeout
            setOTPVerificationTime(formName, otpTime);

            // enable enter OTP textbox
            otpTextBox.prop('disabled', false);

            // disable resend OTP button
            $(formName).find('.resend-otp-button').prop('readonly', true);

            // inform user
            mobileVerify.text('OTP sent');

            window.setTimeout(() => {
                mobileVerify.text(' ');
            }, 10 * 1000);

            return true;
        } else {
            // on failure, enable enter mobile textbox
            mobileTextBox.prop('readonly', false);

            // disable enter OTP textbox
            otpTextBox.prop('disabled', true);
            return false;
        }
    } catch (error) {
        return false;
    }
}

async function checkValidOTP(event) {
    try {
        event.preventDefault();
        event.stopImmediatePropagation();
        event.stopPropagation();

        let otp = $(this).val();

        let otpTextBox = $(this);

        let form = $(this).closest('form').attr('id');
        let formName = `#${form}`;

        let confirmButton = $(formName).find('.user-confirm-button'),
            verifyOTPAlert = $(formName).find('.verify-otp-alert'),
            verifyOTPTimeout = $(formName).find('.verify-otp-timeout');

        // clear
        verifyOTPAlert.text(' ');

        if (!otp) {
            verifyOTPAlert.text('OTP invalid');
            return false;
        }

        if (otp.length != otpLength) {
            verifyOTPAlert.text(`OTP length should be ${otpLength}`);
            return false;
        }

        if (await verifyOTP(otp)) {
            // on success, disable otp textbox
            otpTextBox.prop('disabled', true);

            // enable confirm button
            confirmButton.prop('readonly', false);

            // reset OTP timer
            resetOTPTimeout(otpTimeout);

            let registerBtn = $(formName).find('.register-btn');
            registerBtn.prop('disabled', false);

            verifyOTPAlert.text('Mobile verified. Please proceed with registration');

            verifyOTPTimeout.text(' ');

            return true;
        } else {
            return false;
        }
    } catch (error) {
        return false;
    }
}

// calls send OTP api and reports success/failure
// return boolean
async function sendOTP(mobile) {
    try {
        let url = `${apiBaseURL}/send-otp.php?mobile=${mobile}`;

        let res = await fetch(url);

        let jsonRes = await res.json();

        return jsonRes.status;
    } catch (error) {
        return false;
    }
}

// calls verify OTP api and reports success/failure
// return boolean
async function verifyOTP(otp) {
    try {
        let url = `${apiBaseURL}/verify-otp.php?otp=${otp}`;

        let res = await fetch(url);

        let jsonRes = await res.json();

        return jsonRes.status;
    } catch (error) {
        return false;
    }
}

// sets OTP timeout counter on UI
function setOTPVerificationTime(context, timeInSeconds) {
    try {
        otpTimeout = window.setInterval(() => {
            if (timeInSeconds <= 0) {
                $(context).find('.verify-otp-timeout').text(' ');

                // notify user that OTP is expired after timeout
                $(context).find('.verify-otp-alert').text(`OTP expired`);

                // enable mobile verify button
                $(context).find('.user-verify-mobile').prop('readonly', false);

                // disable otp textbox
                $(context).find('.user-verify-otp').prop('disabled', true);

                // enable resend otp button
                $(context).find('.resend-otp-button').prop('readonly', true);

                // clear timeout
                resetOTPTimeout(otpTimeout);
            } else {
                let minutes = Math.floor(timeInSeconds / 60),
                    seconds = Math.floor((timeInSeconds--) % 60);

                minutes = (minutes < 10) ? `0${minutes}` : minutes;
                seconds = (seconds < 10) ? `0${seconds}` : seconds;

                $(context).find('.verify-otp-timeout').text(`OTP Time left: ${minutes}:${seconds}`);
            }
        }, 1000);
    } catch (error) {
        return;
    }
}

function resetOTPTimeout(interval) {
    window.clearInterval(interval);
}


// check mobile no. length
// returns boolean
let mobileNoLengthValid = (mobile) => (mobile.length === mobileNoLength);

// check mobile no. format is valid
// returns boolean
let mobileNoFormatValid = (mobile) => mobileNoRegex.test(mobile);

// checks whether mobile no. is valid
// returns boolean
let validateMobileNo = (mobile) => mobileNoLengthValid(mobile) && mobileNoFormatValid(mobile);