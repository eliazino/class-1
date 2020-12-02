$(document).ready(function(){
    $("#createShow").click(function(){
        $("#createMother").toggle("slow");
    });
});

function submitProduct(obj){
    if($("#dishname").val().length < 5){
        alert("Product name is not good enough")
        return;
    }
    if(!($("#unitPrice").val() > 0)){
        alert("Product Price cannot be zero")
        return;
    }

    if($("#minunit").val() < 1 || ($("#minunit").val() > $("#maxunit").val())){
        alert("Kindly doublecheck min max order")
        return;
    }
    document.getElementById("uploadProduct").submit();
}