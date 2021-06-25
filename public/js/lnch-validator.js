function isValidLNCH(lnch) {
    var checkSum = computeLNCHCheckSum(lnch);

    if(isLNCHValidLength(lnch) && 
        lnchContainsIntegerOnly(lnch) &&
        isValidLNCHCheckSum(checkSum, lnch)) {
        return true;
    } else {
        return false
    }
}

function isLNCHValidLength(lnch) {
    return lnch.length === 10;
}

function lnchContainsIntegerOnly(lnch) {
    return /[0-9]/.test(lnch);
}

function computeLNCHCheckSum(lnch) {
    var checkSum = 0;
    var weights = [21, 19, 17, 13, 11, 9, 7, 3, 1];

    for (var i = 0; i < weights.length; ++i) {
        checkSum += weights[i] * Number(lnch.charAt(i));
    }

    checkSum %= 10;

    return checkSum;
}

function isValidLNCHCheckSum(checkSum, lnch) {
    return checkSum === Number(lnch.charAt(9));
}

//1004336186