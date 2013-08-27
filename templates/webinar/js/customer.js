console.log("outside is called");
$(function() {
    console.log("inside is called");
    setInterval( function() {
        var seconds = new Date().getSeconds();
        var sdegree = seconds * 6;
        var srotate = "rotate(" + sdegree + "deg)";

        $("#sec").css({ "transform": srotate });

}, 1000 );

setInterval( function() {
    var hours = new Date().getHours();
    var mins = new Date().getMinutes();
    var hdegree = hours * 30 + (mins / 2);
    var hrotate = "rotate(" + hdegree + "deg)";

    $("#hour").css({ "transform": hrotate});

}, 1000 );

setInterval( function() {
    var mins = new Date().getMinutes();
    var mdegree = mins * 6;
    var mrotate = "rotate(" + mdegree + "deg)";

    $("#min").css({ "transform" : mrotate });

}, 1000 );

$('.box_skitter_large').skitter({
    theme: 'clean',
    numbers_align: 'right',
    progressbar: false,
    dots: true,
    preview: true
    });
});

