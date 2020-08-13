require('./bootstrap');
require("flatpickr");
const Swedish = require("flatpickr/dist/l10n/sv.js").default.sv;

$( document ).ready( function()
{
    // DataTable
    $( '.table' ).DataTable(
    {
        'lengthChange': false,
        'info': false,
        'ordering': false,
        'paging': false,
        'language': {
            'search': 'Sök:'
        }
    } );

    // Flatpickr
    flatpickr( "#start_time", {
        locale: Swedish,
        enableTime: true,
        time_24hr: true,
        dateFormat: "Y-m-d H:i",
    } );

    flatpickr( "#birth_date", {
        locale: Swedish,
        dateFormat: "Y-m-d",
        maxDate: new Date().setFullYear( new Date().getFullYear() - 18 )
    } );

    // Alerts
    let close = document.getElementsByClassName("closebtn");
    let i;

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function(){
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function(){ div.style.display = "none"; }, 600);
        }
    }
} );
