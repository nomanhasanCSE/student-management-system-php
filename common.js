$(document).ready(function(){
    function loadData(type, category_id){
        $.ajax({
            url :"get-districts.php",
            type: "post",
            data: {type: type, id : category_id},
            success : function(data){
                if( type == "districtData"){
                    $("#district").html(data);
                } else {
                    $("#division").append(data);
                }
            }
        });
    }
    loadData();
    $("#division").on("change",function(){
        var division =  $("#division").val();
        loadData("districtData", division);
    });
});