function getAllElementsWithAttribute(attribute, value){
    var matchingElements = [];
    table = document.getElementById("tbody"); 
    var allElements = table.getElementsByTagName('TR');
    for (var i = 0, j = allElements.length; i < j; i++){
        if (allElements[i].getAttribute(attribute) == value){
        // Element exists with attribute. Add to array.
        matchingElements.push(allElements[i]);
        }
    }
    return matchingElements;
}

function sortTable(table, col, reverse) {
    var tb = table.tBodies[0], // use `<tbody>` to ignore `<thead>` and `<tfoot>` rows
        tr = getAllElementsWithAttribute("result", "true");//Array.prototype.slice.call(tb.rows, 0), // put rows into array
    reverse = -((+reverse) || -1);
    tr = tr.sort(function (a, b) { // sort rows
        return reverse // `-1 *` if want opposite order
            * (a.cells[col].textContent.trim() // using `.textContent.trim()` for test
                .localeCompare(b.cells[col].textContent.trim())
               );
    });
    tn = getAllElementsWithAttribute("result", "false");
    for(i = 0; i < tr.length; ++i) tb.appendChild(tr[i]); // append each row in order
    for(i = 0; i < tn.length; ++i) tb.appendChild(tn[i]);
}

function loadcontrols(number_of_items){//number_of_items se odnosi na ukupni broj prikazan u tablici 

    var show_per_page = 20;
    var number_of_pages = Math.ceil(number_of_items / show_per_page);
    var load = 0;

    if (show_per_page < number_of_items){

        $('body').append('<div class=controls></div><input id=current_page type=hidden><input id=show_per_page type=hidden>');
        $('#current_page').val(0);
        $('#show_per_page').val(show_per_page);

        var navigation_html = '<a class="prev"><</a>';
        var current_link = 0;

        while (number_of_pages > current_link) {
            navigation_html += '<a class="page" longdesc="' + current_link + '">' + (current_link + 1) + '</a>';
            current_link++;
        }

        navigation_html += '<a class="next">></a>';

        $('.controls').html(navigation_html);
        $('.controls .page:first').addClass('active');
        var trarr = $('tbody').children();
        trarr.attr('visible', 'false');
        $("[result=true]").slice(0, show_per_page).attr('visible','true');
        $('.prev').click(function() {
            new_page = parseInt($('#current_page').val(), 0) - 1;
            //if there is an item before the current active link run the function
            if ($('.active').prev('.page').length == true) {
            go_to_page(new_page);
        }
        });

        $('.next').click(function() {
            new_page = parseInt($('#current_page').val(), 0) + 1;
            //if there is an item after the current active link run the function
            if ($('.active').next('.page').length == true) {
            go_to_page(new_page);
        }
        });

        $('.page').click(function() {
            pnum = this.innerHTML -1;
            go_to_page(pnum);
        });
    }
}
function removecontrols(){
    $('.controls').remove();
    $('#current_page').remove();
    $('#show_per_page').remove();
}



$(document).ready(function() {
    loadcontrols($('tbody').children('tr').size());
        
    $(".search").keyup(function () {
        var searchTerm = $(".search").val();
        var listItem = $('.results tbody').children('tr');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
        
        $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
                return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
        });

        $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('result','false');
            $(this).attr('visible','false');

        });

        var resarr=$(".results tbody tr:containsi('" + searchSplit + "')");
        resarr.each(function(e){

            $(this).attr('result','true');
            $(this).attr('visible','true');
        });
        removecontrols();
        loadcontrols(resarr.size());

        var jobCount = $('.results tbody tr[result="true"]').length;
            $('.counter').text(jobCount + ' rezultata');
        if(jobCount == '1'){
            $('.counter').text(jobCount + ' rezultat');
        }

        if(jobCount == '0') {$('.no-result').show();}
            else {$('.no-result').hide();}
    });

    $('.asc').click(function() {
        
        n=$(this).parent().attr('id');
        table = document.getElementById("tablep");
        if (  $( this ).next('.arrow').css( "transform" ) == 'none' ){
            $(this).next('.arrow').css("transform","rotate(180deg)");
            sortTable(table, n, false );
        } else {
            $(this).next('.arrow').css("transform","" );
            sortTable(table, n, true );
        }
        removecontrols();
        loadcontrols($("[result=true]").size());
    });

});



function go_to_page(page_num) {
var show_per_page = parseInt($('#show_per_page').val(), 0);

start_from = page_num * show_per_page;

end_on = start_from + show_per_page;

$('tbody').children().attr('visible', 'false').slice(start_from, end_on).attr('visible', 'true');

$('.page[longdesc=' + page_num + ']').addClass('active').siblings('.active').removeClass('active');

$('#current_page').val(page_num);
};
