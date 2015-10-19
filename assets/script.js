$(function() {
    $('#side-menu').metisMenu();
    //alert(window.screen.width+"-"+window.screen.height);
    //alert($(".navbar-header").width());

    if($("#right-sidebar").length>0) {
        $("#rightSidebar-toggle").click(function() {
            $("#right-sidebar").toggleClass("sidebar-open");
        });
    } else {
        $("#rightSidebar-toggle").detach();
    }

    $("#groupholder","#sidebar").delegate(".nav-second-level a[href]","click",function(e) {
        e.preventDefault();
        loadTestGroup($(this).attr("href").substr(1),$(this).text());
    });
    $("#sidebar").delegate(".go-back","click",function(e) {
        e.preventDefault();
        
        $("#activeCaseGroup","#sidebar").html("");
        $(".go-back","#sidebar").detach();
        $("#groupholder","#sidebar").show();
    });
    $("#activeCaseGroup","#sidebar").delegate("a[href]","click",function(e) {
        e.preventDefault();
        loadTest(this);
    });

    loadComponent("dashboard");
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #pageWrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#pageWrapper").css("height", (height) + "px");
            $("#sidebar").css("height", (height) + "px");
        }
    });

    // var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url || url.href.indexOf(this.href) == 0;
    // }).addClass('active').parent().parent().addClass('in').parent();
    // if (element.is('li')) {
    //     element.addClass('active');
    // }
});
function loadComponent(pg) {
    $("#pageWrapper").addClass('ajaxloading');
    $("#pageWrapper").load(getCompLink("dashboard"),function() {
        $("#pageWrapper").removeClass('ajaxloading');
    });
}
function loadTestGroup(src,title) {
    $("#groupholder","#sidebar").hide();

    html="";
    //html+="<a href='#'><i class='fa fa-sitemap fa-fw'></i> "+title+"<span class='fa arrow'></span></a>";
    html+="<ul class='nav nav-second-level'>";
    html+="<li class='ajaxloading-mini' style='height: 100px;background-position-y: 20px;'></li>";
    html+="</ul>";
    $("#activeCaseGroup","#sidebar").html(html);

    $("<li class='go-back'><a href='#'><span class='fa fa-arrow-left'></span> "+title+"</a></li>").insertBefore($("#activeCaseGroup","#sidebar"));

    $("#activeCaseGroup>ul.nav-second-level","#sidebar").load(getCompLink("testList")+"&src="+src,function() {
        $('#activeCaseGroup').metisMenu();
    });
}
function loadTest(src) {
    test=$(src).attr("href").substr(1);
    title=$(src).text();
    hash=$(src).attr("hash");

    if(test==null || test.length<=0) return;

    testid="test_"+hash+"_"+Math.ceil(Math.random()*1000000000000);
    
    html="<div id='"+testid+"' hash='"+hash+"' class='row'><div class='col-lg-12'><div class='panel panel-default'>";
    html+="<div class='panel-heading'>Test : "+title+" ";
    html+="<span class='label label-primary pull-right'>RUNNING</span></div>";
    html+="<div class='panel-body'>";
    html+="<div class='ajaxloading large'></div>";
    html+="</div>";
    html+="<div class='panel-footer'>";
    html+="<a class='pull-right' href='#' onclick='toggleDebugInfo(this)' title='Toggle Complete Debug Information'><span class='fa fa-eye'></span></a>";
    html+="<a href='#' onclick='removeTestResult(this)' title='Remove Test Result'><span class='fa fa-remove'></span></a>";
    html+="</div>";
    html+="</div></div></div>";

    $(html).insertAfter($('#pageWrapper .row:first-child'));
    
    $("#pageWrapper .row[id='"+testid+"'][hash='"+hash+"'] .panel-body").load(getCompLink('testcase')+"&src="+test,function() {
        ROW=$(this).closest(".row");
        if($(this).find(".stats").hasClass("success")) {
            ROW.find(".panel-heading .label").removeClass("label-primary").addClass("label-success").text("SUCCESS");
        } else if($(this).find(".stats").hasClass("warning")) {
            ROW.find(".panel-heading .label").removeClass("label-primary").addClass("label-warning").text("WARNING");
        } else {
            ROW.find(".panel-heading .label").removeClass("label-primary").addClass("label-danger").text("FAILED");
        }
        if(ROW.find(".panel-body input[name=coverage]").val().length>0) {
            html="<a href='"+ROW.find(".panel-body input[name=coverage]").val()+"' target=_blanktitle='Code Coverage Log'><span class='fa fa-code'></span></a>";
            ROW.find(".panel-footer").append(html);
        }
        if(ROW.find(".panel-body input[name=log]").val().length>0) {
            html="<a href='"+ROW.find(".panel-body input[name=log]").val()+"' target=_blank title='Test Run Log'><span class='fa fa-road'></span></a>";
            ROW.find(".panel-footer").append(html);
        }
    });
}
function getCompLink(comp) {
    return window.location.origin+window.location.pathname+"?comp="+comp;
}

//UI Button functions
function reloadWindow() {
    window.location.reload();
}
function clearWindow() {
    $("#pageWrapper .row[hash]").detach();
}

//DEBUG Box functions
function toggleDebugInfo(tag) {
    $(tag).closest(".row").find(".panel-body pre").toggle();
}
function removeTestResult(tag) {
    $(tag).closest(".row").fadeOut().detach();
}