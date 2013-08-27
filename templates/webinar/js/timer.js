$(document).ready(function(){


    //timer actions
    $("#btn").click(function(){
        switch($(this).html().toLowerCase())
        {
            case "start":
                s = parseInt($("input[name='s']").val());
                alert(s);
                if(isNaN(s))
                {
                    s = 0;
                    $("input[name='s']").val(0);
                }
                $("#t").timer("start", {seconds:s});
                $(this).html("Pause");
                $("input[name='s']").attr("disabled", "disabled");
                $("#t").addClass("badge-important");
                break;

            case "resume":
                $("#t").timer("resume");
                $(this).html("Pause")
                $("#t").addClass("badge-important");
                break;

            case "pause":
                $("#t").timer("pause");
                $(this).html("Resume")
                $("#t").removeClass("badge-important");
                break;
        }
    });

    $("#get-seconds-btn").click(function(){
        console.log($("#t").timer("get_seconds"));
    });
});