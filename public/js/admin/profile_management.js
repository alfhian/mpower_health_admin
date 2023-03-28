var lowerStat = 0
var upperStat = 0
var numberStat = 0
var specialStat = 0
var lengthStat = 0
var confirmStat = 0
var pswCurrent = document.getElementById("current_password")
var pswInput = document.getElementById("password")
var pswConfirmation = document.getElementById("password_confirmation")
var letter = document.getElementById("letter")
var capital = document.getElementById("capital")
var number = document.getElementById("number")
var special = document.getElementById("special")
var length = document.getElementById("length")

$('#psw-tooltip').click(function () {
    $('[data-bs-toggle="tooltip"]').tooltip('show')
})

$('#psw-tooltip').focusout(function () {
    $('[data-bs-toggle="tooltip"]').tooltip('hide')
})


// Password Input rules
pswInput.onkeyup = function () {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g
    if (pswInput.value.match(lowerCaseLetters)) {
        lowerStat = 1
        //letter.classList.remove("invalid")
        //letter.classList.add("valid")
    } else {
        lowerStat = 0
        //letter.classList.remove("valid")
        //letter.classList.add("invalid")
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g
    if (pswInput.value.match(upperCaseLetters)) {
        upperStat = 1
        //capital.classList.remove("invalid")
        //capital.classList.add("valid")
    } else {
        upperStat = 0
        //capital.classList.remove("valid")
        //capital.classList.add("invalid")
    }

    // Validate numbers
    var numbers = /[0-9]/g
    if (pswInput.value.match(numbers)) {
        numberStat = 1
        //number.classList.remove("invalid")
        //number.classList.add("valid")
    } else {
        numberStat = 0
        //number.classList.remove("valid")
        //number.classList.add("invalid")
    }

    // Validate special character
    var specials = /[-'/`~!#*$@_%+=.,^&(){}[\]|;:”<>?\\]/g
    if (pswInput.value.match(specials)) {
        specialStat = 1
        //special.classList.remove("invalid")
        //special.classList.add("valid")
    } else {
        specialStat = 0
        //special.classList.remove("valid")
        //special.classList.add("invalid")
    }

    // Validate length
    if (pswInput.value.length >= 8) {
        lengthStat = 1
        //length.classList.remove("invalid")
        //length.classList.add("valid")
    } else {
        lengthStat = 0
        //length.classList.remove("valid")
        //length.classList.add("invalid")
    }

    if (pswInput.value != pswConfirmation.value) {
        confirmStat = 0
        $('#pswconfirm_message').show()
    } else {
        confirmStat = 1
        $('#pswconfirm_message').hide()
    }
}


// Password Confirmation match validation
pswConfirmation.onkeyup = function () {
    if (pswInput.value != pswConfirmation.value) {
        confirmStat = 0
        $('#pswconfirm_message').show()
    } else {
        confirmStat = 1
        $('#pswconfirm_message').hide()
    }
}



$('#password').keyup(function () {
    if (lowerStat == 1 && upperStat == 1 && numberStat == 1 && specialStat == 1 && lengthStat ==
        1) {
        $(this).css('border', '1px solid #ced4da')
    }
})


// Password Visibility feature
let icon = ''

$('#button-visible').click(function () {
    if ($('#current_password').is('input[type="password"]')) {
        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16"><path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/><path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/></svg>'
        $('#current_password').attr('type', 'text')
        $(this).html(icon)
    } else {
        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" /><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" /></svg>'
        $('#current_password').attr('type', 'password')
        $(this).html(icon)
    }
})

$('#button-visible1').click(function () {
    if ($('#password').is('input[type="password"]')) {
        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16"><path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/><path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/></svg>'
        $('#password').attr('type', 'text')
        $(this).html(icon)
    } else {
        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" /><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" /></svg>'
        $('#password').attr('type', 'password')
        $(this).html(icon)
    }
})

$('#button-visible2').click(function () {
    if ($('#password_confirmation').is('input[type="password"]')) {
        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16"><path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/><path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/></svg>'
        $('#password_confirmation').attr('type', 'text')
        $(this).html(icon)
    } else {
        icon = '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" /><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" /></svg>'
        $('#password_confirmation').attr('type', 'password')
        $(this).html(icon)
    }
})


// Change Password validation
$('#change-password-form').submit(function () {
    if (pswInput.value == '') {
        $('#password').css('border', '1px solid red')
        $('#password_message span').html('Please fill out the password')
        $('#password_message').show()
        return false
    }
    if (pswInput.value == pswCurrent.value) {
        $('#password').css('border', '1px solid red')
        $('#password_message span').html('New password cannot be the same as the current password')
        $('#password_message').show()
        return false
    }
    if (lowerStat == 1 && upperStat == 1 && numberStat == 1 && specialStat == 1 && lengthStat ==
        1 && confirmStat == 1) {
        return true
    } else {
        $('#password').css('border', '1px solid red')
        $('[data-bs-toggle="tooltip"]').tooltip('show')
        setTimeout(function () {
            $('[data-bs-toggle="tooltip"]').tooltip('hide')
        }, 5000)
        return false
    }
})