//document.getElementById('closeButton').style.visibility='hidden'; 

function closeAppears() {
    document.getElementById('closeButton').style.visibility = 'visible';
}

function submitImageAppears() {
    document.getElementById('submitImageButtom').style.visibility = 'visible';
}

function roleSelectAppears() {
    document.getElementById('roleSelect').style.visibility = 'visible';
    document.getElementById('roleInput').value = 1;
}

function timepickerAppears() {
    document.getElementById('timepickerInput').style.visibility = 'visible';
    document.getElementById('allDayInput').checked=0; 
}



function closeDisappears() {
    document.getElementById('closeButton').style.visibility = 'hidden';
}

