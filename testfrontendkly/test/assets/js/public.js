$(".tambah-website-global").click(function() {
    resetformvalue("#FrmSaveWebsite");

    var no_group = $(".dropdown-group option:contains('No Group')").val();
    $(".dropdown-group").val(no_group).trigger("change");
    $(".hidden-idgroup").val(no_group);

    //FrmSave.find(".alert").addClass("hidden");
    $("#layout-group-select").removeClass("hidden");
    $(".modal-save-website .modal-title").html("Add New Site");
    $(".modal-save-website").modal("show");
});


$(".datasidebar").on("click", ".tambah-group", function() {
    resetformvalue("#FrmSaveGroup");
    
    $(".modal-save-group .modal-title").html("Create New Group");
    $(".modal-save-group").modal("show");
});

$(".dataheader").on("click", ".tambah-group", function() {
    resetformvalue("#FrmSaveGroup");
    
    $(".modal-save-group .modal-title").html("Create New Group");
    $(".modal-save-group").modal("show");
});

$(".modal-save-group").on("shown.bs.modal", function() {
    FrmSaveGroup.resetForm(); //Reset jquery validation message
    $("#FrmSaveGroup").find("input[type='text']").filter(":first").focus();
});

$(".datasidebar").on("click", ".sub-menu .nav-item .tambah-website", function() {
    resetformvalue("#FrmSaveWebsite");
    
    var id_group = $(this).data("id_group");
    var nm_group = $(this).data("nama");
    $(".hidden-idgroup").val(id_group);
    $("#layout-group-select").addClass("hidden");

    $(".modal-save-website .modal-title").html("Add New Site : " + nm_group);
    $(".modal-save-website .modal-body .alert").removeClass("hidden");
    $(".modal-save-website").modal("show");
});

$(".datatable").on("click", ".hapus-data", function() {   
    var id = $(this).attr("data-iddelete"), nama = $(this).attr("data-nama");
    $(".hidden-iddelete").val(id); 
    $(".delete-data-name").html(nama);

    $(".modal-delete .modal-title").html("Remove Data");
    $(".modal-delete").modal("show");
});

$(".datatable").on("click", ".status-data", function() {   
    var id = $(this).attr("data-idupdate"), status = $(this).attr("data-status");
    $(".hidden-idupdatestatus").val(id); 

    $(".modal-update-status .dropdown-status").val(status).trigger("change");
    $(".modal-update-status .modal-title").html("Edit Status");
    $(".modal-update-status").modal("show");
});


$(".modal-save-website").on("shown.bs.modal", function() {
    FrmSaveWebsite.resetForm(); //Reset jquery validation message
    $("#FrmSaveWebsite").find("input[type='text']").filter(":nth-child(2)").focus();
});


//Edit Status
var FrmUpdateStatus = $("#FrmUpdateStatus").validate({
    submitHandler: function(form) {
        var idupdate = $(form).find(".hidden-idupdate").val();
        UpdateData(form, function(resp) {
            GetData(request);
        });
    },
    errorPlacement: function (error, element) {
        if (element.parent(".input-group").length) { 
            error.insertAfter(element.parent());      // radio/checkbox?
        } else if (element.hasClass("select2-normal") || element.hasClass("select2-nosearch")) {     
            error.insertAfter(element.next("span"));  // select2
        } else {                                      
            error.insertAfter(element);               // default
        }
    }
});

//Search Website
$(".search-website").click(function() {
    var url = $(".url-website").val();

    $.ajax({
        type: "POST",
        url: base_url + "/ajax/ajax-analytics",
        data: {act:"checksiteid", req: {"url": url}},
        tryCount: 0,
        retryLimit: 3,
        beforeSend: function() {
            l.ladda("start");
        },
        success: function(resp){
            l.ladda("stop");
            $(".id-analytics").val(resp);
            $(".id-analytics").valid();
        },
        error: function(xhr, textstatus, errorthrown) {
            if(textstatus == "timeout") {
                this.tryCount++;
                if(this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                }
            }
        }
    });
    return false;
});

/*$(".youtube-show").click(function() {
    if($(".youtube-layout").length <= 0) {
        var html = "";
            html+= "<div class='youtube-layout'>";
            html+= '<iframe src="//www.youtube.com/embed/QcWIm_Hnxnc" width="100%" height="100%" class="youtube-popup" frameborder="0" allowfullscreen></iframe>'
            html+= '<a role="button" class="btn btn-danger btn-sm youtube-hide" onclick="youtube_hide();"><i class="fa fa-times"></i></a>';
            html+= "</div>";
        $("body").append(html);
    }
});

function youtube_hide() {
    $(".youtube-layout").remove();
}*/

function analyticsdashboard(analytics_date = "") {
    var selector = $(".datatable tbody tr");
    $(".analytics_date").html(date_now);
    $(".analytics_data").html(loader());
    selector.each(function(index) {
        var id = $(this).find(".lstid-analytics").html();
        var req= {"id": id, "filter":{"date": analytics_date}};
        GetAnalaytics(req, "htmlanalyticsdashboard", function(resp) {
            if(resp.IsError == false) {
                resp = resp.lsdt;
                $("#data-"+id+" .pageview-dashboard").html(resp.pageview);
                $("#data-"+id+" .session-dashboard").html(resp.session);
                $("#data-"+id+" .bounce-rate-dashboard").html(FormatAngka(resp.bounce_rate) + "%");
                $(".analytics_bydate").removeClass("hidden");
            } else {
                toastrshow("error", resp.ErrMessage, "Kesalahan");
            }
        });
    });
}

function analyticsindexwebsite(analytics_date = "") {
    var selector = $(".datatable tbody tr");
    selector.each(function(index) {
        var id = $(this).find(".lstid-analytics").html();
        var req= {"id": id, "filter":{"date": analytics_date}};
        GetAnalaytics(req, "htmlanalyticsdashboard", function(resp) {
            if(resp.IsError == false) {
                resp = resp.lsdt;
                $("#data-"+id+" .pageview-index").html(resp.pageview);
                $("#data-"+id+" .session-index").html(resp.session);
                $("#data-"+id+" .bounce-rate-index").html(FormatAngka(resp.bounce_rate) + "%");
            } else {
                toastrshow("error", resp.ErrMessage, "Kesalahan");
            }
        });
    });
}